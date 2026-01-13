<?php

namespace App\Controllers;

use App\Models\Adminm\Login_m;

class Login_c extends BaseController
{
    private $Login_m;
    protected $session;
    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->session->start();
        helper('functions');
        helper('url');
        $this->Login_m = new Login_m();
    }
    public function index()
    {
        $validation = \Config\Services::validation();
        if ($this->request->getMethod() == 'post') {
            $validation->reset();
            $validation->setRules([
                'username' => 'required|valid_email',
                'password' => 'required',
            ]);

            if (!$validation->run($this->request->getPost())) {
                return redirect()->route('ádmin.login')->with('error', COMMON_VALIDATION_ERROR_MSG)->withInput($this->request->getPost());
            } else {
                $result = $this->Login_m->admin_login_select($this->request->getPost('username'), $this->request->getPost('password'));

                if ($result == true) {
                    // $userId = $_SESSION['admin']['admin_user_id'];
                    // $userType = $_SESSION['admin']['admin_usertype'];
                    // log_message('info', "$userType id $userId logged into the system");                
                    return redirect()->route('admin.dashboard');
                } else {
                    return redirect()->route('admin.login')->with('error', 'Invalid Username & Password.');
                }
            }
        }

        if ($this->request->getMethod() == 'get') {
            helper('form');
            $result = false;
            if (isset($_SESSION['admin']['admin_user_id'])) {
                if ($_SESSION['admin']['admin_user_id'] > 0) {
                    logoutUser('admin');
                    return redirect()->route('admin.login');
                }

                $data['title'] = ADMIN_LOGIN_TITLE;
                $data['validation'] = $validation;
                // echo single_page('adminside/login', $data);
                return view('pages/admin/admin-login', $data);
            }
        }

        if ($result == false) {
            $data['title'] = ADMIN_LOGIN_TITLE;
            $data['validation'] = $validation;
            //echo single_page('adminside/login', $data);
            return view('pages/admin/admin-login', $data);
        }
    }

    public function logout()
    {
        logoutUser('admin');
        $this->session->destroy();
        return redirect()->route('admin.login');
    }
}
