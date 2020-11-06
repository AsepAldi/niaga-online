<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();
$session = Services::session();

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
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Pembeli::index');
// $routes->get('/', $session->get('level') == null ? 'Auth::index' : ($session->get('level') == 'admin' ? 'Admin::index' : 'pengguna') );
$routes->get('/admin_pengguna', $session->get('level') == 'admin_pengguna' ? 'Admin_pengguna::index' : 'Auth::block');
$routes->get('/admin_laporan', $session->get('level') == 'admin_laporan' ? 'Admin_laporan::index' : 'Auth::block');
$routes->get('/admin_pengguna/(:hash)', $session->get('level') == 'admin_pengguna' ? 'Admin_pengguna::$1' : 'Auth::block');
$routes->get('/admin_laporan/(:hash)', $session->get('level') == 'admin_laporan' ? 'Admin_laporan::$1' : 'Auth::block');
$routes->get('/penjual', $session->get('level') == 'penjual' ? 'Penjual::utama' : 'Auth::block');
$routes->get('/penjual/(:hash)', $session->get('level') == 'penjual' ? 'Penjual::$1' : 'Auth::block');
// $routes->get('/admin/(:hash)', $session->get('level') == 'admin' ? 'Admin::$1' : 'Auth::block');
// $routes->get('/pengguna/(:hash)', $session->get('level') == 'pembeli' ? 'Pengguna::$1' : 'Auth::block');


/**
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
