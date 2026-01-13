<?php namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;
class Common_m extends Model
{
    protected $db;
    public function __construct()
    {
        $this->db = db_connect();
        helper('functions');
    }
    public function register_customer($params){        
        $email_exist = $this->db->query("SELECT * FROM hpshrc_customer WHERE customer_email_id='".$params['customer_email_id']."' ");
        $res = $email_exist->getRowArray();                       
        if($res){
            return Array(
                'success' => false,
                'email_exist' => true
            );
        }    
        $params['customer_email_password'] = md5($params['customer_email_password']);
        unset($params['confirm_password']);
        if(isset($params['g-recaptcha-response'])){
            unset($params['g-recaptcha-response']);    
        }
        
        if(isset($_SESSION['employee']['employee_usertype'])){
            $params['createdby_type']=$_SESSION['employee']['employee_usertype'];
            $params['created_by']=$_SESSION['employee']['employee_user_id'];
        }
        if(isset($_SESSION['admin']['admin_usertype'])){
            $params['createdby_type']=$_SESSION['admin']['admin_usertype'];
            $params['created_by']=$_SESSION['admin']['admin_user_id'];
        }
        
        $builder = $this->db->table('hpshrc_customer');
        $builder->insert($params);
        $insert_id = $this->db->insertID();
        
        if(!empty($insert_id)){
            return Array(
                'success' => true,
                'email_exist' => false,                
                'email' => $params['customer_email_id'],
                'customer_id'=>$insert_id
            );
        }
        return FALSE;
        //it will be return boolean value (true/false)
    }
    
    
     public function register_employee($params){        
        $email_exist = $this->db->query("SELECT * FROM employee WHERE user_email_id='".$params['user_email_id']."' ");
        $res = $email_exist->getRowArray();                       
        if($res){
            return Array(
                'success' => false,
                'email_exist' => true
            );
        }    
        $params['user_email_password'] = md5($params['user_email_password']);        
        if(isset($params['g-recaptcha-response'])){
            unset($params['g-recaptcha-response']);    
        }       
        $params['created_by']=$_SESSION['admin']['admin_user_id'];        
        $builder = $this->db->table('employee');
        $builder->insert($params);
        $insert_id = $this->db->insertID();
        
        if(!empty($insert_id)){
            return Array(
                'success' => true,
                'email_exist' => false,                
                'email' => $params['user_email_id'],
                'employee_user_id'=>$insert_id
            );
        }
        return FALSE;
        //it will be return boolean value (true/false)
    }
    public function remove_employee_roll($refUser_id){
       return $this->db->query("DELETE FROM user_roll WHERE refUser_id=$refUser_id");       
    }
    public function add_employee_roll($params){
        $refUser_id=$params['refUser_id'];         
        $builder = $this->db->table('user_roll');
        $builder->insert($params);
        $insert_id = $this->db->insertID();        
        if(!empty($insert_id)){
            return TRUE;
        }
        return FALSE;
        //it will be return boolean value (true/false)
    } 
     public function get_employee_roll($employee_id){  
        $res = $this->db->query("SELECT * FROM user_roll WHERE refUser_id={$employee_id}");
        $data = $res->getResultArray();
        return $data;
    }
    
    public function chek_code_exist($user_id,$link_code,$user_type) {       
        $q = "SELECT * FROM user_email_link WHERE user_id=$user_id AND user_type='$user_type' AND link_code='$link_code' ";
        $query = $this->db->query($q);
        $row = $query->getRowArray(); 
        if (isset($row))
        {
            if($user_type=='customer'){
                $table="hpshrc_customer";
                $this->db->query("UPDATE $table SET customer_status='ACTIVE',customer_attempt=0,customer_locked_status=0,customer_email_verified_status=1 WHERE customer_id=$user_id ");
                $this->db->query("DELETE FROM user_email_link WHERE user_id=$user_id AND user_type='$user_type' AND link_code='$link_code'");
                return true;
            }
            if($user_type=='employee'){
                $table="employee";
                $this->db->query("UPDATE $table SET user_status='ACTIVE',user_attempt=0,user_locked_status=0,user_email_verified_status=1 WHERE employee_user_id=$user_id ");
                $this->db->query("DELETE FROM user_email_link WHERE user_id=$user_id AND user_type='$user_type' AND link_code='$link_code'");
                return true;
            }
        }
        return false;
    }
    public function user_email_link($params) {               
        $builder = $this->db->table('user_email_link');
        $builder->insert($params);
        $insert_id = $this->db->insertID();        
        if (!empty($insert_id)) {
            return true;
        }
        return false;
     }
     
       public function edit_customer($params,$customer_id){  
        $email_exist = $this->db->query("SELECT * FROM hpshrc_customer WHERE customer_email_id='".$params['customer_email_id']."' AND customer_id!={$customer_id} ");
        $res = $email_exist->getRowArray();                       
        if($res){
            return Array(
                'success' => false,
                'email_exist' => true
            );
        }  
        
        $builder = $this->db->table('hpshrc_customer');
        $builder->where('customer_id', $customer_id);
        $update =$builder->update($params);  
        
        if($update){
            return Array(
                'success' => true,
                'email_exist' => false               
            );
        }        
        return FALSE;
    }
    
      public function edit_employee($params,$employee_id){  
        $email_exist = $this->db->query("SELECT * FROM employee WHERE user_email_id='".$params['user_email_id']."' AND employee_user_id!={$employee_id} ");
        $res = $email_exist->getRowArray();                       
        if($res){
            return Array(
                'success' => false,
                'email_exist' => true
            );
        }          
        $builder = $this->db->table('employee');
        $builder->where('employee_user_id', $employee_id);
        $update =$builder->update($params);  
        
        if($update){
            return Array(
                'success' => true,
                'email_exist' => false               
            );
        }        
        return FALSE;
    }
     public function get_single_employee($employee_id){  
        $res = $this->db->query("SELECT * FROM employee WHERE employee_user_id={$employee_id} ");
        $row = $res->getRowArray();
        return $row;
    }
   
    public function get_single_customer($customer_id){  
        $res = $this->db->query("SELECT * FROM hpshrc_customer WHERE customer_id={$customer_id} ");
        $row = $res->getRowArray();
        return $row;
    }
    
    
    
    public function email_exist_check($email,$table) {
        if($table=='employee'){
            $where_field="user_email_id";
        }
        if($table=='hpshrc_customer'){
            $where_field="customer_email_id";
        }
        $email_exist = $this->db->query("SELECT * FROM $table WHERE $where_field = '" . $email . "' ");
        $res = $email_exist->getRowArray();
        if ($res) {
            return Array(
                'success' => true,
                'email_exist' => true,
                'data'=>$res
            );
        }
        else{
            return Array(
                'success' => false
            );
        }
    }
    public function check_forget_validity($user_type,$user_id,$date) {
        $validity_res = $this->db->query("SELECT * FROM user_forget_link WHERE user_id = '" . $user_id . "' AND user_type = '" . $user_type . "' AND DATE(request_date) = '" . $date . "' ");
        $res = $validity_res->getRowArray();       
        if ($res) {
            return FALSE;
        }
        else{
            return TRUE;
        }
    }
    public function chek_forget_code_exist($rmsa_user_id,$user_type,$link_code,$date) {       
        $validity_res = $this->db->query("SELECT * FROM user_forget_link WHERE user_id = '" . $rmsa_user_id . "' AND user_type = '" . $user_type . "' AND link_code = '" . $link_code . "' AND DATE(request_date) = '" . $date . "' ");
        $res = $validity_res->getRowArray();       
        if ($res) {
            return TRUE;
        }
        else{
            return FALSE;
        }
    }
      public function update_forget_password($params) {
        $table="";  
        $new_password = md5($params['rmsa_user_new_password']);
        $user_id = $params['user_id'];
        
        if($params['user_type']=='employee'){
            $table='employee';
            $result = $this->db->query("UPDATE $table
              SET user_email_password = '" . $new_password . "', user_attempt =0,user_locked_status=0
              WHERE employee_user_id = '" . $user_id . "'"); 
            
        }       
        if($params['user_type']=='customer'){
            $table='hpshrc_customer';
                    
            $result = $this->db->query("UPDATE $table
              SET customer_email_password = '" . $new_password . "', customer_attempt =0,customer_locked_status=0
              WHERE customer_id = '" . $user_id . "'");   
            
        }             
        if($result){
            $user_type=$params['user_type'];
            $this->db->query("DELETE  FROM user_forget_link WHERE user_id='{$user_id}' AND user_type='$user_type'");
        }
        return $result; //return true/false
    }
    
    public function user_forget_link($params) {        
        $builder = $this->db->table('user_forget_link');
        $builder->insert($params);
        $insert_id = $this->db->insertID();        
        if (!empty($insert_id)) {
            return true;
        }
        return false;       
     }
}
