<?php namespace App\Models\Adminm;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;
class Login_m extends Model
{
    protected $db;
    protected $session;
    public function __construct()
    {
        $this->session = session();
        $this->db = db_connect();
        helper('functions');
    } 
    
    public function count_data($table,$count_field,$where_field,$where_field_value){        
        $tehsil = $this->db->query("SELECT COUNT($count_field) as cnt FROM $table WHERE $where_field='$where_field_value'");
        return $tehsil->getRowArray();
    } 
    public function count_data1($table,$count_field){        
        $tehsil = $this->db->query("SELECT COUNT($count_field) as cnt FROM $table");
        return $tehsil->getRowArray();
    } 
    
    
    public function admin_login_select($username, $password) {        
        $password = md5($password);
        $resAdmin = $this->db->query("SELECT * FROM `admin` WHERE ( user_email_id = '$username') AND user_email_password = '$password' AND user_status = 'ACTIVE' AND user_locked_status=0");
        $admin_data = $resAdmin->getRowArray();
        
//        echo '<pre>';print_r($admin_data);die;
//        
        if (isset($admin_data)) {                     
           if (($username == $admin_data['user_email_id']) && ($password == $admin_data['user_email_password'])) {               

                $this->db->query("UPDATE admin SET user_attempt =0,user_locked_status=0 WHERE admin_user_id = '{$admin_data['admin_user_id']}'");
                
                $this->db->query("UPDATE admin SET user_login_active = 1 WHERE admin_user_id='" . $admin_data['admin_user_id'] . "' ");
                
                $token=generateToken();     
                $admin_data['admin_tokencheck'] = $token;
                $user_data=sessionAdmin($admin_data);
                $this->session->regenerate(true);
                $this->session->set($user_data);
                
                
                $uid=$admin_data['admin_user_id'];
                                                
                $result_token = $this->db->query("select count(*) as allcount from admin_token WHERE admin_user_id='$uid'");
                $row_token = $result_token->getRowArray();                
                if ($row_token['allcount'] > 0) {                    
                    $this->db->query("update admin_token set token='$token' where admin_user_id='$uid'");
                } else {
                    $this->db->query("insert into admin_token(admin_user_id,token) values('$uid','$token')");
                }
                return true;
            }
        } else {
            $get_user = $this->db->query("SELECT * FROM admin WHERE user_email_id = '$username' ");
            $check = $get_user->getRowArray();
            if (is_array($check)) {
                $attempt=$check['user_attempt'];
                if ($attempt == 0 || $attempt == 1) {
                    $msgAttempt=2-$attempt;
                    $this->db->query("UPDATE admin SET user_attempt = user_attempt+1 WHERE admin_user_id = '{$check['admin_user_id']}'");
                    successOrErrorMessage("Invalid Username & Password. Account will be locked after $msgAttempt unsuccessful attempts", 'error');
                }
                if ($attempt >= 2) {
                    $this->db->query("UPDATE admin SET user_attempt=user_attempt+1,user_locked_status=1 WHERE admin_user_id = '{$check['admin_user_id']}'");                  
                    successOrErrorMessage('Your account is locked after consecutive failure attempts. Please contact your school with your email id to unlock', 'error');
                }
                return false;
            }
        }
        successOrErrorMessage("Invalid Username & Password", 'error');
        return false;
    }
        
    public function getTokenAndCheck($table,$user_id) {
        if($table=="customer"){
            $where_field=$table.'_id';
            $table=$table.'_token'; 
        }else{
            $where_field=$table.'_user_id';
            $table=$table.'_token'; 
        }
        $result = $this->db->query("SELECT token FROM $table WHERE $where_field=$user_id");        
        $data = $result->getRowArray();        
        if($data){
            return $data;
        }
        return false;
    }
    public function update_logout_status($user_id) {
        $query_res = $this->db->query("UPDATE admin SET user_login_active = 0 WHERE admin_user_id='" . $user_id . "' ");
        if ($query_res) {
            return true;
        }
    }
    
    public function check_current_password($current_password) {
        $current_password = md5($current_password);
        $admin_user_id = $_SESSION['admin']['admin_user_id'];
        $check = $this->db->query("SELECT * FROM admin
                                       WHERE admin_user_id = '" . $admin_user_id . "'
                                       AND user_email_password ='" . $current_password . "'");
        $row = $check->getRowArray();
        if (isset($row)) {
            if ($current_password == $row['user_email_password']) {
                return true; //matched
            }
        }
        return false; //not matched
    }

    public function update_password($params) {
        $new_password = md5($params['user_new_password']);
        $admin_user_id = $_SESSION['admin']['admin_user_id'];
        $result = $this->db->query("UPDATE admin
                              SET user_email_password = '" . $new_password . "'
                              WHERE admin_user_id = '" . $admin_user_id . "'");
        return $result; //return true/false
    }
    
    public function update_password_front($params) {
        $new_password = md5($params['user_new_password']);
        $customer_id = $_SESSION['customer']['customer_id'];
        $result = $this->db->query("UPDATE hpshrc_customer
                              SET customer_email_password = '" . $new_password . "'
                              WHERE customer_id = '" . $customer_id . "'");
        return $result; //return true/false
    }
    public function check_current_password_front($current_password) {
        $current_password = md5($current_password);
        $customer_id = $_SESSION['customer']['customer_id'];
        $check = $this->db->query("SELECT * FROM hpshrc_customer
                                       WHERE customer_id = '" . $customer_id . "'
                                       AND customer_email_password ='" . $current_password . "'");
        $row = $check->getRowArray();
        if (isset($row)) {
            if ($current_password == $row['customer_email_password']) {
                return true; //matched
            }
        }
        return false; //not matched
    }
    public function check_emp_current_password($current_password) {
        $current_password = md5($current_password);
        $employee_user_id = $_SESSION['employee']['employee_user_id'];
        $check = $this->db->query("SELECT * FROM employee
                                       WHERE employee_user_id = '" . $employee_user_id . "'
                                       AND user_email_password ='" . $current_password . "'");
        $row = $check->getRowArray();
        if (isset($row)) {
            if ($current_password == $row['user_email_password']) {
                return true; //matched
            }
        }
        return false; //not matched
    }

    public function update_emp_password($params) {
        $new_password = md5($params['user_new_password']);
        $employee_user_id = $_SESSION['employee']['employee_user_id'];
        $result = $this->db->query("UPDATE employee
                              SET user_email_password = '" . $new_password . "'
                              WHERE employee_user_id = '" . $employee_user_id . "'");
        return $result; //return true/false
    }
}
