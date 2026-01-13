<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Employeem\Customers_m;
use App\Models\Employeem\Login_m;

class Customers_c extends Controller {

    private $Customers_m;
    private $Login_m;
    private $security;

    public function __construct() {
        helper('url');
        $this->security = \Config\Services::security();
        helper('functions');
        sessionCheckEmployee();
        $this->Customers_m = new Customers_m();
        $this->Login_m = new Login_m();
        if (isset($_SESSION['user_id'])) {
            if ($_SESSION['usertype'] == 'employee') {
                $result = $this->Login_m->getTokenAndCheck($_SESSION['usertype'], $_SESSION['user_id']);
                if ($result) {
                    $token = $result['token'];
                    if ($_SESSION['tokencheck'] != $token) {
                        session_destroy();
                        header('Location: ' . EMPLOYEE_LOGOUT_LINK);
                        exit();
                    }
                }
            }
        }
    }

    public function customers_list() {
        $data['title'] = EMPLOYEE_CUSTOMER_LIST_TITLE;
        echo employee_view('employee/customers_list', $data);
    }

    public function approve_status() {
        if (isset($_REQUEST['table_id'])) {
            $res = $this->Customers_m->approve_status($_REQUEST);
            if ($res) {
                $data = array(
                    'suceess' => true
                );
            }
            $data['token'] = $this->security->getCSRFHash();
            echo json_encode($data);
        }
    }

}
