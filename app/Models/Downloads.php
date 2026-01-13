<?php

namespace App\Models;

use CodeIgniter\Model;

class Downloads extends Model
{
    protected $table = 'hpshrc_upload_files';
    protected $primaryKey = 'upload_file_id';

    protected $useAutoIncrement = true;

    protected $returnType = 'object';
    protected $useTimestamps = false;

    protected $allowedFields = [
        'admin_user_id',
        'upload_file_title',
        'upload_file_desc',
        'upload_file_ref_no',
        'upload_file_type',
        'upload_file_sub_type',
        'upload_file_original_name',
        'upload_file_location',
        'upload_file_status',
    ];
}