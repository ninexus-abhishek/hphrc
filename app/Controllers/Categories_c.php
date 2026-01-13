<?php

namespace App\Controllers;

use App\Models\Adminm\Login_m;
use App\Models\Adminm\Causes_m;
use CodeIgniter\API\ResponseTrait;

class Categories_c extends BaseController
{
    use ResponseTrait;

    private $Login_m;
    private $Causes_m;
    private $security;
    private $userId;
    protected $session;
    private $_validation;
    public function __construct()
    {
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
            } else {
                logoutUser('admin');
                header('Location: ' . ADMIN_LOGIN_LINK);
                exit();
            }
        }
        $this->userId = (int) $_SESSION['admin']['admin_user_id'];
    }

    public function add_category()
    {
        $validation = $this->_validation;
        if ($this->request->getMethod() == 'post') {
            $validation->reset();
            $rules = [
                'category_code' => 'required|is_unique[hpshrc_categories.category_code]',
                'category_title' => 'required',
                'category_description' => 'required',
            ];
            $validation->setRules($rules, [
                'category_code' => [
                    'required' => 'The category code is required',
                    'is_unique' => 'Category field field must contain a unique value.'
                ],
               'category_title' => [
                    'required' => 'The category title is required'
               ],
               'category_description' => [
                    'required' => 'The category description is required'
               ]

            ]);
            if (!$validation->run($this->request->getPost())) {
                return redirect()->route('admin.add_category')->with('error', COMMON_VALIDATION_ERROR_MSG)->withInput($this->request->getPost());
            } else {
                $params = [
                    'category_code' => $this->request->getPost('category_code'),
                    'category_title' => $this->request->getPost('category_title'),
                    'category_description' => $this->request->getPost('category_description'),
                    'category_ref_type' => 'MAIN_TYPE',
                ];

                $res = $this->Causes_m->add_category($params);
                if ($res) {
                    //Success message : Complaint has been added
                    successOrErrorMessage("Data added successfully", 'success');
                    return redirect()->route('admin.categories_list');
                } else {
                    //Error message
                    successOrErrorMessage("something happened wrong", 'error');
                    return redirect()->route('admin.add_category')->with('error', 'something happened wrong');
                }
            }
        }

        if ($this->request->getMethod() == 'get') {
            helper('form');
            $data['title'] = ADMIN_ADD_CATEGORIES_TITLE;
            $data['validation'] = $validation;
            return view('pages/admin/categories/categories-add', $data);

        }
    }

    public function edit_category($category_code)
    {
        $validation = $this->_validation;

        if ($this->request->getMethod() == 'post') {
            $validation->reset();
            $validation->setRules([
                'category_code' => 'required|is_unique[hpshrc_categories.category_code,category_code,' . $category_code . ']',
                'category_title' => 'required',
                'category_description' => 'required',
            ]);

            if (!$validation->run($this->request->getPost())) {
                return redirect()->route('admin.edit_category' . $category_code)->with('error', COMMON_VALIDATION_ERROR_MSG)->withInput($this->request->getPost());
            } else {
                $params = [
                    'category_code' => $this->request->getPost('category_code'),
                    'category_title' => $this->request->getPost('category_title'),
                    'category_description' => $this->request->getPost('category_description'),
                ];

                $res = $this->Causes_m->edit_category($params, $category_code);
                if ($res) {
                    //Success message : File has been added
                    successOrErrorMessage("Data has been updated", 'success');
                    return redirect()->route('admin.categories_list');
                } else {
                    //Error message
                    successOrErrorMessage("something happened wrong", 'error');
                    return redirect()->route('admin.edit_category' . $category_code)->with('error', 'something happened wrong.');
                }
            }
        }

        if ($this->request->getMethod() == 'get') {
            helper('form');
            $data['category'] = $this->Causes_m->get_single_category($category_code);
            $data['category_code'] = $category_code;
            $data['title'] = ADMIN_EDIT_CATEGORIES_TITLE;
            $data['validation'] = $validation;
            return view('pages/admin/categories/edit_category', $data);
        }
    }

    public function add_sub_category()
    {
        $validation = $this->_validation;
        if ($this->request->getMethod() == 'post') {
            $validation->reset();
            $rules = [
                'ref_category_code' => 'required',
                'category_code' => 'required|is_unique[hpshrc_categories.category_code]',
                'category_title' => 'required',
                'category_description' => 'required'
            ];
            $validation->setRules($rules, [
                'ref_category_code' => [
                    'required' => 'The ref category code is required'
                ],
                'category_code' => [
                   'required' => 'The category code is required',
                   'is_unique' => 'Category field field must contain a unique value.'
                ],
                'category_title' => [
                    'required' => 'The category title is required'
                ],
                'category_description' =>  [
                    'required' => 'The category description is required'
                ]

            ]);


            if (!$validation->run($this->request->getPost())) {
                return redirect()->route('admin.sub_category')->with('error', COMMON_VALIDATION_ERROR_MSG)->withInput($this->request->getPost());
            } else {
                $params = [
                    'ref_category_code' => $this->request->getPost('ref_category_code'),
                    'category_code' => $this->request->getPost('category_code'),
                    'category_title' => $this->request->getPost('category_title'),
                    'category_description' => $this->request->getPost('category_description'),
                    'category_ref_type' => 'SUB_TYPE',
                ];

                $res = $this->Causes_m->add_category($params);
                if ($res) {
                    //Success message : Complaint has been added
                    successOrErrorMessage("Data added successfully", 'success');
                    return redirect()->route('admin.categories_list');
                } else {
                    //Error message
                    successOrErrorMessage("something happened wrong", 'error');
                    return redirect()->route('admin.sub_category')->with('error', 'something happened wrong');
                }
            }
        }

        if ($this->request->getMethod() == 'get') {
            helper('form');
            $data['file_type'] = $this->Causes_m->get_file_type('MAIN_TYPE');
            $data['title'] = ADMIN_ADD_SUB_CATEGORIES_TITLE;
            $data['validation'] = $validation;
            return view('pages/admin/categories/add_subcategory', $data);
        }
    }

    public function edit_sub_category($category_code)
    {
        $validation = $this->_validation;
        if ($this->request->getMethod() == 'post') {
            $validation->reset();
            $validation->setRules([
                'ref_category_code' => 'required',
                'category_code' => 'required|is_unique[hpshrc_categories.category_code,category_code,' . $category_code . ']',
                'category_title' => 'required',
                'category_description' => 'required'
            ]);

            if (!$validation->run($this->request->getPost())) {
                return redirect()->route('admin.edit.sub-category' . $category_code)->with('error', COMMON_VALIDATION_ERROR_MSG)->withInput($this->request->getPost());
            } else {
                $params = [
                    'ref_category_code' => $this->request->getPost('ref_category_code'),
                    'category_code' => $this->request->getPost('category_code'),
                    'category_title' => $this->request->getPost('category_title'),
                    'category_description' => $this->request->getPost('category_description'),
                    'category_ref_type' => 'SUB_TYPE',
                ];

                $res = $this->Causes_m->edit_category($params, $category_code);
                if ($res) {
                    //Success message : File has been added
                    successOrErrorMessage("Data has been updated", 'success');
                    return redirect()->route('admin.categories_list');
                } else {
                    //Error message
                    successOrErrorMessage("something happened wrong", 'error');
                    return redirect()->route('admin.edit.sub-category' . $category_code)->with('error', 'something happened wrong');
                }
            }
        }

        if ($this->request->getMethod() == 'get') {
            helper('form');
            $data['file_type'] = $this->Causes_m->get_file_type('MAIN_TYPE');
            $data['category'] = $this->Causes_m->get_single_category($category_code);
            $data['category_code'] = $category_code;
            $data['title'] = ADMIN_EDIT_SUB_CATEGORIES_TITLE;
            $data['validation'] = $validation;
            return view('pages/admin/categories/edit_subcategory', $data);
        }
    }

    public function categories_list($type = null)
    {
        if ($this->request->getMethod() == 'post') {
            $db = \Config\Database::connect();

            switch ($type) {
                case 'main':
                    $_type = "MAIN_TYPE";
                    break;
                case 'sub':
                    $_type = "SUB_TYPE";
                    break;
                default:
                $_type = "";
                    break;
            }

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
                            $column = 'hc.category_code';
                            break;
                        case 2:
                            $column = 'hc.category_title';
                            break;
                        case 3:
                            $column = 'hc.ref_category_code';
                            break;
                        default:
                            $column = '';
                            break;
                    }
                }
            }

            $total = $db->table('hpshrc_categories hc')->where('hc.category_ref_type', $_type)->countAllResults();

            $builder = $db->table('hpshrc_categories hc');
            $builder->select('hc.category_code, hc.category_title, hc.category_description, hc.ref_category_code, hc.category_ref_type, hc.category_status');
            $builder->where('hc.category_ref_type', $_type);

            $searchValue = $this->request->getVar('search.value');

            if ($searchValue) {
                $builder->groupStart()
                    ->like('hc.category_title', $searchValue)
                    ->orLike('hc.category_ref_type', $searchValue)
                    ->orLike('hc.ref_category_code', $searchValue)
                    ->groupEnd();
            }

            $filtered = (clone $builder)->countAllResults();

            if ($column && $order) {
                $builder->orderBy($column, $order);
            }

            $builder->limit($limit, $offset);
            $query = $builder->get();
            $results = $query->getResult();

            $list = array();

            if (! empty($results)) {
                foreach ($results as $key => $row) {

                    if ($row->category_ref_type == "SUB_TYPE" && ! empty($row->category_code)) {
                        $edit_btn = "<a href=\"". base_url(route_to('admin.edit.sub-category', $row->category_code)) ."\" target=\"_blank\" class=\"btn btn-xs btn-warning\">Edit &nbsp;<i class='fa fa-pencil'></i></a>";
                    } else if (! empty($row->category_code)) {
                        $edit_btn = "<a href=\"". base_url(route_to('admin.edit_category', $row->category_code)) ."\" target=\"_blank\" class=\"btn btn-xs btn-warning\">Edit &nbsp;<i class='fa fa-pencil'></i></a>";
                    } else {
                        $edit_btn = null;
                    }

                    $isactive = 1;
                    $title = 'Click to deactivate causes';
                    $class = 'btn_approve_reject btn btn-success btn-xs';
                    $text = 'Active';
                    $list[$key] = [   
                        "index" => $key + 1,
                        "category_code" => (string) $row->category_code,
                        "category_title" => $row->category_title,
                        "category_description" => $row->category_description,
                        "ref_category_code" => $row->ref_category_code, 
                        "category_ref_type" => $row->category_ref_type,
                        "category_status" => "<button type='button' data-id='" . $row->category_code . "'data-status = '" . $isactive . "' title='" . $title . "' class='" . $class . " '>" . $text . "</button>",
                        "action" =>  $edit_btn,
                    ];
                }
            }
            
            return $this->respond([
                'draw' => $this->request->getVar('draw'),
                'recordsTotal' => $total,
                'recordsFiltered' => $filtered,
                'data' => (! empty($list)) ? $list : [],
            ]);
        }

        if($this->request->getMethod() == 'get'){
            $data['title'] = ADMIN_CATEGORIES_LIST_TITLE;
            return view('pages/admin/categories/categories_list', $data);
        }
    }

    public function active_category()
    {
        $validation = $this->_validation;

        $validation->reset();
        $validation->setRules([
            'category_code' => 'required',
            'category_status' => 'required|in_list[ACTIVE,REMOVED]',
        ]);

        if (!$validation->run($this->request->getPost())) {
            $errors = $validation->getErrors();
            return $this->respond($errors, 400);
        } else {
            $params = [
                'category_code' => $this->request->getPost('category_code'),
                'category_status' => $this->request->getPost('category_status'),
            ];

            $res = $this->Causes_m->active_category($params);
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
