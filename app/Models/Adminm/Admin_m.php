<?php namespace App\Models\Adminm;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;
class Admin_m extends Model
{
    protected $db;
    protected $session;
    public function __construct()
    {
        $this->session = session();
        $this->db = db_connect();
        helper('functions');
    }
}
