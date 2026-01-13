<?php

namespace App\Controllers;

use App\Models\Employeem\Customers_m;
use App\Models\Adminm\Login_m;
use App\Models\Common_m;
use App\ThirdParty\smtp_mail\SMTP_mail;
use CodeIgniter\API\ResponseTrait;

class Customers_a extends BaseController {
    use ResponseTrait;

    private $Customers_m;
    private $Login_m;
    private $security;
    private $Common_m;
    private $_validation;

    protected $session;
    public function __construct() {   
        $this->session = \Config\Services::session();
        $this->session->start(); 
        helper('url');
        helper('functions');
        $this->security = \Config\Services::security();        
        sessionCheckAdmin();
        $this->Common_m = new Common_m();
        $this->Customers_m = new Customers_m();
        $this->Login_m = new Login_m();
        $this->_validation = \Config\Services::validation();
        if (isset($_SESSION['admin']['admin_user_id'])) {            
            $result = $this->Login_m->getTokenAndCheck('admin', $_SESSION['admin']['admin_user_id']);
            if ($result) {
                $token = $result['token'];
                if ($_SESSION['admin']['admin_tokencheck'] != $token) {                                                                       
                        logoutUser('admin');
                        header('Location: ' . ADMIN_LOGIN_LINK);
                        exit();                        
                }   
            }
            else{
                    logoutUser('admin');
                    header('Location: ' . ADMIN_LOGIN_LINK);
                    exit();
                }
        } 
    }
    public function customers_list() {
        $searchValue = $this->request->getVar('search.value');

        if ($this->request->getMethod() == 'post') {
            $db = \Config\Database::connect();
            $view = \Config\Services::renderer();

            $offset = (int) $this->request->getVar('start') ?? 0;
            $limit = (int) $this->request->getVar('length') ?? 10;
            $order = '';
            $column = '';

            if ($this->request->getVar('order')) {
                foreach ($this->request->getVar('order') as $req) {
                    if ($req['dir']) {
                        $order = $req['dir'];
                    }
        
                    switch ($req['column']) {
                        case 1:
                            $column = 'hc.customer_first_name';
                            break;
                        case 2:
                            $column = 'hc.customer_father_name';
                            break;
                        case 3:
                            $column = 'customer_mobile_no';
                            break;
                        default:
                            $column = '';
                            break;
                    }
                }
            }

            $total = $db->table('hpshrc_customer hc')->countAll();

            $builder = $db->table('hpshrc_customer hc');
            $builder->select('hc.customer_id, hc.customer_first_name, hc.customer_middle_name, hc.customer_last_name, hc.customer_father_name, hc.customer_gender, hc.customer_dob,hc.customer_mobile_no, hc.customer_email_id,hc.customer_email_verified_status, hc.customer_locked_status, hc.customer_status');
            // $builder->where('huf.upload_file_status', 'ACTIVE');
            if ($searchValue) {
                $builder->groupStart();
                $builder->like('hc.customer_first_name', $searchValue);
                $builder->orLike('hc.customer_father_name', $searchValue);
                $builder->orLike('hc.customer_email_id', $searchValue);
                $builder->groupEnd();
            }
    
            $filtered = (clone $builder)->countAllResults();

            if ($order && $column) {
                $builder->orderBy($column, $order);
            }

            // $builder->join('hpshrc_categories hc', 'hc.category_code = huf.upload_file_type');
            $builder->limit($limit, $offset);
            $query = $builder->get();
            $results = $query->getResult();

            $list = array();

            if (! empty($results)) {
                foreach ($results as $key => $row) {
                    $customer_id = $row->customer_id;
                    $title = 'Click to unverify email';
                    $class0 = 'btn_approve_reject_email btn btn-xs btn-success';
                    $text = "Email Verified <i class='fa fa-check'></i>";
                    $isactive = 1;
                    $table = 'hpshrc_customer';
                    $table_update_field = 'customer_email_verified_status';
                    $table_where_field = 'customer_id';
                    if ($row->customer_email_verified_status == 0) {
                        $title = 'Click to verify email';
                        $class0 = 'btn_approve_reject_email btn btn-xs btn-danger';
                        $text  = "Verify Email <i class='fa fa-close'></i>";
                        $isactive = 0;
                    }

                    $title1 = 'Click to locke customer';
				    $class1 = 'btn_lock_unlock_customer btn btn-xs btn-success';
				    $text1 = "Customer Unlocked <i class='fa fa-unlock'></i>";
				    $isactive1 = 1;
				    $table = 'hpshrc_customer';
				    $table_update_field1 = 'customer_locked_status';
				    $table_where_field1 = 'customer_id';
				    if ($row->customer_locked_status == 1) {
					    $title1 = 'Click to unlocke customer';
					    $class1 = 'btn_lock_unlock_customer btn btn-xs btn-danger';
					    $text1  = "Customer Locked <i class='fa fa-lock'></i></em>";
					    $isactive1 = 0;
				    }
                   

                    $title2 = 'Click to inactive customer';
				    $class2 = 'btn_active_inactive_customer btn btn-xs btn-success';
				    $text2 = "Customer Activated <i class='fa fa-check'></i>";
				    $isactive2 = "REMOVED";
				    $table = 'hpshrc_customer';
				    $table_update_field2 = 'customer_status';
				    $table_where_field2 = 'customer_id';
				    if ($row->customer_status == "REMOVED") {
                        $title2 = 'Click to active customer';
                        $class2 = 'btn_active_inactive_customer btn btn-xs btn-danger';
                        $text2  = "Customer Inactivated <i class='fa fa-close'></i>";
                        $isactive2 = "ACTIVE";
				    }
                     $list[$key] = [   
                        "index" => $key + 1,
                        "customer_first_name" => $row->customer_first_name,
                        "customer_middle_name" => $row->customer_middle_name,
                        "customer_last_name" => $row->customer_last_name,
                        "customer_father_name" => $row->customer_father_name,
                        "customer_gender" => $row->customer_gender, 
                        "customer_dob" => $row->customer_dob,
                        "customer_mobile_no" => $row->customer_mobile_no,
                        "customer_email_id" => $row->customer_email_id,
                        "action" => "<a href=\"". base_url(route_to('admin.edit_customer', $row->customer_id)) ."\"class=\"btn btn-xs btn-warning\">Edit  <em class=\"icon ni ni-edit-fill\"></em></a> <button type=\"button\" data-id=\"" . $customer_id . "\" data-status = \"" . $isactive. "\" title=\"" . $title . "\" class=\"" . $class0 . "\" data-table = \"" . $table . "\" data-updatefield = \"" . $table_update_field . "\" data-wherefield = \"" . $table_where_field . "\"> " . $text . "</button><button type='button' data-id='" . $customer_id . "' data-status = '" . $isactive1 . "' title='" . $title1 . "' class='" . $class1 . "' data-table = '" . $table . "' data-updatefield = '" . $table_update_field1 . "' data-wherefield = '" . $table_where_field1 . "'>" . $text1 . "</button> <button type='button' data-id='" . $customer_id . "' data-status = '" . $isactive2 . "' title='" . $title2 . "' class='" . $class2 . "' data-table = '" . $table . "' data-updatefield = '" . $table_update_field2 . "' data-wherefield = '" . $table_where_field2 . "'>" . $text2 . "</button> ",
                        
                     ];
                }
            }

            return $this->respond([
                'draw' => $this->request->getVar('draw'),
                'recordsTotal' => $total,
                'recordsFiltered' => $filtered,
                'data' => (! empty($list)) ? $list : [],
            ]);
        }

        if($this->request->getMethod() == 'get'){
          $data['title'] = ADMIN_CUSTOMER_LIST_TITLE;
          //echo admin_view('adminside/customer/customers_list', $data);
          return view('pages/admin/customer/customer_list', $data);
        }
    }

    public function approve_status() {
        $validation = $this->_validation;

        $validation->reset();
        $validation->setRules([
            'table_id' => 'required|numeric',
            'user_status' => 'required|in_list[ACTIVE,REMOVED,0,1]',
            'table' => 'required',
            'updatefield' => 'required',
            'wherefield' => 'required',
        ]);

        if (!$validation->run($this->request->getPost())) {
            $errors = $validation->getErrors();
            return $this->respond($errors, 400);
        } else {
            $params = [
                'table_id' => $this->request->getPost('table_id'),
                'user_status' => $this->request->getPost('user_status'),
                'table' => $this->request->getPost('table'),
                'updatefield' => $this->request->getPost('updatefield'),
                'wherefield' => $this->request->getPost('wherefield'),
            ];

            $res = $this->Customers_m->approve_status($params);

            if ($res) {
                $data['suceess'] = true;
            } else {
                $data['suceess'] = false;
            }

            return $this->respond($data, 200);
        }
    }


    public function create_customer() {
        $validation = $this->_validation;

        $_SESSION['exist_email'] = 0;

        if ($this->request->getMethod() == 'post') {
            include APPPATH . 'ThirdParty/smtp_mail/smtp_send.php';

            $validation->reset();
            $validation->setRules([
                'customer_first_name' => 'required|alpha',
                'customer_middle_name' => 'permit_empty|alpha',
                'customer_last_name' => 'required|alpha',
                'customer_father_name' => 'required|alpha_space',
                'customer_mobile_no' => 'required|numeric|exact_length[10]',
                'customer_email_id' => 'required|valid_email|is_unique[hpshrc_customer.customer_email_id]',
                'customer_dob' => 'required|valid_date',
                'customer_gender' => 'required|in_list[M,F,O]',
            ], [
                'customer_first_name' => [
                    'required' => 'First name field is required.',
                    'alpha' => 'First name field may only contain alphabetical characters.',
                ],
                'customer_middle_name' => [
                    'alpha' => 'Middle name field may only contain alphabetical characters.'
                ],
                'customer_last_name' => [
                    'required' => 'Last name field is required.',
                    'alpha' => 'Last name field may only contain alphabetical characters.'
                ],
                'customer_father_name' => [
                    'required' => 'Father name field is required.',
                    'alpha_space' => 'Father name field may only contain alphabetical characters and spaces.'
                ],
                'customer_mobile_no' => [
                    'required' => 'Mobile number field is required.',
                    'numeric' => 'Mobile number field must contain only numbers.',
                    'exact_length' => 'Mobile number field must be exactly {param} characters in length.',
                ],
                'customer_email_id' => [
                    'required' => 'Email field is required.',
                    'valid_email' => 'Email field must contain a valid email address.',
                    'is_unique' => 'Email field must contain a unique value.',
                ],
                'customer_dob' => [
                    'required' => 'Date of birth field is required.',
                    'valid_date' => 'Date of birth field must contain a valid date.',
                ],
                'customer_gender' => [
                    'required' => 'Gender field is required.',
                    'in_list' => 'Gender field must be one of: Male, Female, Other.'
                ],
            ]);

            if (!$validation->run($this->request->getPost())) {
                return redirect()->to(ADMIN_CUSTOMER_REGISTER_LINK)->with('error', COMMON_VALIDATION_ERROR_MSG)->withInput($this->request->getPost());
            } else {
                $params = [
                    'customer_first_name' => $this->request->getPost('customer_first_name'),
                    'customer_middle_name' => $this->request->getPost('customer_middle_name'),
                    'customer_last_name' => $this->request->getPost('customer_last_name'),
                    'customer_father_name' => $this->request->getPost('customer_father_name'),
                    'customer_mobile_no' => $this->request->getPost('customer_mobile_no'),
                    'customer_email_id' => $this->request->getPost('customer_email_id'),
                    'customer_email_password' => generateStrongPassword(),
                    'customer_dob' => $this->request->getPost('customer_dob'),
                    'customer_gender' => $this->request->getPost('customer_gender'),
                ];

                $_SESSION['post_data'] = $_POST;

                $res =  $this->Common_m->register_customer($params);

                $result = array();
                $send_email_error = 0;

                if ($res['success'] == true) {
                    $result['success'] = 'success';
                    $link_code = gen_uuid($res['customer_id'], 'e');
                    $email_active_link = CUSTOMER_ACTIVE_EMAIL_LINK . 'customer/' . $link_code;
                    $result['success'] = 'success';
                    $data = array(
                        'username' => $res['email'],
                        'password' => $_POST['customer_email_password'],
                        'template' => 'studentRegistrationTemplate.html',
                        'activationlink' => $email_active_link
                    );
                    $sendmail = new \SMTP_mail();
                    $resMail = $sendmail->sendRegistrationDetails($res['email'], $data);       
                    if ($resMail['success'] == 1) {
                        $params = array();
                        $params['user_id'] = $res['customer_id'];
                        $params['link_code'] = $link_code;
                        $params['user_type'] = 'customer';
                        $this->Common_m->user_email_link($params);
                    } else {
                        $_SESSION['send_email_error'] = 1;
                        $send_email_error = 1;
                    }
                } else {
                    if (isset($res['email_exist'])) {
                        if ($res['email_exist'] == true) {
                            $_SESSION['exist_email'] = 1;
                            $result['exist_email'] = 1;
                        }
                    }
                    $result['success'] = 'fail';
                }

                if ($result['success'] == 'success' && $send_email_error == 1) {
                    $_SESSION['registration'] = 1;
                }

                if ($result['success'] == 'success' && $send_email_error == 0) {
                    $_SESSION['registration'] = 2;
                }

                if ($result['success'] == 'fail') {                
                    $_SESSION['registration'] = 3;
                }

                if ($result['success']=="success") {
                    if (isset($_SESSION['post_data'])) {
                        unset($_SESSION['post_data']);
                    }
                }

                return redirect()->to(ADMIN_CUSTOMER_LIST_LINK);
            }
        }

        if ($this->request->getMethod() == 'get') {
            if (isset($_SESSION['post_data'])) {
                unset($_SESSION['post_data']);
            }

            helper('form');
            $data['title'] = CUSTOMER_REGISTRATION_TITLE;
            $data['validation'] = $validation;
            //echo admin_view('adminside/customer/user_registration', $data);
            return view('pages/admin/user_registration', $data);
        }
    }
    
    public function edit_customer($customer_id) {
        $validation = $this->_validation;

        if ($this->request->getMethod() == 'post') {
            $validation->reset();
            $validation->setRules([
                'customer_first_name' => 'required|alpha',
                'customer_middle_name' => 'permit_empty|alpha',
                'customer_last_name' => 'required|alpha',
                'customer_father_name' => 'required|alpha_space',
                'customer_mobile_no' => 'required|numeric|exact_length[10]',
                'customer_email_id' => 'required|valid_email|is_unique[hpshrc_customer.customer_email_id,customer_id,' . $customer_id . ']',
                'customer_dob' => 'required|valid_date',
                'customer_gender' => 'required|in_list[M,F,O]',
            ], [
                'customer_first_name' => [
                    'required' => 'First name field is required.',
                    'alpha' => 'First name field may only contain alphabetical characters.',
                ],
                'customer_middle_name' => [
                    'alpha' => 'Middle name field may only contain alphabetical characters.'
                ],
                'customer_last_name' => [
                    'required' => 'Last name field is required.',
                    'alpha' => 'Last name field may only contain alphabetical characters.'
                ],
                'customer_father_name' => [
                    'required' => 'Father name field is required.',
                    'alpha_space' => 'Father name field may only contain alphabetical characters and spaces.'
                ],
                'customer_mobile_no' => [
                    'required' => 'Mobile number field is required.',
                    'numeric' => 'Mobile number field must contain only numbers.',
                    'exact_length' => 'Mobile number field must be exactly {param} characters in length.',
                ],
                'customer_email_id' => [
                    'required' => 'Email field is required.',
                    'valid_email' => 'Email field must contain a valid email address.',
                    'is_unique' => 'Email field must contain a unique value.',
                ],
                'customer_dob' => [
                    'required' => 'Date of birth field is required.',
                    'valid_date' => 'Date of birth field must contain a valid date.',
                ],
                'customer_gender' => [
                    'required' => 'Gender field is required.',
                    'in_list' => 'Gender field must be one of: Male, Female, Other.'
                ],
            ]);

            if (!$validation->run($this->request->getPost())) {
                return redirect()->to(ADMIN_CUSTOMER_EDIT_LINK . $customer_id)->with('error', COMMON_VALIDATION_ERROR_MSG)->withInput($this->request->getPost());
            } else {
                $params = [
                    'customer_first_name' => $this->request->getPost('customer_first_name'),
                    'customer_middle_name' => $this->request->getPost('customer_middle_name'),
                    'customer_last_name' => $this->request->getPost('customer_last_name'),
                    'customer_father_name' => $this->request->getPost('customer_father_name'),
                    'customer_mobile_no' => $this->request->getPost('customer_mobile_no'),
                    'customer_email_id' => $this->request->getPost('customer_email_id'),
                    'customer_dob' => $this->request->getPost('customer_dob'),
                    'customer_gender' => $this->request->getPost('customer_gender'),
                ];

                $res =  $this->Common_m->edit_customer($params, $customer_id);                       

                if ($res['success'] == true) {
                    successOrErrorMessage("Data updated successfully", "success");          
                } else {
                    if (isset($res['email_exist'])) {
                        if ($res['email_exist'] == true) {
                            successOrErrorMessage("Email allready exist", "error");
                        }
                    }
                }

                return redirect()->to(ADMIN_CUSTOMER_EDIT_LINK . $customer_id);
            }
        }

        if ($this->request->getMethod() == 'get') {
            helper('form');
            $data['single_customer'] = $this->Common_m->get_single_customer($customer_id);
            $data['customer_id'] = $customer_id;
            $data['title'] = EDIT_CUSTOMER_TITLE;
            $data['validation'] = $validation;

           return view('pages/admin/customer/edit_customer', $data);
        }
    }
    
    public function verify_email($user_type, $link_code) {
        $user_id = gen_uuid($link_code, 'd');
        $res = $this->Common_m->chek_code_exist($user_id, $link_code, $user_type);
        $data['success'] = 0;
        if ($res) {
            $data['success'] = 1;
        }
        echo single_page('frontside/thankyou', $data);
    }

}
