<?php

namespace App\Controllers;

use App\Models\Downloads;
use App\Models\Adminm\Causes_m;
use App\Models\Frontm\Login_m;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Exceptions\PageNotFoundException;

class Home_c extends BaseController
{
    use ResponseTrait;

    private $Causes_m;
    protected $session;
    private $_validation;
    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->session->start();
        helper('url');
        helper('functions');
        $this->Causes_m = new Causes_m();
        $this->_validation = \Config\Services::validation();
    }

    public function login()
    {
        $validation = $this->_validation;

        if ($this->request->getMethod() == 'post') {
            $validation->reset();
            $validation->setRules([
                'username' => 'required|valid_email',
                'password' => 'required',
            ]);

            if (!$validation->run($this->request->getPost())) {
                return redirect()->route('customer.login')->with('error', COMMON_VALIDATION_ERROR_MSG)->withInput($this->request->getPost());
            } else {
                $username = $this->request->getPost('username');
                $password = $this->request->getPost('password');

                $loginModel = new Login_m();
                $result = $loginModel->customer_login_select($username, $password);
                if ($result == true) {
                    return redirect()->to(BASE_URL);
                } else {
                    return redirect()->route('customer.login')->with('error', 'Invalid Username & Password.');
                }
            };
        }

        if ($this->request->getMethod() == 'get') {
            helper('form');
            if (isset($_SESSION['customer']['customer_id'])) {
                if ($_SESSION['customer']['customer_id'] > 0) {
                    logoutUser('customer');
                    return redirect()->route('customer.login');
                }
            }

            $data['title'] = FRONT_LOGIN_TITLE;
            $data['validation'] = $validation;
            return view('pages/login', $data);
        }
    }

    public function logout()
    {
        $this->session->destroy();

        return redirect()->to('/')->deleteCookie(config('App')->sessionCookieName);
    }

    public function index()
    {
        $data['title'] = FRONT_HOME_TITLE;
        return view('pages/home', $data);
    }

    public function about()
    {
        $data['title'] = FRONT_ABOUT_TITLE;
        return view('pages/about', $data);
    }

    public function download()
    {
        $data['file_type'] = $this->Causes_m->get_file_type('MAIN_TYPE');
        $data['title'] = FRONT_DOWNLOAD_TITLE;
        return view('pages/downloads', $data);
    }

    public function downloadList()
    {
        $category_code = $this->request->getVar('category_code');
        $searchValue = $this->request->getVar('search.value');

        $model = new Downloads();
        $total = $model->where('upload_file_type', $category_code)->countAllResults();

        $db = \Config\Database::connect();

        $offset = 0;
        $limit = 10;
        $order = '';
        $column = '';

        if ($this->request->getVar('start')) {
            $offset = $this->request->getVar('start');
        }

        if ($this->request->getVar('length')) {
            $limit = $this->request->getVar('length');
        }

        if ($this->request->getVar('order')) {
            foreach ($this->request->getVar('order') as $req) {
                if ($req['dir']) {
                    $order = $req['dir'];
                }
    
                switch ($req['column']) {
                    case 1:
                        $column = 'huf.upload_file_ref_no';
                        break;
                    case 2:
                        $column = 'huf.upload_file_title';
                        break;
                    case 3:
                        $column = 'hc.category_title';
                        break;
                    default:
                        $column = '';
                        break;
                }
            }
        }

        $builder = $db->table('hpshrc_upload_files huf');
        $builder->select('huf.upload_file_id, huf.upload_file_original_name, huf.upload_file_title, huf.upload_file_desc, huf.upload_file_ref_no, huf.upload_file_type, huf.upload_file_sub_type, huf.upload_file_status, huf.upload_file_location, hc.category_title');
        $builder->where('huf.upload_file_status', 'ACTIVE');
        $builder->where('huf.upload_file_type', $category_code);
        if ($searchValue) {
            $builder->like('huf.upload_file_title', $searchValue);
            $builder->orLike('huf.upload_file_ref_no', $searchValue);
            $builder->orLike('hc.category_title', $searchValue);
        }

        if ($order) {
            $builder->orderBy($column, $order);
        }

        $builder->join('hpshrc_categories hc', 'hc.category_code = huf.upload_file_type');
        $builder->limit($limit, $offset);
        $query = $builder->get();

        $results = $query->getResult();

        $list = array();

        if (! empty($results)) {
            foreach ($results as $key => $row) {
                $list[$key] = [
                    "index" => $key + 1,
                    "upload_file_ref_no" => $row->upload_file_ref_no,
                    "upload_file_title" => $row->upload_file_title,
                    "category_title_sub" => $row->category_title,
                    "upload_file_desc" => $row->upload_file_desc,
                    "download" => '<a class="download" href="'. base_url(route_to('get_file', $row->upload_file_id)) .'">Click here to download</a>',
                ];
            }
        }

        return $this->respond([
            'draw' => $this->request->getVar('draw'),
            'recordsTotal' => $total,
            'recordsFiltered' => count($list),
            'data' => (! empty($list)) ? $list : [],
        ], 200);
    }

    public function downloadFile($file_id)
    {
        $model = new Downloads();
        $file = $model->find($file_id);
        $path = WRITEPATH . 'uploads/doc/causes/';

        if (! empty($file)) {
            return $this->response->download($path . $file->upload_file_location, null);
        }

        throw PageNotFoundException::forPageNotFound();
    }

    public function complaintForm() {
        $path = WRITEPATH . 'uploads/form/HPSHRC-Offline-Complaint-Form.pdf';
        return $this->response->download($path, null);
    }

    public function budget($year)
    {
        $data['year'] = $year;
        $data['result'] = $this->Causes_m->get_expense($year);
        $data['title'] = FRONT_BUDGET_TITLE;
        return view('pages/budget', $data);
    }

    public function gallery()
    {
        $data['title'] = FRONT_GALLERY_TITLE;
        return view('pages/gallery', $data);
    }

    public function former() {
        $data['title'] = FRONT_FORMER_TITLE;
        return view('pages/former', $data);
    }

    public function contact()
    {
        $data['title'] = FRONT_CONTACT_TITLE;
        return view('pages/contact', $data);
    }

    public function page404()
    {
        $data['title'] = FRONT_404_TITLE;
        return view('errors/html/custome_error_404', $data);
    }
}
