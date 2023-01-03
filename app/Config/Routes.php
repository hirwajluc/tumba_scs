<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('MainController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'MainController::index');
$routes->get('/login', 'Login::index', ['as' => 'login']);
$routes->get('/logout', 'Logout::index', ['as' => 'logout']);
$routes->post('/authenticate', 'Login::authenticate', ['as' => 'user.log']);

$routes->group("admin", function($routes){
    $routes->add('home', 'MainController::index', ['as' => 'admin.home']);
    $routes->get('student', 'MainController::newStudentForm', ['as' => 'student.new']);
    $routes->get('allStd', 'MainController::viewStudents', ['as' => 'student.list']);
    $routes->get('stdInfo/(:num)', 'MainController::getStudentInfo/$1', ['as' => 'student.info']);
    $routes->get('stdEdit/(:num)', 'MainController::editStudent/$1', ['as' => 'student.edit']);
});

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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
