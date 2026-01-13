<?php
namespace App\Controllers;

use App\Models\Adminm\Login_m;
use CodeIgniter\API\ResponseTrait;

class Admin_c extends BaseController {
    use ResponseTrait;

    private $Login_m;
    private $security;     
    protected $session;
    public function __construct() {   
        $this->session = \Config\Services::session();
        $this->session->start();         
        helper('url');
        helper('functions');
        sessionCheckAdmin();        
        $this->Login_m = new Login_m();
        $this->security = \Config\Services::security();
        if (isset($_SESSION['admin']['admin_user_id'])) {            
                $result = $this->Login_m->getTokenAndCheck('admin', $_SESSION['admin']['admin_user_id']);
                if ($result) {
                    $token = $result['token'];
                    if ($_SESSION['admin']['admin_tokencheck'] != $token) {                                                                       
                            logoutUser('admin');
                            header('Location: ' . ADMIN_LOGIN_LINK);
                            exit();                        
                    }   
                }else{
                    logoutUser('admin');
                    header('Location: ' . ADMIN_LOGIN_LINK);
                    exit();
                }            
        }        
    }
    public function dashboard() {
        $data['totaluser']=$this->Login_m->count_data1('hpshrc_customer','customer_id');
        $data['totalactiveuser']=$this->Login_m->count_data('hpshrc_customer','customer_id','customer_status','ACTIVE');
        $data['totalinactiveuser']=$this->Login_m->count_data('hpshrc_customer','customer_id','customer_status','REMOVED');
        
        $data['totalcases']=$this->Login_m->count_data1('cases','cases_id');
        $data['totalopencases']=$this->Login_m->count_data('cases','cases_id','cases_status','open');
        $data['totalclosedcases']=$this->Login_m->count_data('cases','cases_id','cases_status','closed');  
        
        $data['title'] = ADMIN_DASHBOARD_TITLE;
        return view('pages/admin/admin-dashboard', $data);                
    }
    
    public function update_profile() {
        $validation = \Config\Services::validation();
        if ($this->request->getMethod() == 'post') {

            $validation->reset();
            $rules = [
                'user_current_password' => 'required',
                'user_new_password' => 'required|min_length[8]',
                'user_confirm_password' => 'required|matches[user_new_password]'
            ];
            $validation->setRules($rules, [
                'user_current_password' => [
                    'required' => 'The current password field is required',
                ],
                'user_new_password' => [
                    'required' => 'The new password field is required',
                    'min_length' => 'Password field must be at least {param} characters in length.',

                ],
                'user_confirm_password' => [
                    'required' => 'The confirm password field is required',
                    'matches' => 'Password does not match.'
                ]

            ]);

            if (!$validation->run($this->request->getPost())) {
                return redirect()->route('admin.update')->with('error', COMMON_VALIDATION_ERROR_MSG)->withInput($this->request->getPost());
            } else {
                $result = array();
                if ($this->Login_m->check_current_password($_POST['user_current_password'])) {
                    $res = $this->Login_m->update_password(['user_new_password' => $this->request->getPost('user_new_password')]);
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
            $data['title'] = ADMIN_UPDATE_PROFILE_TITLE;
            $data['validation'] = $validation;
           return view('pages/admin/update-profile', $data);
        }
    }
}
