<?php
namespace App\Controllers;

use App\Models\Employeem\Login_m;

class Elogin_c extends BaseController {

    private $Login_m; 
    protected $session;
    public function __construct() {   
        $this->session = \Config\Services::session();
        $this->session->start(); 
        helper('url');
        helper('functions');
        $this->Login_m = new Login_m();       
    }

    public function index() {
        $validation = \Config\Services::validation();  
        if ($this->request->getMethod() == 'post') {
            $validation->reset();
            $validation->setRules([
                'username' => 'required|valid_email',
                'password' => 'required',
            ]);
            
            if (! $validation->run($this->request->getPost())) {
                return redirect()->route('emp.login')->with('error', COMMON_VALIDATION_ERROR_MSG)->withInput($this->request->getPost());
            } else {
                $result = $this->Login_m->employee_login_select($_POST['username'], $_POST['password']);
                if ($result == true) {                
                    $userId = $_SESSION['employee']['employee_user_id'];
                    $userType = $_SESSION['employee']['employee_usertype'];
                    log_message('info', "$userType id $userId logged into the system");                
                    return redirect()->route('emp.dashboard');
                } else {
                    return redirect()->route('emp.login')->with('error', "Oops! Something went wrong.");
                }
            }
        }

        if ($this->request->getMethod() == 'get') {
            helper('form');

            if (isset($_SESSION['employee']['employee_user_id'])) {            
                if ($_SESSION['employee']['employee_user_id'] > 0) {                
                    logoutUser('employee');                 
                    return redirect()->route('emp.login');
                }
            }

            $data['title'] = EMPLOYEE_LOGIN_TITLE;
            $data['validation'] = $validation;
            return view('pages/admin/employee/login', $data);
        }   
    }

    public function logout() {
        logoutUser('employee');
        $this->session->destroy();
        return redirect()->route('emp.login');
    }

}
