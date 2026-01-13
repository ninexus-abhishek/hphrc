<?php namespace App\Models\Employeem;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;
class Customers_m extends Model
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
