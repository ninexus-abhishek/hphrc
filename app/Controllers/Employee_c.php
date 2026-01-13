<?php

namespace App\Controllers;

use App\Models\Adminm\Login_m;
use CodeIgniter\API\ResponseTrait;

class Employee_c extends BaseController
{
    use ResponseTrait;

    private $Login_m;
    private $security;
    protected $session;
    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->session->start();
        helper('url');
        helper('functions');
        $this->security = \Config\Services::security();
        sessionCheckEmployee();
        $this->Login_m = new Login_m();
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

    public function dashboard()
    {
        $data['totaluser'] = $this->Login_m->count_data1('hpshrc_customer', 'customer_id');
        $data['totalactiveuser'] = $this->Login_m->count_data('hpshrc_customer', 'customer_id', 'customer_status', 'ACTIVE');
        $data['totalinactiveuser'] = $this->Login_m->count_data('hpshrc_customer', 'customer_id', 'customer_status', 'REMOVED');

        $data['totalcases'] = $this->Login_m->count_data1('cases', 'cases_id');
        $data['totalopencases'] = $this->Login_m->count_data('cases', 'cases_id', 'cases_status', 'open');
        $data['totalclosedcases'] = $this->Login_m->count_data('cases', 'cases_id', 'cases_status', 'closed');
        $data['title'] = EMPLOYEE_DASHBOARD_TITLE;
        return view('pages/admin/employee/dashboard', $data);
    }

    public function update_profile()
    {
        $validation = \Config\Services::validation();
        if ($this->request->getMethod() == 'post') {
            $validation->reset();

            $validation->setRules([
                'user_current_password' => 'required',
                'user_new_password' => 'required|min_length[8]',
                'user_confirm_password' => 'required|matches[user_new_password]',
            ], [
                'user_current_password' => [
                    'required' => 'The current password field is required.',
                ],
                'user_new_password' => [
                    'required' => 'The new password field is required.',
                    'min_length' => 'The new password field must be at least {param} characters in length.'
                ],
                'user_confirm_password' => [
                    'required' => 'The confirm password field is required.',
                    'matches' => 'The confirm password field does not match the new password field.'
                ],
            ]);

            if (!$validation->run($this->request->getPost())) {
                return redirect()->route('emp.profile')->with('error', COMMON_VALIDATION_ERROR_MSG)->withInput($this->request->getPost());
            } else {
                if ($this->Login_m->check_emp_current_password($_POST['user_current_password'])) {

                    $res = $this->Login_m->update_emp_password(['user_new_password' => $this->request->getPost('user_new_password')]);
                    if ($res) {
                        return redirect()->route('emp.profile')->with('success', 'Password changed successfully.');
                    }

                    return redirect()->route('emp.profile')->with('error', 'Oops! Something went wrong.');
                }

                return redirect()->route('emp.profile')->with('error', 'Old Password not matched!.');
            }
        }

        if ($this->request->getMethod() == 'get') {
            helper('form');
            $data['title'] = EMPLOYEE_UPDATE_PROFILE_TITLE;
            $data['validation'] = $validation;
            return view('pages/admin/employee/profile', $data);
        }
    }
}
