<?php namespace App\Models\Employeem;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;
class Cases_m extends Model
{
    protected $db;
    protected $session;
    public function __construct()
    {
        $this->session = session();
        $this->db = db_connect();
        helper('functions');
    }
    public function create_customer($params){           
        $email_exist = $this->db->query("SELECT * FROM hpshrc_customer WHERE customer_email_id='".$params['customer_email_id']."' OR customer_mobile_no='".$params['customer_mobile_no']."' ");
        $res = $email_exist->getRowArray();         
        if($res){
            return $res['customer_id'];
        } 
        if($params['customer_email_id']=='example@gmail.com'){
            $params['customer_email_id']='';
        }                
        
        if($params['customer_mobile_no']=='9999999999'){
            $params['customer_mobile_no']=0;
        }
        $params['customer_email_password'] = md5($params['customer_email_password']);                    
        $builder = $this->db->table('hpshrc_customer');
        $builder->insert($params);
        $insert_id = $this->db->insertID();
        
        if(!empty($insert_id)){
            return $insert_id;
        }
        return FALSE;       
    }
    public function create_case($params){                    
        $builder = $this->db->table('cases');
        $builder->insert($params);
        $insert_id = $this->db->insertID();          
        if(!empty($insert_id)){
           return $insert_id;
        }
        return FALSE;       
    }
    public function add_cases_files($params) {
        $builder = $this->db->table('case_files');
        $builder->insert($params);
        return $this->db->insertID();
    }
    public function add_cases_comment($params) {
        $builder = $this->db->table('comment');
        $builder->insert($params);
        return $this->db->insertID();
    }
      public function edit_cases($params,$cases_id){                              
        $builder = $this->db->table('cases');
        $builder->where('cases_id', $cases_id);
        $update =$builder->update($params);        
        return $update;
    }
    
    public function close_cases($cases_id){         
        $params=array();
        $params['cases_status']='closed';
        $builder = $this->db->table('cases');
        $builder->where('cases_id', $cases_id);
        $update =$builder->update($params);        
        return $update;
    }
    
    public function get_admin_email() {       
        $ressult = $this->db->query("SELECT * FROM `admin`");
        return $ressult->getRowArray();      
    }
    
    public function get_single_cases($cases_id) {       
        $ressult = $this->db->query("SELECT * FROM `cases` WHERE cases_id='{$cases_id}'");
        return $ressult->getRowArray();      
    }
    public function get_single_employee($emp_id) {       
        $ressult = $this->db->query("SELECT * FROM `employee` WHERE employee_user_id='{$emp_id}'");
        return $ressult->getRowArray();      
    }
    public function get_view_cases($cases_id) {       
        $ressult = $this->db->query("   SELECT cs.*,hc.*,emp.* FROM `cases` cs
                                        LEFT JOIN hpshrc_customer hc
                                        ON hc.customer_id=cs.refCustomer_id
                                        LEFT JOIN employee emp
                                        ON emp.employee_user_id=cs.cases_assign_to
                                        WHERE cs.cases_id='{$cases_id}'");
        return $ressult->getRowArray();      
    }
    
    public function get_file_details($cases_id) {         
        $ressult = $this->db->query("SELECT * FROM case_files WHERE refCases_id='{$cases_id}' AND case_files_type='main'");
        return $ressult->getResultArray();      
    }
    public function get_comment_file_details($cases_id,$last_comment_id=0) {         
        $ressult = $this->db->query("SELECT * FROM case_files WHERE refCases_id='{$cases_id}' AND case_files_type='comment' AND refComment_id > '{$last_comment_id}'");
        return $ressult->getResultArray();      
    }
    
    public function get_involved_peopel($cases_id) {         
        $ressult = $this->db->query("   SELECT emp.* FROM `comment` cmt
                                        LEFT JOIN employee emp
                                        ON emp.employee_user_id=cmt.comment_from OR emp.employee_user_id=cmt.comment_to                                       
                                        WHERE cmt.refCases_id='{$cases_id}' AND (cmt.comment_from_usertype='employee' OR cmt.comment_to_usertype='employee') GROUP BY emp.employee_user_id");
        return $ressult->getResultArray();      
    }
    public function get_employee() {       
        $ressult = $this->db->query("SELECT * FROM `employee` WHERE user_status='ACTIVE'");
        return $ressult->getResultArray();      
    }    
    public function get_comments($case_id,$last_comment_id=0) {       
        $ressult = $this->db->query("   SELECT
                                        fhc.customer_first_name as fhc_customer_first_name,fhc.customer_last_name as fhc_customer_last_name,fhc.customer_id as fhc_customer_id,
                                        thc.customer_first_name as thc_customer_first_name,thc.customer_last_name as thc_customer_last_name,thc.customer_id as thc_customer_id,
                                        temp.user_firstname as t_user_firstname,temp.user_lastname as t_user_lastname,temp.employee_user_id as t_employee_user_id,
                                        femp.user_firstname as f_user_firstname,femp.user_lastname as f_user_lastname,femp.employee_user_id as f_employee_user_id,
                                        cmt.* FROM `comment` cmt
                                        
                                        LEFT JOIN employee femp
                                        ON femp.employee_user_id=cmt.comment_from AND cmt.comment_from_usertype='employee'
                                        LEFT JOIN employee temp
                                        ON temp.employee_user_id=cmt.comment_to AND cmt.comment_to_usertype='employee'
                                        
                                        LEFT JOIN hpshrc_customer fhc
                                        ON fhc.customer_id=cmt.comment_from AND cmt.comment_from_usertype='customer'
                                        LEFT JOIN hpshrc_customer thc
                                        ON thc.customer_id=cmt.comment_to AND cmt.comment_to_usertype='customer'

                                        WHERE cmt.refCases_id='{$case_id}' AND cmt.comment_id > '{$last_comment_id}'  ORDER BY cmt.comment_id DESC");
        return $ressult->getResultArray();      
    }
    
    public function add_causes($params) {
        $builder = $this->db->table('hpshrc_upload_files');
        $builder->insert($params);
        return $this->db->insertID();
    }   
    public function edit_causes($params,$upload_file_id){  
        $builder = $this->db->table('hpshrc_upload_files');
        $builder->where('upload_file_id', $upload_file_id);
        $update =$builder->update($params);        
        return $update;
    }
    public function active_causes($params) {
        $query_res = $this->db->query("UPDATE  hpshrc_upload_files SET upload_file_status = '{$params['upload_file_status']}'
                                       WHERE upload_file_id='{$params['upload_file_id']}'");
        if ($query_res) {
            return true;
        }
        return false;
    }
    public function approve_status($params) {                          
        $table=$params['table'];
        $table_update_field=$params['updatefield'];
        $table_where_field=$params['wherefield'];        
        $query_res = $this->db->query("UPDATE  $table SET $table_update_field = '{$params['user_status']}' WHERE $table_where_field='{$params['table_id']}'");       
        if ($query_res) {
            return true;
        }
    }
    
}
