<?php

namespace App\Controllers;

use App\Models\Adminm\Login_m;
use App\Models\Employeem\Cases_m;
use App\ThirdParty\smtp_mail\SMTP_mail;
use CodeIgniter\API\ResponseTrait;

class Cases_f extends BaseController
{
    use ResponseTrait;

    private $Login_m;
    private $Cases_m;
    protected $session;
    private $_validation;
    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->session->start();
        helper('url');
        helper('functions');
        $this->_validation = \Config\Services::validation();
        // sessionCheckCustomer();
        $this->Login_m = new Login_m();
        $this->Cases_m = new Cases_m();
        if (isset($_SESSION['customer']['customer_id'])) {
            $result = $this->Login_m->getTokenAndCheck('customer', $_SESSION['customer']['customer_id']);
            if ($result) {
                $token = $result['token'];
                if ($_SESSION['customer']['customer_tokencheck'] != $token) {
                    logoutUser('customer');
                    header('Location: ' . FRONT_LOGIN_LINK);
                    exit();
                }
            } else {
                logoutUser('customer');
                header('Location: ' . FRONT_LOGIN_LINK);
                exit();
            }
        }
    }

    public function cases_list()
    {
        if ($this->request->getMethod() === 'post') {
            $request = $this->request->getPost();
            $db = \Config\Database::connect();

            $customerId = $request['customer_id'];

            $draw   = intval($request['draw']);
            $start  = intval($request['start']);
            $length = intval($request['length']);
            $search = $request['search']['value'] ?? '';

            $columns = [
                'cs.cases_id',
                'cs.cases_priority',
                'cs.case_no',
                'cs.cases_title',
                'cs.cases_assign_to',
                'cs.cases_status',
                'cs.cases_dt_created',
                'emp.user_firstname',
                'emp.user_lastname'
            ];

            $builder = $db->table('cases cs')
            ->select('
                cs.cases_id,
                cs.cases_priority,
                cs.case_no,
                cs.cases_title,
                cs.cases_assign_to,
                cs.cases_status,
                cs.cases_dt_created,
                emp.user_firstname,
                emp.user_lastname
            ')
            ->join('employee emp', 'emp.employee_user_id = cs.cases_assign_to', 'left')
            ->where('cs.refCustomer_id', $customerId);

            if (!empty($search)) {
                $builder->groupStart()
                    ->like('cs.case_no', $search)
                    ->orLike('cs.cases_title', $search)
                    ->orLike('emp.user_firstname', $search)
                    ->orLike('emp.user_lastname', $search)
                ->groupEnd();
            }

            $filteredBuilder = clone $builder;
            $recordsFiltered = $filteredBuilder->countAllResults(false);

            if (!empty($request['order'])) {
                $orderColumnIndex = $request['order'][0]['column'];
                $orderDirection   = $request['order'][0]['dir'];

                if (isset($columns[$orderColumnIndex])) {
                    $builder->orderBy($columns[$orderColumnIndex], $orderDirection);
                }
            }

            if ($length != -1) {
                $builder->limit($length, $start);
            }

            $details = $builder->get()->getResultArray();

            $finalData = [];

            foreach ($details as $row) {
                // Hearing date
                $hearing = $db->table('comment')
                    ->select('comment_hearing_date')
                    ->where('refCases_id', $row['cases_id'])
                    ->orderBy('comment_id', 'DESC')
                    ->limit(1)
                    ->get()
                    ->getRowArray();

                $row['hearing_date'] = $hearing['comment_hearing_date'] ?? '0000-00-00';
                $row['employee_name'] = $row['user_firstname'] . ' ' . $row['user_lastname'];
                $row['index'] = '';

                $row['action'] = "<a href='" . base_url("front-view-cases/{$row['cases_id']}") . "' 
                    class='btn btn-xs btn-primary'>
                    View&nbsp;<em class='icon ni ni-eye-fill'></em>
                </a>";

                $finalData[] = $row;
            }

            $recordsTotal = $db->table('cases cs')
                ->where('cs.refCustomer_id', $customerId)
                ->countAllResults();

            return $this->response->setJSON([
                'draw'            => $draw,
                'recordsTotal'    => $recordsTotal,
                'recordsFiltered' => $recordsFiltered,
                'data'            => $finalData
            ]);
        }

        $data['title'] = FRONT_LIST_CASES_TITLE;
        return view('pages/case_list', $data);
    }


    public function update_profile()
    {
        if ($this->request->getMethod() == 'post') {
            $validation = $this->_validation;
            $validation->reset();

            $validation->setRules([
                'user_current_password' => 'required',
                'user_new_password' => 'required|min_length[8]',
                'user_confirm_password' => 'required|matches[user_new_password]',
            ]);

            if (!$validation->run($this->request->getPost())) {
                $errors = $validation->getErrors();
                return $this->respond($errors, 400);
            } else {
                $result = array();

                if ($this->Login_m->check_current_password_front($_POST['user_current_password'])) {
                    $res = $this->Login_m->update_password_front($_POST);
                    if ($res) {
                        successOrErrorMessage("Password changed successfully", 'success');
                        $result['success'] = "success";
                    }
                } else {
                    $result['success'] = "fail";
                }

                return $this->respond($result);
            }
        }

        if ($this->request->getMethod() == 'get') {
            helper('form');
            $data['title'] = FRONT_UPDATE_PROFILE_TITLE;
            echo front_view('frontside/update_profile', $data);
        }
    }

    public function add_comment()
    {
        $validation = $this->_validation;

        $validation->reset();
        $validation->setRules([
            'cases_id' => 'required|numeric',
            'employee_id' => 'required|numeric',
            'cases_message' => 'required',
            'case_files_file' => 'ext_in[case_files_file,pdf,jpg,jpeg,png]',
            'last_comment_id' => 'required|numeric',
        ]);

        if (!$validation->run($this->request->getPost())) {
            $errors = $validation->getErrors();
            return $this->respond($errors, 400);
        } else {
            $message = "fail";
            $comments = "";

            $comment_data = [
                'refCases_id' => $this->request->getPost('cases_id'),
                'comment_description' => $this->request->getPost('cases_message'),
                'comment_type' => 'comment',
                'comment_from' => $_SESSION['customer']['customer_id'],
                'comment_to' => $this->request->getPost('employee_id'),
                'comment_from_usertype' => 'customer',
                'comment_to_usertype' => 'employee',
                'comment_datetime' => date("Y-m-d H:i:s"),
            ];

            $res = $this->Cases_m->add_cases_comment($comment_data);

            if ($res) {
                if ($this->request->getPost('employee_id') != 0) {
                    include APPPATH . 'ThirdParty/smtp_mail/smtp_send.php';
                    $employee_data = $this->Cases_m->get_single_employee($this->request->getPost('employee_id'));
                    if ($employee_data['user_email_id'] != '') {
                        $email_data = array();
                        $email_data['mail_title'] = 'User is commented on case.';
                        $email_data['link_title'] = 'View comment by clicking this link ';
                        $email_data['case_link'] = EMPLOYEE_VIEW_CASES_LINK . $this->request->getPost('cases_id');
                        $sendmail = new \SMTP_mail();
                        $sendmail->sendCommentDetails($employee_data['user_email_id'], $email_data);
                    }
                }

                if (($_FILES['case_files_file']['name'][0]) != '') {
                    $cases_files = multiFileUpload('case_files_file', $this->request->getPost('cases_id') . '/');
                    $i = 0;
                    foreach ($cases_files as $row) {
                        $params = array();
                        $params['refCases_id'] = $this->request->getPost('cases_id');
                        $params['case_files_name'] = $row[2]['original_file_name'];
                        $params['case_files_unique_name'] = $row[2]['file_name'];
                        $params['case_files_size'] = $row[2]['file_size'];
                        $params['case_files_ext'] = $row[2]['file_ext'];
                        $params['case_files_type'] = "comment";
                        $params['refComment_id'] = $res;
                        $this->Cases_m->add_cases_files($params);
                        $i = $i + 1;
                    }
                }
                $comments = $this->comment_list($this->request->getPost('cases_id'), $this->request->getPost('last_comment_id'));
                $message = "success";
            }

            $result = array();
            $result['message'] = $message;
            $result['comments'] = $comments;

            return $this->respond($result);
        }
    }

    public function view_cases($case_id)
    {
        helper('form');
        $data['caseDetails'] = $this->Cases_m->get_view_cases($case_id);
        if (isset($_SESSION['customer']) && ($data['caseDetails']['refCustomer_id'] == $_SESSION['customer']['customer_id'])) {
            $data['fileDetails'] = $this->Cases_m->get_file_details($case_id);
            $data['involved_peopel'] = $this->Cases_m->get_involved_peopel($case_id);
            $data['comments'] = $this->comment_list($case_id);
            $data['title'] = FRONT_VIEW_CASES_TITLE;
            echo front_view('frontside/view_cases', $data);
        } else {
            return redirect()->to('/')->with('error', 'This is not your case.');
        }
    }

    public function comment_list($case_id, $last_comment_id = 0)
    {
        $data['comments'] = $this->Cases_m->get_comments($case_id, $last_comment_id);
        $data['commentFileDetails'] = $this->Cases_m->get_comment_file_details($case_id, $last_comment_id);
        $result = array();
        if (!empty($data['comments'])) {
            foreach ($data['comments'] as $row) {
                $filesArray = array();
                foreach ($data['commentFileDetails'] as $row1) {
                    if ($row1['refComment_id'] == $row['comment_id']) {
                        array_push($filesArray, $row1);
                    }
                }
                $row['comment_file'] = $filesArray;
                array_push($result, $row);
            }
        }
        return $this->generate_comment_view($result, $case_id);
    }

    public function generate_comment_view($comments, $case_id)
    {
        $return_str = '';
        if (!empty($comments)) {
            if (!empty($comments)) {
                $i = 0;
                foreach ($comments as $crow) {
                    $i = $i + 1;
                    $lastcomment = '';
                    $from_name = '';
                    $datavalue = 0;
                    $user_img = '';
                    $hearing_date = $crow['comment_hearing_date'];
                    $comment_id = $crow['comment_id'];
                    $date = date("d-M-Y", strtotime($crow['comment_datetime']));
                    $datetime = date("d-M-Y h:i:sa", strtotime($crow['comment_datetime']));
                    if ($i == 1) {
                        $lastcomment = ' lastcomment';
                        $datavalue = $comment_id;
                    }
                    if ($crow['comment_from_usertype'] == 'employee') {
                        $from_name = strtoupper(substr($crow['f_user_firstname'], 0, 1) . substr($crow['f_user_lastname'], 0, 1));
                        $from_short_name = $crow['f_user_firstname'] . ' ' . $crow['f_user_lastname'] . ' (Employee)';
                        $user_img = UPLOAD_FOLDER . 'original/default2.png';
                    }
                    if ($crow['comment_from_usertype'] == 'customer') {
                        $from_name = strtoupper(substr($crow['fhc_customer_first_name'], 0, 1) . substr($crow['fhc_customer_last_name'], 0, 1));
                        $from_short_name = $crow['fhc_customer_first_name'] . ' ' . $crow['fhc_customer_last_name'] . ' (Complainant)';
                        $user_img = UPLOAD_FOLDER . 'original/default.png';
                        if ($crow['fhc_customer_first_name'] == '') {
                            $from_short_name = 'Guest (Complainant)';
                        }
                    }
                    $return_str .= '<div class="media' . $lastcomment . '" data-value="' . $datavalue . '">                     
                     <a class="pull-left" href="#"><img class="media-object" src="' . $user_img . '" alt=""></a>                                      
                    <div class="media-body">                                                                       
                        <h4 class="media-heading">' . $from_short_name . '</h4>';

                    if ($crow['comment_type'] == 'comment') {
                        if (strpos($crow['comment_description'], '<p>') !== false) {
                            $description = $crow['comment_description'];
                        } else {
                            $description = '<p>' . $crow['comment_description'] . '</p>';
                        }
                        $return_str .= $description;

                        $date_array = explode("-", $hearing_date);
                        if ($date_array[0] != 0) {
                            $return_str .= '<p><strong class="assign-title">Next Hearing Date : </strong>' . $date_array[2] . '-' . $date_array[1] . '-' . $date_array[0] . '</p>';
                        }
                    }
                    if ($crow['comment_type'] == 'assign') {

                        $assign_to_name = $crow['t_user_firstname'] . ' ' . $crow['t_user_lastname'];
                        $return_str .= '<p><strong class="assign-title">Assign to</strong> @' . $assign_to_name . '</p>';
                    }
                    if ($crow['comment_type'] == 'reassign') {
                        $re_assign_to_name = $crow['t_user_firstname'] . ' ' . $crow['t_user_lastname'];
                        $return_str .= '<p> <strong class="assign-title">Reassign to</strong> @' . $re_assign_to_name . '</p>';
                    }
                    $return_str .= '<ul class="list-unstyled list-inline media-detail pull-left">';
                    if (!empty($crow['comment_file'])) {
                        foreach ($crow['comment_file'] as $cfrow) {
                            $return_str .= '<li">';
                            $file_url = UPLOAD_FOLDER . 'doc/' . $case_id . '/' . $cfrow['case_files_unique_name'];
                            $file_name = $cfrow['case_files_name'];
                            $return_str .= '<a class="download" target="_blank" href="' . $file_url . '"><span><i class="fa fa-file"> </i> ' . $file_name . '</span></a>&nbsp;&nbsp;&nbsp;
                            </li>';
                        }
                    }
                    $return_str .= '<li><i class="fa fa-calendar"></i>' . $datetime . '</li></ul>
                    </div>
                </div>
                <!-- COMMENT 1 - END -->';
                }
            }
        }
        return $return_str;
    }
}
