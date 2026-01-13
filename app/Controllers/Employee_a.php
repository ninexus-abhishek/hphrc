<?php

namespace App\Controllers;

use App\Models\Employeem\Customers_m;
use App\Models\Adminm\Login_m;
use App\Models\Common_m;
use CodeIgniter\API\ResponseTrait;

class Employee_a extends BaseController {
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
    public function employee_list() {
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
                            $column = 'emp.user_firstname';
                            break;
                        case 2:
                            $column = 'emp.user_email_id';
                            break;
                        case 3:
                            $column = 'emp.user_lastname';
                            break;
                        default:
                            $column = '';
                            break;
                    }
                }
            }

            $total = $db->table('employee emp')->countAll();

            $builder = $db->table('employee emp');
            $builder->select('emp.employee_user_id, emp.user_firstname, emp.user_lastname,emp.user_email_id,emp.user_email_verified_status,emp.user_locked_status,emp.user_status');
           
            if ($searchValue) {
                $builder->groupStart();
                $builder->like('emp.user_firstname', $searchValue);
                $builder->orLike('emp.user_lastname', $searchValue);
                $builder->orLike('emp.user_email_id', $searchValue);
                $builder->groupEnd();
            }
    
            $filtered = (clone $builder)->countAllResults();

            if ($order && $column) {
                $builder->orderBy($column, $order);
            }

          
            $builder->limit($limit, $offset);
            $query = $builder->get();
            $results = $query->getResult();

            $list = array();

            if (! empty($results)) {
                foreach ($results as $key => $row) {
                    $employee_id = $row->employee_user_id;
                    $title0 = 'Click to unverify email';
                    $class0 = 'btn_approve_reject_email btn btn-xs btn-success';
                    $text0 = "Email Verified <i class='fa fa-check'></i>";
                    $isactive0 = 1;
                    $table = 'hpshrc_customer';
                    $table_update_field = 'customer_email_verified_status';
                    $table_where_field = 'customer_id';
                    if ($row->user_email_verified_status == 0) {
                        $title0 = 'Click to verify email';
                        $class0 = 'btn_approve_reject_email btn btn-xs btn-danger';
                        $text0 = "Verify Email <i class='fa fa-close'></i>";
                        $isactive0 = 0;
                    }

                    $title1 = 'Click to locke employee';
                    $class1 = 'btn_lock_unlock_customer btn btn-xs btn-success';
                    $text1 = "Employee Unlocked <i class='fa fa-unlock'></i>";
                    $isactive1 = 1;
                    $table = 'employee';
                    $table_update_field = 'user_locked_status';
                    $table_where_field = 'employee_user_id';
                    if ($row->user_locked_status == 1) {
                        $title1 = 'Click to unlocke employee';
                        $class1 = 'btn_lock_unlock_customer btn btn-xs btn-danger';
                        $text1  = "Employee Locked <i class='fa fa-lock'></i></em>";
                        $isactive1 = 0;
                    }
                    $title2 = 'Click to inactive employee';
                    $class2 = 'btn_active_inactive_customer btn btn-xs btn-success';
                    $text2 = "Employee Activated <i class='fa fa-check'></i>";
                    $isactive2 = "REMOVED";
                    $table = 'employee';
                    $table_update_field = 'user_status';
                    $table_where_field = 'employee_user_id';
                    if ($row->user_status == "REMOVED") {
                        $title2 = 'Click to active employee';
                        $class2 = 'btn_active_inactive_customer btn btn-xs btn-danger';
                        $text2  = "Employee Inactivated <i class='fa fa-close'></i>";
                        $isactive2 = "ACTIVE";
                    }
                     $list[$key] = [   
                        "index" => $key + 1,
                        "user_firstname" => $row->user_firstname,
                        "user_lastname" => $row->user_lastname,
                        "user_email_id" => $row->user_email_id,
                        "action" => "<a href=\"". base_url(route_to('admin.edit_employee', $row->employee_user_id)) ."\"  class=\"btn btn-xs btn-warning\">Edit  <em class=\"icon ni ni-edit-fill\"></em></a> <button type=\"button\" data-id=\"" . $employee_id . "\" data-status = \"" . $isactive0. "\" title=\"" . $title0 . "\" class=\"" . $class0 . "\" data-table = \"" . $table . "\" data-updatefield = \"" . $table_update_field . "\" data-wherefield = \"" . $table_where_field . "\"> " . $text0 . "</button> <button type='button' data-id='" . $employee_id . "' data-status = '" . $isactive1 . "' title='" . $title1 . "' class='" . $class1 . "' data-table = '" . $table . "' data-updatefield = '" . $table_update_field . "' data-wherefield = '" . $table_where_field . "'>" . $text1 . "</button> <button type='button' data-id='" . $employee_id . "' data-status = '" . $isactive2 . "' title='" . $title2 . "' class='" . $class2 . "' data-table = '" . $table . "' data-updatefield = '" . $table_update_field . "' data-wherefield = '" . $table_where_field . "'>" . $text2 . "</button> ",
                        
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
        if($this->request->getMethod() == 'get') {
            $data['title'] = ADMIN_EMPLOYEE_LIST_TITLE; 
        return view('pages/admin/employee/employee-list', $data);
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
    
    
     public function create_employee() {
        $validation = $this->_validation;

        if ($this->request->getMethod() == 'post') {
            include APPPATH . 'ThirdParty/smtp_mail/smtp_send.php';
            $_SESSION['exist_email'] = 0;

            $validation->reset();
            $rules = [
                'user_firstname' => 'required|alpha',
                'user_lastname' => 'required|alpha',
                'user_email_id' => 'required|valid_email',
                'employee_roll' => 'required|in_list[executive,lead,manager,director,chairman]',
            ];
            $validation->setRules($rules, [
               'user_firstname' => [
                'required' => 'The user first name is required',
                'alpha' => 'User first name field may only contain alphabetical characters.',
               ], 
               'user_lastname' => [
                'required' => 'The  user last name is required',
                'alpha' => 'User last name field may only contain alphabetical characters.'
               ],
               'user_email_id' => [
                 'required'  => 'The user email is required',
                 'valid_email' => 'Email field must contain a valid email address.',
               ],
               'employee_roll' => [
                'required' => 'The employee roll is required',
                'in_list' => 'Gender field must be one of: Executive, lead, Manager,Director, Chairman .'
               ]
            ]);

            if (! $validation->run($this->request->getPost())) {
                return redirect()->route('admin.employee_registration')->with('error', COMMON_VALIDATION_ERROR_MSG)->withInput($this->request->getPost());
            } else {
                $params = [
                    'user_firstname' => $this->request->getPost('user_firstname'),
                    'user_lastname' => $this->request->getPost('user_lastname'),
                    'user_email_id' => $this->request->getPost('user_email_id'),
                ];

                $res =  $this->Common_m->register_employee($params);
                $result = array();
                $send_email_error = 0;
                if ($res['success'] == true) {
                    $this->Common_m->remove_employee_roll($res['employee_user_id']);
                    $roll_params=array();
                    $roll_params['refUser_id']=$res['employee_user_id'];                
                    for ($i=0;$i<count($userRoll);$i++){                
                        $roll_params['roll_title']=$userRoll[$i];
                        $this->Common_m->add_employee_roll($roll_params);                    
                    } 
                    $result['success'] = 'success';
                    $link_code = gen_uuid($res['employee_user_id'], 'e');
                    $email_active_link = EMPLOYEE_ACTIVE_EMAIL_LINK . $link_code;                
                    $data = array(
                        'username' => $res['email'],
                        'password' => $_POST['user_email_password'],
                        'template' => 'employeeRegistrationTemplate.html',
                        'activationlink' => $email_active_link
                    );
                    $sendmail = new \SMTP_mail();
                    $resMail = $sendmail->sendRegistrationDetails($res['email'], $data);       
                    if ($resMail['success'] == 1) {
                        $params = array();
                        $params['user_id'] = $res['employee_user_id'];
                        $params['link_code'] = $link_code;
                        $params['user_type'] = 'employee';
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

                return redirect()->route('admin.employee_registration');
            }
        }

        if ($this->request->getMethod() == 'get') {
            if(isset($_SESSION['post_data'])){
                unset($_SESSION['post_data']);
            }

            helper('form');
            $data['title'] = ADMIN_EMPLOYEE_REGISTRATION_TITLE;
            $data['validation'] = $validation;
            return view('pages/admin/employee/employee-registration', $data);
        }
    }
    
    public function edit_employee($employee_id) {     
        $validation = $this->_validation;
        
        if ($this->request->getMethod() == 'post') {
            $validation->reset();
            $validation->setRules([
                'user_firstname' => 'required|alpha',
                'user_lastname' => 'required|alpha',
                'user_email_id' => 'required|valid_email',
                'employee_roll' => 'required|in_list[executive,lead,manager,director,chairman]',
            ]);

            if (! $validation->run($this->request->getPost())) {
                return redirect()->route('admin.edit_employee' . $employee_id)->with('error', COMMON_VALIDATION_ERROR_MSG)->withInput($this->request->getPost());
            } else {
                $userRoll = $this->request->getPost('employee_roll');

                $params = [
                    'user_firstname' => $this->request->getPost('user_firstname'),
                    'user_lastname' => $this->request->getPost('user_lastname'),
                    'user_email_id' => $this->request->getPost('user_email_id'),
                    // 'employee_roll' => $this->request->getPost('employee_roll'),
                ];

                $this->Common_m->remove_employee_roll($employee_id);

                $roll_params=array();
                $roll_params['refUser_id']= $employee_id;                        
                for ($i = 0; $i < count($userRoll); $i++){                  
                    $roll_params['roll_title']=$userRoll[$i];
                    $this->Common_m->add_employee_roll($roll_params);                
                }

                $res =  $this->Common_m->edit_employee($params,$employee_id);

                if ($res['success'] == true) {
                    successOrErrorMessage("Data updated successfully", "success");          
                } else {
                    if (isset($res['email_exist'])) {
                        if ($res['email_exist'] == true) {
                            successOrErrorMessage("Email allready exist", "error");
                        }
                    }                
                }

                return redirect()->route('admin.edit_employee' . $employee_id);
            }
        }

        if ($this->request->getMethod() == 'get') {
            helper('form');
            $data['employee_roll']=$this->Common_m->get_employee_roll($employee_id);       
            $data['single_employee']=$this->Common_m->get_single_employee($employee_id);
            $data['employee_id'] = $employee_id;        
            $data['title'] = ADMIN_EDIT_EMPLOYEE_TITLE;
            $data['validation'] = $validation;           
            //echo admin_view('adminside/employee/edit_employee', $data);
            return view('pages/admin/employee/edit_employee', $data);
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
