<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
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
$routes->set404Override();
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('dbg', 'Auth::index');
$routes->get('logout', 'Auth::logout');
$routes->get('dashboard', 'User::index');
$routes->match(['get', 'post'], '/', 'Auth::login');
$routes->match(['get', 'post'], 'login', 'Auth::login');
$routes->match(['get', 'post'], 'register', 'Auth::register');//Server



//
$routes->match(['get', 'post'], 'settings', 'User::settings');
$routes->match(['get', 'post'], 'Server', 'User::Server');
$routes->match(['get', 'post'], 'Profile', 'User::Profile');
$routes->match(['get', 'post'], 'upload', 'User::Upload');
$routes->match(['get', 'post'], 'pic', 'User::Pic');

//
//testing
$routes->match(['get', 'post'], 'New', 'Home::index');
//$routes->get('server', 'User::server');
//

$routes->group('keys', function ($routes) {
	$routes->match(['get', 'post'], '/', 'Keys::index');
	$routes->match(['get', 'post'], 'generate', 'Keys::generate');
	$routes->get('(:num)', 'Keys::edit_key/$1');
	$routes->get('reset', 'Keys::api_key_reset');
	$routes->post('edit', 'Keys::edit_key');
	$routes->match(['get', 'post'], 'api', 'Keys::api_get_keys');
	$routes->match(['get'],'alter','Keys::alterKeys');
	$routes->match(['get'],'alterunused','Keys::alterUnusedKeys');
	$routes->match(['get'],'alterused','Keys::alterUsedKeys');
	$routes->match(['get'],'download/all','Keys::download_all_Keys');
	$routes->match(['get'],'download/used','Keys::download_used_Keys');
	$routes->match(['get'],'download/unused','Keys::download_unused_Keys');
});

$routes->group('admin', ['filter' => 'admin'], function ($routes) {
	$routes->match(['get', 'post'], 'create-referral', 'User::ref_index');
	$routes->match(['get', 'post'], 'manage-users', 'User::manage_users');
	$routes->match(['get', 'post'], 'user/(:num)', 'User::user_edit/$1');
	$routes->match(['get'],'user/alter','User::alterUser');
	$routes->match(['get'],'profile','User::Profile');

	/* --------------------------- Admin API Grouping -------------------------- */
	$routes->group('api', function ($routes) {
		$routes->match(['get', 'post'], 'users', 'User::api_get_users');
	});
});
	$routes->match(['get', 'post'],'lib','User::lib');
	$routes->match(['get', 'post'],'file_upload','User::lib_action');

$routes->match(['get', 'post'], 'connect', 'Connect::index');
$routes->match(['get', 'post'], 'forgot', 'Auth::Forgot');
//$routes->match(['get', 'post'], 'uppload', 'Uppload::index');
//$routes->match(['get', 'post'], 'uppload', 'Upload::index');     
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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
