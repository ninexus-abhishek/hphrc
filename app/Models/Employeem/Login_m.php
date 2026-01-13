<?php namespace App\Models\Employeem;

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

    public function employee_login_select($username, $password) {
        $password = md5($password);
        $resemployee = $this->db->query("SELECT * FROM `employee` WHERE ( user_email_id = '$username') AND user_email_password = '$password' AND user_status = 'ACTIVE' AND user_locked_status=0");
        $employee_data = $resemployee->getRowArray();
        if (isset($employee_data)) {                     
           if (($username == $employee_data['user_email_id']) && ($password == $employee_data['user_email_password'])) {

                $this->db->query("UPDATE employee SET user_attempt =0,user_locked_status=0 WHERE employee_user_id = '{$employee_data['employee_user_id']}'");
                
                $this->db->query("UPDATE employee SET user_login_active = 1 WHERE employee_user_id='" . $employee_data['employee_user_id'] . "' ");
                
                $token=generateToken();                 
                $employee_data['employee_tokencheck'] = $token;
                $user_data=sessionEmployee($employee_data);
                $this->session->regenerate(true);
                $this->session->set($user_data);
                
                $uid=$employee_data['employee_user_id'];                                               
                $result_token = $this->db->query("select count(*) as allcount from employee_token WHERE employee_user_id='$uid'");
                $row_token = $result_token->getRowArray();                               
                if ($row_token['allcount'] > 0) {                    
                    $this->db->query("update employee_token set token='$token' where employee_user_id='$uid'");
                } else {
                    $this->db->query("insert into employee_token(employee_user_id,token) values('$uid','$token')");
                }
                
                return true;
            }
        } else {
            $get_user = $this->db->query("SELECT * FROM employee WHERE user_email_id = '$username' ");
            $check = $get_user->getRowArray();
            if (is_array($check)) {
                $attempt=$check['user_attempt'];
                if ($attempt == 0 || $attempt == 1) {
                    $msgAttempt=2-$attempt;
                    $this->db->query("UPDATE employee SET user_attempt = user_attempt+1 WHERE employee_user_id = '{$check['employee_user_id']}'");
                    successOrErrorMessage("Invalid Username & Password. Account will be locked after $msgAttempt unsuccessful attempts", 'error');
                }
                if ($attempt >= 2) {
                    $this->db->query("UPDATE employee SET user_attempt=user_attempt+1,user_locked_status=1 WHERE employee_user_id = '{$check['employee_user_id']}'");                  
                    successOrErrorMessage('Your account is locked after consecutive failure attempts. Please contact your school with your email id to unlock', 'error');
                }
                return false;
            }
        }
        successOrErrorMessage("Invalid Username & Password", 'error');
        return false;
    }
        
    public function getTokenAndCheck($table,$user_id) {
        $table=$table.'_token';
        $result = $this->db->query("SELECT token FROM $table where employee_user_id='$user_id'");
        $data = $result->getRowArray();        
        if($data){
            return $data;
        }
        return false;
    }
    public function update_logout_status($user_id) {
        $query_res = $this->db->query("UPDATE employee SET user_login_active = 0 WHERE employee_user_id='" . $user_id . "' ");
        if ($query_res) {
            return true;
        }
    }   
}
