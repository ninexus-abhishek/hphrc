<?php

namespace App\Controllers;

use App\Models\Employeem\Customers_m;
use App\Models\Adminm\Login_m;
use App\Models\Common_m;
use App\ThirdParty\smtp_mail\SMTP_mail;
use CodeIgniter\API\ResponseTrait;

class Customers_e extends BaseController
{
    use ResponseTrait;

    private $Customers_m;
    private $Login_m;
    private $security;
    private $Common_m;
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
        $this->Common_m = new Common_m();
        $this->Customers_m = new Customers_m();
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

    public function customers_list()
    {
        
        $data['title'] = EMPLOYEE_CUSTOMER_LIST_TITLE;
        echo employee_view('employee/customers_list', $data);
    }

    public function approve_status()
    {
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

    public function create_customer()
    {
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
                return redirect()->route('employee.customer_registration')->with('error', COMMON_VALIDATION_ERROR_MSG)->withInput($this->request->getPost());
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
                if ($result['success'] == "success") {
                    if (isset($_SESSION['post_data'])) {
                        unset($_SESSION['post_data']);
                    }
                }

                return redirect()->route('employee.customer_registration');
            }
        }

        if ($this->request->getMethod() == 'get') {
            if (isset($_SESSION['post_data'])) {
                unset($_SESSION['post_data']);
            }

            helper('form');
            $data['title'] = CUSTOMER_REGISTRATION_TITLE;
            $data['validation'] = $validation;
            echo employee_view('employee/user_registration', $data);
        }
    }

    public function edit_customer($customer_id)
    {
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
               // $redirectURL = EMPLOYEE_CUSTOMER_EDIT_LINK . $customer_id;
                return redirect()->to('em.edit'.$customer_id)->with('error', COMMON_VALIDATION_ERROR_MSG)->withInput($this->request->getPost());
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

                return redirect()->route('em.edit' . $customer_id);
            }
        }

        if ($this->request->getMethod() == 'get') {
            helper('form');
            $data['single_customer'] = $this->Common_m->get_single_customer($customer_id);
            $data['customer_id'] = $customer_id;
            $data['title'] = EDIT_CUSTOMER_TITLE;
            $data['validation'] = $validation;
            echo employee_view('employee/edit_customer', $data);
        }
    }
}
