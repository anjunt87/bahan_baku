<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

<<<<<<< HEAD
// $routes->get('/', 'Home::index');
// login
$routes->get('/', 'Login::index');
$routes->get('/login', 'Login::index');
$routes->post('/login/auth', 'Login::auth');
// Register
$routes->get('/register', 'Register::index');
$routes->post('/register/save', 'Register::save');
$routes->post('/register/save', 'Register::save');
// Logout
$routes->get('/logout', 'Login::logout');


// Halaman per role
$routes->get('/admin', 'Admin\Home::index');
$routes->get('/manager/dashboard', 'ManagerDashboard::index');
$routes->get('/user/dashboard', 'UserDashboard::index');


$routes->get('/dashboard', 'Dashboard::index', ['filter' => 'auth']);
// $routes->get('admin', 'Admin\Home::index');
=======
// login


$routes->get('/', 'Home::index');
$routes->get('admin', 'Admin\Home::index');
>>>>>>> a1db0e873e44bc891e2523d379275f537bf08e83

// Suppliers
$routes->get('admin/suppliers', 'Admin\Suppliers::index');
$routes->get('admin/suppliers/edit/(:num)', 'Admin\Suppliers::edit/$1');
$routes->post('admin/suppliers/update', 'Admin\Suppliers::update');
$routes->post('admin/suppliers/save', 'Admin\Suppliers::save');
$routes->post('admin/suppliers/delete', 'Admin\Suppliers::delete');
<<<<<<< HEAD

// Items
$routes->get('admin/listitems', 'Admin\ListItems::index');
$routes->get('admin/listitems/edit/(:num)', 'Admin\ListItems::edit/$1');
$routes->post('admin/listitems/update', 'Admin\ListItems::update');
$routes->post('admin/listitems/save', 'Admin\ListItems::save');
$routes->post('admin/listitems/delete', 'Admin\ListItems::delete');

// $routes->get('/', 'Inventory::index');
$routes->get('inventory', 'Inventory::index');
$routes->get('inventory/stockIn', 'Inventory::stockIn');
$routes->get('inventory/stockOut', 'Inventory::stockOut');
$routes->post('inventory/instock', 'Inventory::InStock');
$routes->post('inventory/outstock', 'Inventory::OutStock');
$routes->get('inventory/getItems', 'Inventory::getItems');
$routes->get('inventory/getSuppliers', 'Inventory::getSuppliers');
$routes->get('inventory/getUsers', 'Inventory::getUsers');
$routes->get('inventory/getQc', 'Inventory::getQc');







=======
>>>>>>> a1db0e873e44bc891e2523d379275f537bf08e83
