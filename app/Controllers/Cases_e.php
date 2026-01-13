<?php

namespace App\Controllers;

use App\Models\Adminm\Login_m;
use App\Models\Employeem\Cases_m;
use App\ThirdParty\smtp_mail\SMTP_mail;
use CodeIgniter\API\ResponseTrait;

class Cases_e extends BaseController
{
    use ResponseTrait;

    private $Login_m;
    private $Cases_m;
    private $security;
    protected $session;
    private $_validation;
    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->session->start();
        helper('url');
        helper('functions');
        $this->security = \Config\Services::security();
        $this->_validation = \Config\Services::validation();
        sessionCheckEmployee();
        $this->Login_m = new Login_m();
        $this->Cases_m = new Cases_m();
        if (isset($_SESSION['employee']['employee_user_id'])) {
            $result = $this->Login_m->getTokenAndCheck('employee', $_SESSION['employee']['employee_user_id']);
            if ($result) {
                $token = $result['token'];
                if ($_SESSION['employee']['employee_tokencheck'] != $token) {
                    logoutUser('employee');
                    header('Location: ' . EMPLOYEE_LOGIN_LINK);
                    exit();
                }
            } else {
                logoutUser('employee');
                header('Location: ' . EMPLOYEE_LOGIN_LINK);
                exit();
            }
        }
    }
    public function edit_cases($cases_id)
    {
        $caseDetail = $this->Cases_m->get_single_cases($cases_id);
        $validation = $this->_validation;

        if ($this->request->getMethod() == 'post') {
            include APPPATH . 'ThirdParty/smtp_mail/smtp_send.php';

            $validation->reset();
            $currentEmployee = $this->session->get('employee');

            $rules = [
                'case_no' => 'required|numeric',
                'cases_title' => 'required',
                'cases_party_name' => 'required|alpha_space',
                'cases_party_address' => 'permit_empty|string',
                'cases_party_number' => 'permit_empty|numeric|exact_length[10]',
                'howtocontact' => 'required|in_list[Email,Mobile,Both]',
                'cases_priority' => 'required|in_list[Low,Medium,High]',
                'cases_assign_to' => 'required|numeric',
                'case_files_file' => 'uploaded[case_files_file]|ext_in[case_files_file,pdf,jpg,jpeg,png]',
            ];

            $validation->setRules($rules, [
                'case_no' => [
                    'required' => 'Case number field is required.',
                    'numeric' => 'Case number field must contain only numbers.',
                ],
                'cases_title' => [
                    'required' => 'Title field is required.',
                ],
                'cases_party_name' => [
                    'required' => 'Party name field is required.',
                    'alpha_space' => 'Party name field may only contain alphabetical characters and spaces.',
                ],
                'cases_party_number' => [
                    'numeric' => 'Party contact number field must contain only numbers.',
                    'exact_length' => 'Party contact number field must be exactly {param} characters in length.',
                ],
                'cases_priority' => [
                    'required' => 'Priority field is required.',
                    'in_list' => 'Priority field must be one of: Low, Medium, High.',
                ],
                'cases_assign_to' => [
                    'required' => 'Assign to field is required.',
                    'numeric' => 'Assign to field must contain only numbers.',
                ],
            ]);

            if (!$validation->run($this->request->getPost())) {
                return redirect()->route('emp.case.edit'.$cases_id)->with('error', COMMON_VALIDATION_ERROR_MSG)->withInput($this->request->getPost());
            } else {
                $case_data = [
                    'cases_priority' => $this->request->getPost('cases_priority'),
                    'cases_title' => $this->request->getPost('cases_title'),
                    'cases_message' => $this->request->getPost('cases_message'),
                    'cases_assign_to' => $this->request->getPost('cases_assign_to'),
                    'case_update_date' => date("Y-m-d H:i:s"),
                    'cases_party_name' => $this->request->getPost('cases_party_name'),
                    'cases_party_address' => $this->request->getPost('cases_party_address'),
                    'cases_party_number' => $this->request->getPost('cases_party_number'),
                    'case_no' => $this->request->getPost('case_no'),
                ];

                $res =  $this->Cases_m->edit_cases($case_data, $cases_id);
                if ($res) {
                    if ($case_data['cases_assign_to'] != $caseDetail['cases_assign_to']) {
                        $comment_data = [
                            'refCases_id' => $cases_id,
                            'comment_from' => $currentEmployee['employee_user_id'],
                            'comment_to' => $case_data['cases_assign_to'],
                            'comment_from_usertype' => 'employee',
                            'comment_to_usertype' => 'employee',
                            'comment_datetime' => date("Y-m-d H:i:s"),
                        ];

                        if ($caseDetail['cases_assign_to'] == 0) {
                            $comment_data['comment_type'] = 'assign';
                        } else {
                            $comment_data['comment_type'] = 'reassign';
                        }

                        $this->Cases_m->add_cases_comment($comment_data);

                        if (!empty($caseDetail['customer_email'])) {
                            $email_data = array();
                            if ($comment_data['comment_type'] == 'assign') {
                                $email_data['mail_title'] = 'Your case is updated and assigned to our employee.';
                            } else {
                                $email_data['mail_title'] = 'Your case is updated and Re-assigned to our employee.';
                            }
                            $email_data['link_title'] = 'View case details by clicking this link ';
                            $email_data['case_link'] = FRONT_VIEW_CASES_LINK . $cases_id;
                            $sendmail = new \SMTP_mail();
                            $sendmail->sendCommentDetails($data['cases_res']['customer_email'], $email_data);
                        }
                    }
                } else {
                    successOrErrorMessage("Somthing happen wrong plz try again", 'error');
                    return redirect()->route('emp.case.edit' . $cases_id)->with('error', "Somthing happen wrong plz try again");
                }

                successOrErrorMessage("Data updated successfully", 'success');
                return redirect()->route('emp.case.list');
            }
        }

        if ($this->request->getMethod() == 'get') {
            helper('form');
            $data['title'] = EMPLOYEE_EDIT_CASES_TITLE;
            $data['cases_res'] = $caseDetail;
            $data['res_employee'] = $this->Cases_m->get_employee();
            $data['validation'] = $validation;
            return view('pages/admin/employee/employee-edit', $data);
        }
    }

    public function add_cases()
    {
        $validation = $this->_validation;

        if ($this->request->getMethod() == 'post') {
            include APPPATH . 'ThirdParty/smtp_mail/smtp_send.php';

            $validation->reset();
            $currentEmployee = $this->session->get('employee');

            $rules = [
                'case_no' => 'required|numeric',
                'cases_title' => 'required',
                'cases_party_name' => 'required|alpha_space',
                'cases_party_address' => 'permit_empty|string',
                'cases_party_number' => 'permit_empty|numeric|exact_length[10]',
                'howtocontact' => 'required|in_list[Email,Mobile,Both]',
                'cases_priority' => 'required|in_list[Low,Medium,High]',
                'cases_assign_to' => 'required|numeric',
                'case_files_file' => 'uploaded[case_files_file]|ext_in[case_files_file,pdf,jpg,jpeg,png]',
            ];

            $howToContact = $this->request->getPost('howtocontact');
            switch ($howToContact) {
                case 'Email':
                    $rules['customer_email'] = "required|valid_email";
                    break;
                case 'Mobile':
                    $rules['customer_contact'] = "required|numeric|exact_length[10]";
                    break;
                case 'Both':
                    $rules['customer_email'] = "required|valid_email";
                    $rules['customer_contact'] = "required|numeric|exact_length[10]";
                    break;
                default:
                    break;
            };

            $validation->setRules($rules, [
                'case_no' => [
                    'required' => 'Case number field is required.',
                    'numeric' => 'Case number field must contain only numbers.',
                ],
                'cases_title' => [
                    'required' => 'Title field is required.',
                ],
                'howtocontact' => [
                    'required' => 'How to contact field is required.',
                    'in_list' => 'How to contact field must be one of: Email, Mobile, Both.'
                ],
                'cases_party_name' => [
                    'required' => 'Party name field is required.',
                    'alpha_space' => 'Party name field may only contain alphabetical characters and spaces.',
                ],
                'cases_party_number' => [
                    'numeric' => 'Party contact number field must contain only numbers.',
                    'exact_length' => 'Party contact number field must be exactly {param} characters in length.',
                ],
                'customer_email' => [
                    'required' => 'Complainant email field is required.',
                    'valid_email' => 'Complainant email field must contain a valid email address.',
                ],
                'customer_contact' => [
                    'required' => 'Complainant mobile field is required.',
                    'numeric' => 'Complainant mobile field must contain only numbers.',
                    'exact_length' => 'Complainant mobile field must be exactly {param} characters in length.',
                ],
                'cases_priority' => [
                    'required' => 'Priority field is required.',
                    'in_list' => 'Priority field must be one of: Low, Medium, High.',
                ],
                'cases_assign_to' => [
                    'required' => 'Assign to field is required.',
                    'numeric' => 'Assign to field must contain only numbers.',
                ],
                'case_files_file' => [
                    'uploaded' => 'Files field is required.',
                    'ext_in' => 'One of the uploaded file does not have a valid file extension.',
                ],
            ]);

            if (!$validation->run($this->request->getPost())) {
                return redirect()->route('employee.add_case')->with('error', COMMON_VALIDATION_ERROR_MSG)->withInput($this->request->getPost());
            } else {
                $customer_data = [
                    'customer_email_id' => $this->request->getPost('customer_email'),
                    'customer_mobile_no' => $this->request->getPost('customer_contact'),
                    'customer_email_password' => generateStrongPassword(),
                    'createdby_type' => $currentEmployee['employee_usertype'],
                    'created_by' => $currentEmployee['employee_user_id'],
                ];
                $customer_id = $this->Cases_m->create_customer($customer_data);

                $case_data = [
                    'cases_priority' => $this->request->getPost('cases_priority'),
                    'cases_title' => $this->request->getPost('cases_title'),
                    'cases_message' => $this->request->getPost('cases_message'),
                    'cases_assign_to' => $this->request->getPost('cases_assign_to'),
                    'cases_dt_created' => date("Y-m-d H:i:s"),
                    'refCustomer_id' => $customer_id,
                    'createdby_user_type' => 'employee',
                    'created_by' => $currentEmployee['employee_user_id'],
                    'cases_party_name' => $this->request->getPost('cases_party_name'),
                    'cases_party_address' => $this->request->getPost('cases_party_address'),
                    'cases_party_number' => $this->request->getPost('cases_party_number'),
                    'customer_email' => $this->request->getPost('customer_email'),
                    'customer_contact' => $this->request->getPost('customer_contact'),
                    'case_no' => $this->request->getPost('case_no'),
                ];

                $res =  $this->Cases_m->create_case($case_data);
                if ($res) {
                    if ($howToContact === 'Email' || $howToContact === 'Both') {
                        $email_data = [
                            'mail_title' => 'New case is created based on your request.',
                            'link_title' => 'View case details by clicking this link ',
                            'case_link' => FRONT_VIEW_CASES_LINK . $res,
                        ];

                        $sendmail = new \SMTP_mail();
                        $sendmail->sendCommentDetails($_POST['customer_email'], $email_data);
                    }

                    if (($_FILES['case_files_file']['name'][0]) != '') {
                        $cases_files = multiFileUpload('case_files_file', $res . '/');
                        $i = 0;
                        foreach ($cases_files as $row) {
                            $params = array();
                            $params['refCases_id'] = $res;
                            $params['case_files_title'] = $_POST['title_file'][$i];
                            $params['case_files_desc'] = $_POST['desc_file'][$i];
                            $params['case_files_name'] = $row[2]['original_file_name'];
                            $params['case_files_unique_name'] = $row[2]['file_name'];
                            $params['case_files_size'] = $row[2]['file_size'];
                            $params['case_files_ext'] = $row[2]['file_ext'];
                            $params['case_files_type'] = "main";
                            $this->Cases_m->add_cases_files($params);
                            $i = $i + 1;
                        }
                    }

                    $params = array();
                    $params['refCases_id'] = $res;
                    $params['comment_type'] = 'assign';
                    $params['comment_from'] = $_SESSION['employee']['employee_user_id'];
                    $params['comment_to'] = $this->request->getPost('cases_assign_to');
                    $params['comment_from_usertype'] = 'employee';
                    $params['comment_to_usertype'] = 'employee';
                    $params['comment_datetime'] = date("Y-m-d H:i:s");
                    $this->Cases_m->add_cases_comment($params);
                } else {
                    successOrErrorMessage("Somthing happen wrong plz try again", 'error');
                    return redirect()->route('employee.add_case')->with('error', 'Somthing happen wrong plz try again.');
                }

                successOrErrorMessage("Data added successfully", 'success');
                return redirect()->route('employee.add_case')->with('success', 'Request sent successfully.');
            }
        }

        if ($this->request->getMethod() == 'get') {
            helper('form');
            $data['res_employee'] = $this->Cases_m->get_employee();
            $data['title'] = EMPLOYEE_ADD_CASES_TITLE;
            $data['validation'] = $validation;
            echo employee_view('employee/add_cases', $data);
        }
    }

    public function cases_list()
    {
        if ($this->request->getMethod() === 'post') {
            $db = \Config\Database::connect();

            $offset = (int) $this->request->getVar('start') ?? 0;
            $limit = (int) $this->request->getVar('length') ?? 10;
            $searchValue = $this->request->getVar('search.value');
            $orderColumn = (int) $this->request->getVar('order[0][column]');
            $orderDir = $this->request->getVar('order[0][dir]') ?? 'asc';

            $columns = [
                null, // index – not orderable
                'cs.case_no',
                null, // complainant_name – virtual
                'cs.cases_party_name',
                'cs.cases_title',
                'cs.cases_priority',
                'emp.user_firstname', // or 'cs.cases_assign_to'
                'cs.cases_status',
                null, // hearing_date – comes from a subquery
                'cs.cases_dt_created',
                null, // action – not orderable
            ];

            // Total records
            $total = $db->table('cases')->countAll();

            // Builder for filtered data
            $builder = $db->table('cases cs');
            $builder->select('cs.cases_id, cs.cases_priority, cs.case_no, cs.cases_title, cs.cases_assign_to, cs.cases_status, cs.cases_dt_created, cs.is_block_user, cs.cases_party_name, emp.user_firstname, emp.user_lastname');
            $builder->join('employee emp', 'emp.employee_user_id = cs.cases_assign_to', 'left');

            // Search filter
            if ($searchValue) {
                $builder->groupStart();
                $builder->like('cs.case_no', $searchValue);
                $builder->orLike('cs.cases_party_name', $searchValue);
                $builder->orLike('cs.cases_title', $searchValue);
                $builder->groupEnd();
            }

            // Cloning builder for filtered count
            $filteredBuilder = clone $builder;
            $filtered = $filteredBuilder->countAllResults();

            // Ordering
            if (isset($columns[$orderColumn]) && $columns[$orderColumn] !== null) {
                $builder->orderBy($columns[$orderColumn], $orderDir);
            } else {
                $builder->orderBy('cs.cases_id', 'DESC');
            }

            $builder->limit($limit, $offset);
            $results = $builder->get()->getResult();

            $list = [];

            foreach ($results as $key => $row) {
                $statusClass = $this->getStatusBadgeClass($row->cases_status);

                // Get latest hearing date
                $hearingBuilder = $db->table('comment');
                $hearingBuilder->select('comment_hearing_date')
                    ->where('refCases_id', $row->cases_id)
                    ->orderBy('comment_id', 'desc')
                    ->limit(1);
                $hearingResult = $hearingBuilder->get()->getResult();
                $hearing = !empty($hearingResult) ? $hearingResult[0]->comment_hearing_date : '-';

                $list[] = [
                    "index" => $key + 1,
                    "case_no" => esc($row->case_no),
                    "complainant_name" => "", // Placeholder
                    "cases_party_name" => esc($row->cases_party_name),
                    "cases_title" => esc($row->cases_title),
                    "cases_priority" => esc($row->cases_priority),
                    "assignee" => $row->cases_assign_to == 0 ? "Unassigned" : esc($row->user_firstname . " " . $row->user_lastname),
                    "cases_status" => "<span class=\"badge badge-pill {$statusClass}\">" . strtoupper($row->cases_status) . "</span>",
                    "hearing_date" => $hearing,
                    "cases_dt_created" => $row->cases_dt_created,
                    "action" => view('partials/case_action_buttons', ['row' => $row]),
                ];
            }

            return $this->respond([
                'draw' => (int) $this->request->getVar('draw'),
                'recordsTotal' => $total,
                'recordsFiltered' => $filtered,
                'data' => $list,
            ]);
        }

        if ($this->request->getMethod() === 'get') {
            $data['title'] = EMPLOYEE_LIST_CASES_TITLE;
            return view('pages/admin/employee/case-list', $data);
        }
    }

    /**
     * Helper to return badge class for a status
     */
    private function getStatusBadgeClass($status)
    {
        switch ($status) {
            case 'open':
                return 'badge-success';
            case 'closed':
                return 'badge-danger';
            case 'inprogress':
                return 'badge-warning';
            default:
                return 'badge-secondary';
        }
    }



    public function add_comment()
    {
        $validation = $this->_validation;

        $validation->reset();
        $validation->setRules([
            'cases_id' => 'required|numeric',
            'customer_id' => 'required|numeric',
            'cases_message' => 'required',
            'cases_hearing_date' => 'required_without[cases_status]|valid_date',
            'case_files_file' => 'ext_in[case_files_file,pdf,jpg,jpeg,png]',
            'last_comment_id' => 'required|numeric',
        ]);

        if (!$validation->run($this->request->getPost())) {
            $errors = $validation->getErrors();
            return $this->respond($errors, 400);
        } else {
            $message = "fail";
            $comments = "";
            $close_sts = 'no';

            if (!empty($this->request->getPost('cases_status'))) {
                $this->Cases_m->close_cases($this->request->getPost('cases_id'));
                successOrErrorMessage("Case is closed", 'success');
                $close_sts = 'yes';
            }

            $comment_data = [
                'refCases_id' => $this->request->getPost('cases_id'),
                'comment_description' => $this->request->getPost('cases_message'),
                'comment_type' => 'comment',
                'comment_from' => $_SESSION['employee']['employee_user_id'],
                'comment_to' => $this->request->getPost('customer_id'),
                'comment_from_usertype' => 'employee',
                'comment_to_usertype' => 'customer',
                'comment_datetime' => date("Y-m-d H:i:s"),
            ];

            if ($close_sts == 'no') {
                $comment_data['comment_hearing_date'] = $this->request->getPost('cases_hearing_date');
            }

            $res = $this->Cases_m->add_cases_comment($comment_data);

            if ($res) {
                include APPPATH . 'ThirdParty/smtp_mail/smtp_send.php';
                $data['cases_res'] = $this->Cases_m->get_single_cases($this->request->getPost('cases_id'));
                if ($data['cases_res']['customer_email'] != '') {
                    $email_data = array();
                    $email_data['mail_title'] = 'HPSHRC Employee is commented on your case.';
                    $email_data['link_title'] = 'View comment by clicking this link ';
                    if ($close_sts == 'yes') {
                        $email_data['mail_title'] = 'HPSHRC Employee closed your case.';
                        $email_data['link_title'] = 'View case details by clicking this link ';
                    }
                    $email_data['case_link'] = FRONT_VIEW_CASES_LINK . $this->request->getPost('cases_id');
                    $sendmail = new \SMTP_mail();
                    $sendmail->sendCommentDetails($data['cases_res']['customer_email'], $email_data);
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
            $result['case_sts'] = $close_sts;

            return $this->respond($result);
        }
    }

    public function view_cases($case_id)
    {
        helper('form');
        $data['caseDetails'] = $this->Cases_m->get_view_cases($case_id);
        $data['fileDetails'] = $this->Cases_m->get_file_details($case_id);
        $data['involved_peopel'] = $this->Cases_m->get_involved_peopel($case_id);
        $data['comments'] = $this->comment_list($case_id);
        $data['title'] = EMPLOYEE_VIEW_CASES_TITLE;
        return view('pages/admin/employee/employee-view', $data);
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
            $i = 0;
            foreach ($comments as $crow) {
                $i = $i + 1;
                $lastcomment = '';
                $from_name = '';
                $datavalue = 0;
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
                }
                if ($crow['comment_from_usertype'] == 'customer') {
                    $from_name = strtoupper(substr($crow['fhc_customer_first_name'], 0, 1) . substr($crow['fhc_customer_last_name'], 0, 1));
                    $from_short_name = $crow['fhc_customer_first_name'] . ' ' . $crow['fhc_customer_last_name'] . ' (Complainant)';
                    if ($crow['fhc_customer_first_name'] == '') {
                        $from_short_name = 'Guest (Complainant)';
                    }
                }
                $return_str .= '<div class="nk-reply-item' . $lastcomment . '" data-value="' . $datavalue . '">                               
                            <div class="nk-reply-header">';
                $return_str .= '<div class="user-card">
                                    <div class="user-avatar sm bg-blue">
                                        <span>' . $from_name . '</span>
                                    </div>
                                    <div class="user-name">' . $from_short_name . '</div>
                                </div>                                                              
                                <div class="date-time">' . $date . '</div>
                            </div>
                            <div class="nk-reply-body">
                                <div class="nk-reply-entry entry">';
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
                    $return_str .= '<strong class="assign-title">Assign to</strong> @' . $assign_to_name;
                }
                if ($crow['comment_type'] == 'reassign') {
                    $re_assign_to_name = $crow['t_user_firstname'] . ' ' . $crow['t_user_lastname'];
                    $return_str .= '<strong class="assign-title">Reassign to</strong> @' . $re_assign_to_name;
                }
                $return_str .= '</div>';
                if (!empty($crow['comment_file'])) {
                    $return_str .= '<div class="attach-files">
                                    <ul class="attach-list">';
                    foreach ($crow['comment_file'] as $cfrow) {
                        $ext = $cfrow['case_files_ext'];
                        if ($ext == 'pdf') {
                            $ext = 'file';
                        } else {
                            $ext = 'img';
                        }
                        $return_str .= '<li class="attach-item">';
                        $file_url = 'UPLOAD_FOLDER' . 'doc/' . $case_id . '/' . $cfrow['case_files_unique_name'];
                        $file_name = $cfrow['case_files_name'];
                        $return_str .= '<a class="download" target="_blank" href="' . $file_url . '"><em class="icon ni ni-' . $ext . '"></em><span>' . $file_name . '</span></a>
                                        </li>';
                    }
                    $return_str .= '</ul>                                    
                                </div>';
                }
                $return_str .= '</div>                                                            
                        </div><!-- .nk-reply-item -->
                        <div class="nk-reply-meta">
                            <div class="nk-reply-meta-info"><strong>' . $datetime . '</strong></div>
                        </div><!-- .nk-reply-meta -->';
            }
        }
        return $return_str;
    }

    //     public function load_more_comment_list() {        
    //        $result = array();
    //        $result['comments'] = $this->comment_list($_POST['case_id'],$_POST['last_comment_id']);
    //        echo json_encode($result);
    //     }                
}
