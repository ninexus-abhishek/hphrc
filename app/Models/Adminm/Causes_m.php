<?php namespace App\Models\Adminm;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;
class Causes_m extends Model
{
    protected $db;
    protected $session;
    public function __construct()
    {
        $this->session = session();
        $this->db = db_connect();
        helper('functions');
    }   
    public function add_causes($params) {
        $builder = $this->db->table('hpshrc_upload_files');
        $builder->insert($params);
        return $this->db->insertID();
    }
    public function add_category($params) {
        $builder = $this->db->table('hpshrc_categories');
        return $builder->insert($params);
//        return $this->db->insertID();
    }
     public function add_expense($params) {
        $builder = $this->db->table('budget');
        $builder->insert($params);
        return $this->db->insertID();
    }
    public function get_file_type($category_ref_type) {       
        $ressult = $this->db->query("SELECT * FROM `hpshrc_categories` WHERE category_status='ACTIVE' AND category_ref_type='$category_ref_type'");
        return $ressult->getResultArray();      
    }
    
    public function get_expense($year) {       
        $ressult = $this->db->query("SELECT * FROM `budget` WHERE budget_year='$year'");
        return $ressult->getResultArray();      
    }
    
    public function load_sub_type($params){
        $subtype_id = $params['category_code'];
        $res = $this->db->query("SELECT * FROM `hpshrc_categories` WHERE  category_status='ACTIVE' AND category_ref_type='SUB_TYPE' AND ref_category_code='$subtype_id'");
        return $res->getResultArray();
    }
    public function get_sub_type($subtype_id){        
        $tehsil = $this->db->query("SELECT * FROM `hpshrc_categories` WHERE  category_status='ACTIVE' AND category_ref_type='SUB_TYPE' AND ref_category_code='$subtype_id'");
        return $tehsil->getResultArray();
    }
    public function get_single_file($upload_file_id){        
        $tehsil = $this->db->query("SELECT * FROM `hpshrc_upload_files` WHERE upload_file_id='$upload_file_id'");
        return $tehsil->getRowArray();
    }
     public function get_single_category($category_code){        
        $tehsil = $this->db->query("SELECT * FROM `hpshrc_categories` WHERE category_code='$category_code'");
        return $tehsil->getRowArray();
    }
     public function get_single_budget($budget_id){        
        $tehsil = $this->db->query("SELECT * FROM `budget` WHERE budget_id='$budget_id'");
        return $tehsil->getRowArray();
    }
    public function edit_causes($params,$upload_file_id){  
        $builder = $this->db->table('hpshrc_upload_files');
        $builder->where('upload_file_id', $upload_file_id);
        $update =$builder->update($params);        
//        $update = $this->db->update('hpshrc_upload_files', $params, array('upload_file_id' => $upload_file_id));
        return $update;
    }
    public function edit_category($params,$category_code){  
        $builder = $this->db->table('hpshrc_categories');
        $builder->where('category_code', $category_code);
        $update =$builder->update($params);        
        return $update;
    }
     public function edit_expense($params,$budget_id){  
        $builder = $this->db->table('budget');
        $builder->where('budget_id', $budget_id);
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
     public function active_category($params) {
        $query_res = $this->db->query("UPDATE  hpshrc_categories SET category_status = '{$params['category_status']}'
                                       WHERE category_code='{$params['category_code']}'");
        if ($query_res) {
            return true;
        }
        return false;
    }
}
