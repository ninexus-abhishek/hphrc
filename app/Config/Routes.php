<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override(function () {
	return view('errors/html/error_404');
});
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home_c::index', ['as' => 'home', 'filter' => 'preventConcurrentSSOLogin']);
$routes->get('404_override', 'Home_c::page404');
$routes->get('errorpage', 'Home_c::page404');
//************************************Admin side route****************************//
$routes->match(['get', 'post'], 'admin-login', 'Login_c::index', ['as' => 'admin.login']);
$routes->get('admin-logout', 'Login_c::logout', ['as' => 'admin.logout']);
$routes->match(['get', 'post'], 'admin-update-profile', 'Admin_c::update_profile', ['as' => 'admin.update']);
$routes->get('admin-dashboard', 'Admin_c::dashboard', ['as' => 'admin.dashboard']);

//************causes*****************//

// $routes->get( 'admin-file-list', 'Causes_c::file_list', ['as' => 'admin.file_list']);
$routes->match(['get', 'post'], 'admin-file-list', 'Causes_c::file_list', ['as' => 'admin.file_list']);
$routes->match(['get', 'post'], 'admin-add-causes', 'Causes_c::add_causes', ['as' => 'admin.file_add']);
$routes->post('admin-active-causes', 'Causes_c::active_causes');
$routes->match(['get', 'post'], 'admin-edit-causes/(:num)', 'Causes_c::edit_causes/$1' , ['as' => 'admin.file_edit']);

$routes->post('admin-load-sub-categories', 'Causes_c::load_sub_type');
//$routes->get('admin-customers-list', 'Customers_a::customers_list', ['as' => 'admin.customer_list']);
$routes->match(['get', 'post'], 'admin-customers-list', 'Customers_a::customers_list', ['as' => 'admin.customer_list']);
$routes->post('admin-customer-approve-status', 'Customers_a::approve_status');
$routes->match(['get', 'post'], 'admin-customer-registration', 'Customers_a::create_customer', ['as' => 'admin.customer_registration']);
$routes->match(['get', 'post'], 'admin-edit-customer/(:num)', 'Customers_a::edit_customer/$1', ['as' => 'admin.edit_customer']);

//$routes->get('admin-employee-list', 'Employee_a::employee_list', ['as' => 'admin.employee_list']);
$routes->match(['get', 'post'], 'admin-employee-list','Employee_a::employee_list', ['as' => 'admin.employee_list']);
$routes->post('admin-employee-approve-status', 'Employee_a::approve_status');
$routes->match(['get', 'post'], 'admin-employee-registration', 'Employee_a::create_employee', ['as' => 'admin.employee_registration']);
$routes->match(['get', 'post'], 'admin-edit-employee/(:num)', 'Employee_a::edit_employee/$1', ['as' => 'admin.edit_employee']);

$routes->match(['get', 'post'], 'admin-add-category', 'Categories_c::add_category', ['as' => 'admin.add_category']);

$routes->get('admin-categories-list','Categories_c::categories_list', ['as' => 'admin.categories_list'] );
$routes->post('admin-categories-list/(:segment)','Categories_c::categories_list/$1', ['as' => 'admin.categories_list.param'] );

$routes->post('admin-active-category', 'Categories_c::active_category');
$routes->match(['get', 'post'], 'admin-edit-category/(:segment)', 'Categories_c::edit_category/$1', ['as' => 'admin.edit_category']);

$routes->match(['get', 'post'], 'admin-add-sub-category', 'Categories_c::add_sub_category', ['as' => 'admin.sub_category']);
$routes->match(['get', 'post'], 'admin-edit-sub-category/(:segment)', 'Categories_c::edit_sub_category/$1', ['as' => 'admin.edit.sub-category']);

$routes->match(['get', 'post'], 'admin-add-expense', 'Expense_c::add_expense', ['as' =>  'admin.add_expense']);
$routes->match(['get', 'post'], 'admin-expense-list/(:segment)', 'Expense_c::expense_list/$1', ['as' => 'admin.expense'] );
//$routes->get('admin-expense-list', 'Expense_c::expense_list/$1', ['as' => 'admin.expense_list']);
$routes->match(['get', 'post'], 'admin-edit-expense/(:num)', 'Expense_c::edit_expense/$1', ['as' => 'admin.edit_expense']);

//************************************Front side route****************************//
$routes->group('', ['filter' => 'preventConcurrentSSOLogin'], function($routes) {
	$routes->get('home', 'Home_c::index');
	$routes->get('about', 'Home_c::about', ['as' => 'about']);
	$routes->get('front-budget/(:segment)', 'Home_c::budget/$1', ['as' => 'front.budget']);
	$routes->get('front-gallery', 'Home_c::gallery', ['as' => 'gallery']);
	$routes->get('front-former', 'Home_c::former', ['as' => 'former']);
	$routes->get('contact', 'Home_c::contact', ['as' => 'contact']);
});

$routes->group('downloads', static function ($routes) {
	$routes->get('/', 'Home_c::download', ['as' => 'downloads']);
	$routes->get('all', 'Home_c::downloadList', ['as' => 'downloads.list']);
	$routes->get('file/(:num)', 'Home_c::downloadFile/$1', ['as' => 'get_file']);
});

$routes->match(['get', 'post'], 'customer-login', 'Home_c::login', ['as' => 'customer.login']);
$routes->get('customer-logout', 'Home_c::logout');
$routes->group('complaint', static function ($routes) {
	$routes->match(['get', 'post'], 'request', 'Common_c::add_cases', ['as' => 'complaint.req', 'filter' => 'customerCombo']);
	$routes->get('download-form', 'Home_c::complaintForm', ['as' => 'complaint.download']);
});

$routes->get('symlink', 'Common_c::createSymlink', ['as' => 'symlink']);
$routes->get('front-view-cases/(:segment)', 'Cases_f::view_cases/$1', ['filter' => 'customerCombo']);
$routes->group('case', static function ($routes) {
	$routes->match(['get', 'post'], 'request', 'Common_c::add_cases', ['as' => 'case.request', 'filter' => 'customerCombo']);
	$routes->match(['get', 'post'], 'list', 'Cases_f::cases_list', ['as' => 'case.list', 'filter' => 'customerCombo']);
});
$routes->post('front-add-comment', 'Cases_f::add_comment', ['as' => 'front.add.comment']);
// $routes->match(['get', 'post'], 'front-update-profile', 'Cases_f::update_profile');

$routes->match(['get', 'post'], 'forget-password/(:alpha)', 'Common_c::forget_password/$1', ['as' => 'forgotPass']);
$routes->get('change-forget-password/(:segment)', 'Common_c::forget_password_change/$1');
$routes->post('update-forget-password', 'Common_c::update_forget_password');

//************************************Employee side route****************************//
$routes->match(['get', 'post'], 'employee-login', 'Elogin_c::index', ['as' => 'emp.login']);
$routes->get('employee-logout', 'Elogin_c::logout');
$routes->match(['get', 'post'], 'employee-update-profile', 'Employee_c::update_profile', [ 'as' => 'emp.profile' ]);
$routes->get('employee-dashboard', 'Employee_c::dashboard', ['as' => 'emp.dashboard']);
$routes->get('employee-customers-list', 'Customers_e::customers_list');
$routes->match(['get', 'post'], 'employee-customer-registration', 'Customers_e::create_customer', ['as' => 'employee.customer_registration']);
$routes->match(['get', 'post'], 'employee-edit-customer/(:num)', 'Customers_e::edit_customer/$1', ['as'=> 'em.edit']);

$routes->post('approve-status', 'Customers_e::approve_status', ['as' => 'approve-status']);
$routes->match(['get', 'post'], 'employee-add-cases', 'Cases_e::add_cases', ['as' => 'employee.add_case']);
$routes->match(['get', 'post'], 'employee-edit-cases/(:num)', 'Cases_e::edit_cases/$1', ['as' => 'emp.case.edit']);
$routes->match(['get', 'post'], 'employee-list-cases', 'Cases_e::cases_list', ['as' => 'emp.case.list']);
$routes->get('employee-view-cases/(:num)', 'Cases_e::view_cases/$1',['as' => 'emp.case.view']);
$routes->post('employee-add-comment', 'Cases_e::add_comment', ['as' => 'emp.add.comment']);



//************************************Customer Registration****************************//
// $routes->match(['get', 'post'], 'customer-registration', 'Common_c::create_customer', ['as' => 'front.register']);
$routes->get('email-verify/(:segment)/(:segment)', 'Common_c::verify_email/$1/$2');

$routes->get('test-sso', 'SingleSignOn::testLogin');
$routes->get('sso-success', 'SingleSignOn::ssoSuccess');
$routes->get('sso-logout', 'SingleSignOn::ssoLogout');
// Resources
// $routes->resource('downloadslist', ['controller' => DownloadsList::class, 'only' => ['index']]);

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
