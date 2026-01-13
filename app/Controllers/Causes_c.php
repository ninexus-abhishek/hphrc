<?php
namespace App\Controllers;

use App\Models\Adminm\Login_m;
use App\Models\Adminm\Causes_m;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Files\File;
use CodeIgniter\Exceptions\PageNotFoundException;

class Causes_c extends BaseController {
    use ResponseTrait;

    private $Login_m;
    private $Causes_m;
    private $security;
    private $userId;
    protected $session;
    private $_validation;

    public function __construct() {   
        $this->session = \Config\Services::session();
        $this->session->start();               
        helper('url');
        helper('functions');
        sessionCheckAdmin();              
        $this->Login_m = new Login_m();
        $this->Causes_m = new Causes_m();
        $this->security = \Config\Services::security();
        $this->_validation = \Config\Services::validation();
        if (isset($_SESSION['admin']['admin_user_id'])) {            
                $result = $this->Login_m->getTokenAndCheck('admin', $_SESSION['admin']['admin_user_id']);
                if ($result) {
                    $token = $result['token'];
                    if ($_SESSION['admin']['admin_tokencheck'] != $token) {                                                                       
                            logoutUser('admin');
                            header('Location: ' . ADMIN_LOGIN_LINK);
                            exit();                        
                    }   
                }
                else{
                    logoutUser('admin');
                    header('Location: ' . ADMIN_LOGIN_LINK);
                    exit();
                }
            
        }
        $this->userId = (int) $_SESSION['admin']['admin_user_id'];        
    }

    public function add_causes() {
        $validation = $this->_validation;

        if ($this->request->getMethod() == 'post') {
            $validation->reset();

            if ($this->request->getPost('upload_file_type') === "FILE_TYP_ORD") {
                $sub_type_list = "FILE_SUB_TYP_ADMIN,FILE_SUB_TYP_FINAL,FILE_SUB_TYP_INTRIM";
                $sub_type_msg = "Administrative Order, Final Order, Intrim Order";
            } else {
                $sub_type_list = "FILE_SUB_TYP_CAUSE, FILE_SUB_TYP_TENDER";
                $sub_type_msg = "Cause List, Tenders";
            }

            $validation->setRules([
                'upload_file_title' => 'required',
                'upload_file_desc' => 'required',
                'upload_file_ref_no' => 'required',
                'upload_file_type' => 'required|in_list[FILE_TYP_ORD,FILE_TYP_REC]',
                'upload_file_sub_type' => 'required|in_list['.$sub_type_list.']',
                'upload_file_original_name' => 'uploaded[upload_file_original_name]|ext_in[upload_file_original_name,pdf,jpg,jpeg,png]',
            ], [
                'upload_file_title' => [
                    'required' => 'Title field is required.',
                ],
                'upload_file_desc' => [
                    'required' => 'Description field is required.',
                ],
                'upload_file_ref_no' => [
                    'required' => 'Reference file number field is required.',
                ],
                'upload_file_type' => [
                    'required' => 'File type field is required.',
                    'in_list' => 'File type field must be one of: Orders, Notification.'
                ],
                'upload_file_sub_type' => [
                    'required' => 'File sub type field is required.',
                    'in_list' => 'File sub type field must be one of: '.$sub_type_msg.'.'
                ],
                'upload_file_original_name' => [
                    'uploaded' => 'File field is required.',
                    'ext_in' => 'Uploaded file does not have a valid file extension.',
                ],
            ]);

            if (!$validation->run($this->request->getPost())) {
                return redirect()->route('admin.file_add')->with('error', COMMON_VALIDATION_ERROR_MSG)->withInput($this->request->getPost());
            } else {
                $file_params = array();
                $img = $this->request->getFile('upload_file_original_name');

                if ($img->isValid() && ! $img->hasMoved()) {
                    $original_name =  $img->getClientName();
                   $filepath = WRITEPATH . '/public/uploads/' . $img->store('doc/causes/');
                    //$img->move(FCPATH. 'uploads', $original_name);
                    //$img->move(ROOTPATH. 'public/uploads', $original_name);
                    $uploaded_fileinfo = new File($filepath);
                    $file_params  ['upload_file_location'] = $uploaded_fileinfo->getBasename();
                    $file_params['upload_file_original_name'] = $original_name;
                   
                } else {
                    $message = $img->getErrorString() . '(' . $img->getError() . ')';
                    return redirect()->route('admin.file_add')->with('error', $message)->withInput();
                }

                $params = [
                    'admin_user_id' => $this->userId,
                    'upload_file_title' => $this->request->getPost('upload_file_title'),
                    'upload_file_desc' => $this->request->getPost('upload_file_desc'),
                    'upload_file_ref_no' => $this->request->getPost('upload_file_ref_no'),
                    'upload_file_type' => $this->request->getPost('upload_file_type'),
                    'upload_file_sub_type' => $this->request->getPost('upload_file_sub_type'),
                ];

                $final_params = array_merge($params, $file_params); 

                $res = $this->Causes_m->add_causes($final_params);
                if ($res) {
                    successOrErrorMessage("File has been added", 'success');
                    return redirect()->route('admin.file_list');
                } else {
                    successOrErrorMessage("something happened wrong", 'error');
                    return redirect()->route('admin.file_add')->with('error', 'something happened wrong')->withInput();
                }
            }
        }

        if ($this->request->getMethod() == 'get') {
            helper('form');
            $data['file_type']=$this->Causes_m->get_file_type('MAIN_TYPE');
            $data['title'] = ADMIN_ADD_CAUSES_TITLE;
            $data['validation'] = $validation;
            //echo admin_view('adminside/causes/add', $data);
            return view('pages/admin/causes/causes-add', $data);
        }
    }

    public function edit_causes($upload_file_id) {
        $validation = $this->_validation;
        if ($this->request->getMethod() == 'post') {
            $validation->reset();

            if ($this->request->getPost('upload_file_type') === "FILE_TYP_ORD") {
                $sub_type_list = "FILE_SUB_TYP_ADMIN,FILE_SUB_TYP_FINAL,FILE_SUB_TYP_INTRIM";
                $sub_type_msg = "Administrative Order, Final Order, Intrim Order";
            } else {
                $sub_type_list = "FILE_SUB_TYP_CAUSE, FILE_SUB_TYP_TENDER";
                $sub_type_msg = "Cause List, Tenders";
            }

            $validation->setRules([
                'upload_file_title' => 'required',
                'upload_file_desc' => 'required',
                'upload_file_ref_no' => 'required',
                'upload_file_type' => 'required|in_list[FILE_TYP_ORD,FILE_TYP_REC]',
                'upload_file_sub_type' => 'required|in_list['.$sub_type_list.']',
            ], [
                'upload_file_title' => [
                    'required' => 'Title field is required.',
                ],
                'upload_file_desc' => [
                    'required' => 'Description field is required.',
                ],
                'upload_file_ref_no' => [
                    'required' => 'Reference file number field is required.',
                ],
                'upload_file_type' => [
                    'required' => 'File type field is required.',
                    'in_list' => 'File type field must be one of: Orders, Notification.'
                ],
                'upload_file_sub_type' => [
                    'required' => 'File sub type field is required.',
                    'in_list' => 'File sub type field must be one of: '.$sub_type_msg.'.'
                ],
            ]);

            if (! $validation->run($this->request->getPost())) {
                return redirect()->route('admin.file_edit' . $upload_file_id)->with('error', COMMON_VALIDATION_ERROR_MSG)->withInput($this->request->getPost());
            } else {
                $params = [
                    'admin_user_id' => $this->userId,
                    'upload_file_title' => $this->request->getPost('upload_file_title'),
                    'upload_file_desc' => $this->request->getPost('upload_file_desc'),
                    'upload_file_ref_no' => $this->request->getPost('upload_file_ref_no'),
                    'upload_file_type' => $this->request->getPost('upload_file_type'),
                    'upload_file_sub_type' => $this->request->getPost('upload_file_sub_type'),
                ];

                $res = $this->Causes_m->edit_causes($params, $upload_file_id);

                if ($res) {                    
                    //Success message : File has been added
                    successOrErrorMessage("File has been updated", 'success');
                    return redirect()->route('admin.file_list' . $upload_file_id);
                } else {
                    //Error message
                    successOrErrorMessage("something happened wrong", 'error');
                    return redirect()->route('admin.file_edit')->with('error', 'Something happened wrong');
                }
            }
        }

        if ($this->request->getMethod() == 'get') {
            helper('form');
            $single_file = $this->Causes_m->get_single_file($upload_file_id);
            if (!empty($single_file)) {
                $data['single_file'] = $single_file;
                $data['file_type'] = $this->Causes_m->get_file_type('MAIN_TYPE');
                $data['file_sub_type'] = $this->Causes_m->get_sub_type($data['single_file']['upload_file_type']); 
                $data['upload_file_id'] = $upload_file_id;
                $data['title'] = ADMIN_EDIT_CAUSES_TITLE;
                $data['validation'] = $validation;
                //echo admin_view('adminside/causes/edit', $data); 
                return view('pages/admin/causes/causes-edit', $data);           
            } else {
                throw new PageNotFoundException('The requested page could not be found.');
                // return redirect()->to(PAGE_404_LINK);
            }
        }
    }

    public function file_list() {
        if ($this->request->getMethod() == 'post') {
            $db = \Config\Database::connect();
            $view = \Config\Services::renderer();

            $searchValue = $this->request->getVar('search.value');
            $total = $db->table('hpshrc_upload_files')->countAll();
            $offset = (int) $this->request->getVar('start') ?? 0;
            $limit = (int) $this->request->getVar('length') ?? 10;
            $order = '';
            $column = '';

            if ($this->request->getVar('order')) {
                foreach ($this->request->getVar('order') as $req) {
                    if ($req['dir']) {
                        $order = $req['dir'];
                    }
        
                    switch ($req['column']) {
                        case 1:
                            $column = 'huf.upload_file_id';
                            break;
                        case 2:
                            $column = 'huf.upload_file_title';
                            break;
                        case 3:
                            $column = 'huf.upload_file_original_name';
                            break;
                        case 5:
                            $column = 'huf.upload_file_ref_no';
                            break;
                        case 6:
                            $column = 'huf.upload_file_type';
                            break;
                        case 7:
                            $column = 'huf.upload_file_sub_type';
                            break;
                        case 8:
                            $column = 'huf.upload_file_status';
                            break;
                        default:
                            $column = '';
                            break;
                    }
                }
            }
            $builder = $db->table('hpshrc_upload_files huf');
            $builder->join('hpshrc_categories hc', 'hc.category_code = huf.upload_file_type');

            if ($searchValue) {
                /* $builder->groupStart()
                    ->like('huf.upload_file_title', $searchValue)
                    ->orLike('huf.upload_file_ref_no', $searchValue)
                    ->orLike('hc.category_title', $searchValue)
                ->groupEnd(); */

                $builder->groupStart()
                    ->like('huf.upload_file_title', $searchValue)
                    ->orLike('huf.upload_file_ref_no', $searchValue)
                    ->orLike('huf.upload_file_type', $searchValue)
                    ->orLike('huf.upload_file_id', $searchValue)
                    ->orLike('huf.upload_file_original_name', $searchValue)
                    ->orLike('huf.upload_file_sub_type', $searchValue)
                    ->orLike('huf.upload_file_status', $searchValue)
                ->groupEnd();
            }

            // Cloning builder for filtered count
            $filtered = (clone $builder)->countAllResults();
    
            if ($order && $column) {
                $builder->orderBy($column, $order);
            }

            $builder->limit($limit, $offset);
            $query = $builder->get();
            $results = $query->getResult();

            $list = array();

            if (! empty($results)) {
                foreach ($results as $key => $row) {
                  
                    $upload_file_id= $row->upload_file_id;
                        $isactive = 1;
                        $title = 'Click to deactivate causes';
                        $class = 'btn_approve_reject btn btn-success btn-xs';
                        $text = 'Active';
                     $list[$key] = [   
                        "index" => $key + 1,
                        "upload_file_id" => $row->upload_file_id,
                        "upload_file_title" => $row->upload_file_title,
                        
                        "upload_file_original_name"  => "<a target='_blank' class='download' href=" .base_url('uploads/doc/causes/' . $row->upload_file_location) ."><u>" . $row->upload_file_original_name. "</u></a>",
                        "upload_file_desc" => $row->upload_file_desc,
                        "upload_file_ref_no" => $row->upload_file_ref_no, 
                        "upload_file_type" => $row->upload_file_type,
                        "upload_file_sub_type" => $row->upload_file_sub_type,
                        "upload_file_status" => "<button type='button' data-id='" . $upload_file_id . "' data-status = '" . $isactive . "' title='" . $title . "' class='" . $class . " '>" . $text . "</button>",
                        "action" =>  "<a href=\"". base_url(route_to('admin.file_edit', $row->upload_file_id)) ."\" target=\"_blank\" class=\"btn btn-xs btn-warning\">Edit &nbsp;<i class='fa fa-pencil'></i></a>",
                     ];
                }
            }

            return $this->respond([
                'draw' => (int) $this->request->getVar('draw'),
                'recordsTotal' => $total,
                'recordsFiltered' => $filtered,
                'data' => (! empty($list)) ? $list : [],
            ]);
        }
        
        if ($this->request->getMethod() == 'get') {
            $data['title'] = ADMIN_FILE_LIST_TITLE;
            return view('pages/admin/causes/file_list', $data);
        }
    }

    public function load_sub_type(){
        $validation = $this->_validation;
        $validation->reset();
        $validation->setRule('category_code', 'Category code', 'required');

        if (! $validation->run($this->request->getPost())) {
            $errors = $validation->getErrors();
            return $this->respond($errors, 400);
        } else {
            $sub_type = $this->Causes_m->load_sub_type(['category_code' => $this->request->getPost('category_code')]);

            $result=array();
            $result['sub_type'] = $sub_type;
            return $this->respond($result); 
        }
    }
    
    public function active_causes(){
        $validation = $this->_validation;

        $validation->reset();
        $validation->setRules([
            'upload_file_id' => 'required|numeric',
            'upload_file_status' => 'required|in_list[ACTIVE,REMOVED]'
        ]);

        if (!$validation->run($this->request->getPost())) {
            $errors = $validation->getErrors();
            return $this->respond($errors, 400);
        } else {
            $params = [
                'upload_file_id' => $this->request->getPost('upload_file_id'),
                'upload_file_status' => $this->request->getPost('upload_file_status'),
            ];

            $res = $this->Causes_m->active_causes($params);
            if ($res) {      
                $data = array(                    
                    'suceess' => true
                );
            } else {
                $data = array(                    
                    'suceess' => false
                );
            }

            return $this->respond($data);
        }
    }
}
