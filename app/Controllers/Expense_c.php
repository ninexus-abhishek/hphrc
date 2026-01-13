<?php

namespace App\Controllers;

use App\Models\Adminm\Login_m;
use App\Models\Adminm\Causes_m;
use CodeIgniter\API\ResponseTrait;

class Expense_c extends BaseController
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
        $this->_validation = \Config\Services::validation();
        $this->security = \Config\Services::security();
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

    public function add_expense()
    {
        $validation = $this->_validation;
        if ($this->request->getMethod() == 'post') {
            $validation->reset();
            $validation->setRules([
                'budget_soe' => 'required|alpha_space',
                'budget_amount' => 'required|decimal',
                'budget_year' => 'required|valid_date[Y-Y]',
            ]);

            if (!$validation->run($this->request->getPost())) {
                return redirect()->route('admin.add_expense')->with('error', COMMON_VALIDATION_ERROR_MSG)->withInput($this->request->getPost());
            } else {
                $params = [
                    'budget_soe' => $this->request->getPost('budget_soe'),
                    'budget_amount' => $this->request->getPost('budget_amount'),
                    'budget_year' => $this->request->getPost('budget_year'),
                ];

                $res = $this->Causes_m->add_expense($params);
                if ($res) {
                    //Success message : Complaint has been added
                    successOrErrorMessage("Data added successfully", 'success');
                    return redirect()->route('admin.expense' . $params['budget_year']);
                } else {
                    //Error message
                    successOrErrorMessage("something happened wrong", 'error');
                    return redirect()->route('admin.expense')->with('error', 'something happened wrong');
                }
            }
        }

        if ($this->request->getMethod() == 'get') {
            helper('form');
            $data['title'] = ADMIN_ADD_EXPENSE_TITLE;
            $data['validation'] = $validation;
            return view('pages/admin/expense/add', $data);
        }
    }

    public function edit_expense($budget_id)
    {
        $validation = $this->_validation;
        if ($this->request->getMethod() == 'post') {
            $validation->reset();
            $validation->setRules([
                'budget_soe' => 'required|alpha_space',
                'budget_amount' => 'required|decimal',
                'budget_year' => 'required|valid_date[Y-Y]',
            ]);

            if (!$validation->run($this->request->getPost())) {
                return redirect()->to('admin.edit_expense' . $budget_id)->with('error', COMMON_VALIDATION_ERROR_MSG)->withInput($this->request->getPost());
            } else {
                $params = [
                    'budget_soe' => $this->request->getPost('budget_soe'),
                    'budget_amount' => $this->request->getPost('budget_amount'),
                    'budget_year' => $this->request->getPost('budget_year'),
                ];

                $res = $this->Causes_m->edit_expense($params, $budget_id);

                if ($res) {
                    //Success message : File has been added
                    successOrErrorMessage("Data has been updated", 'success');
                    return redirect()->route('admin.edit_expanse' . $params['budget_year']);
                } else {
                    //Error message
                    successOrErrorMessage("something happened wrong", 'error');
                    return redirect()->route('admin.edit_expanse' . $budget_id)->with('error', 'something happened wrong');
                }
            }
        }

        if ($this->request->getMethod() == 'get') {
            helper('form');
            $data['budget'] = $this->Causes_m->get_single_budget($budget_id);
            $data['budget_id'] = $budget_id;
            $data['title'] = ADMIN_EDIT_EXPENSE_TITLE;
            $data['validation'] = $validation;

            return view('pages/admin/expense/edit', $data);
        }
    }

    public function expense_list($year)
    {
        if ($this->request->getMethod() == 'post') {
            $db = \Config\Database::connect();
            $view = \Config\Services::renderer();

            $offset = (int) $this->request->getVar('start') ?? 0;
            $limit = (int) $this->request->getVar('length') ?? 10;
            $order = '';
            $column = '';

            $searchValue = $this->request->getVar('search.value');

            if ($this->request->getVar('order')) {
                foreach ($this->request->getVar('order') as $req) {
                    if ($req['dir']) {
                        $order = $req['dir'];
                    }
        
                    switch ($req['column']) {
                        case 1:
                            $column = 'bg.budget_soe';
                            break;
                        case 2:
                            $column = 'bg.budget_amount';
                            break;
                        case 3:
                            $column = 'bg.budget_year';
                            break;
                        default:
                            $column = '';
                            break;
                    }
                }
            }

            $total = $db->table('budget bg')->countAll();
            
            $builder = $db->table('budget bg');
            $builder->select('bg.budget_id, bg.budget_soe,bg.budget_amount, bg.budget_year');
            $builder->where('bg.budget_year',  $year);

            if ($searchValue) {
                $builder->groupStart();
                $builder->like('bg.budget_soe', $searchValue);
                $builder->orLike('bg.budget_amount', $searchValue);
                $builder->orLike('bg.budget_year', $searchValue);
                $builder->groupEnd();
            }
            
            $filtered = (clone $builder)->countAllResults();

            if ($order) {
                $builder->orderBy($column, $order);
            }
            
            $builder->limit($limit, $offset);
            $query = $builder->get();
            $results = $query->getResult();

            $list = array();

            if (! empty($results)) {
                foreach ($results as $key => $row) {
                     $list[$key] = [   
                        "index" => $key + 1,
                        "budget_soe" => $row->budget_soe,
                        "budget_amount" => $row->budget_amount,
                        "budget_year" => $row->budget_year, 
                        "action" =>  "<a href=\"". base_url(route_to('admin.edit_expense', $row->budget_id)) ."\" target=\"_blank\" class=\"btn btn-xs btn-warning\">Edit &nbsp;<i class='fa fa-pencil'></i></a>",
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
        if ($this->request->getMethod() == 'get') {
            $data['year'] = $year;
            $data['title'] = ADMIN_EXPENSE_LIST_TITLE;
            return view('pages/admin/expense/list', $data);
        }
    }
}
