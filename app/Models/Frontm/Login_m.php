<?php namespace App\Models\Frontm;

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
    public function customer_login_select($username, $password) {        
        $password = md5($password);
        $resCustomer = $this->db->query("SELECT * FROM `hpshrc_customer` WHERE (customer_email_id = '$username') AND customer_email_password = '$password' AND customer_status = 'ACTIVE' AND customer_locked_status=0");
        $customer_data = $resCustomer->getRowArray();
        // dd($username, $password);
        if (isset($customer_data)) {                     
           if (($username == $customer_data['customer_email_id']) && ($password == $customer_data['customer_email_password'])) {               

                $this->db->query("UPDATE hpshrc_customer SET customer_attempt =0,customer_locked_status=0 WHERE customer_id = '{$customer_data['customer_id']}'");
                
                $token=generateToken();                
                $customer_data['customer_tokencheck'] = $token;
                $user_data=sessionCustomer($customer_data);
                $this->session->regenerate(true);
                $this->session->set($user_data);  
                $uid=$customer_data['customer_id'];
                                                
                $result_token = $this->db->query("select count(*) as allcount from customer_token WHERE customer_id='$uid'");
                $row_token = $result_token->getRowArray();                
                if ($row_token['allcount'] > 0) {                    
                    $this->db->query("update customer_token set token='$token' where customer_id='$uid'");
                } else {
                    $this->db->query("insert into customer_token(customer_id,token) values('$uid','$token')");
                }
                return true;
            }
        } else {
            $get_user = $this->db->query("SELECT * FROM hpshrc_customer WHERE customer_email_id = '$username' ");
            $check = $get_user->getRowArray();
            if (is_array($check)) {
                $attempt=$check['customer_attempt'];
                if ($attempt == 0 || $attempt == 1) {
                    $msgAttempt=2-$attempt;
                    $this->db->query("UPDATE hpshrc_customer SET customer_attempt = customer_attempt+1 WHERE customer_id = '{$check['customer_id']}'");
                    successOrErrorMessage("Invalid Username & Password. Account will be locked after $msgAttempt unsuccessful attempts", 'error');
                }
                if ($attempt >= 2) {
                    $this->db->query("UPDATE hpshrc_customer SET customer_attempt=customer_attempt+1,customer_locked_status=1 WHERE customer_id = '{$check['customer_id']}'");                  
                    successOrErrorMessage('Your account is locked after consecutive failure attempts. Please contact your school with your email id to unlock', 'error');
                }
                return false;
            }
        }
        successOrErrorMessage("Invalid Username & Password", 'error');
        return false;
    }        
    public function getTokenAndCheck($table,$user_id) {       
        $where_field=$table.'_user_id';
        $table=$table.'_token';        
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
}
