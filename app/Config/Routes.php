<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// login
$routes->get('/', 'Login::index');
$routes->get('/login', 'Login::index');
$routes->post('/login/auth', 'Login::auth');

// Register
$routes->get('/register', 'Register::index');
$routes->post('/register/save', 'Register::save');

// Logout
$routes->get('/logout', 'Login::logout');

// Halaman per role
$routes->get('/admin', 'Admin\Index::index');
$routes->get('/manager', 'Manager\Index::index');
$routes->get('/staff', 'Staff\Index::index');

// Department routes
$routes->get('/admin/department', 'Admin\Department::index');
$routes->post('/admin/department/save', 'Admin\Department::save');
$routes->get('/admin/department/edit/(:num)', 'Admin\Department::edit/$1');
$routes->post('/admin/department/update/(:num)', 'Admin\Department::update/$1');
$routes->post('/admin/department/delete/(:num)', 'Admin\Department::delete/$1');

// Division routes
$routes->get('/admin/division', 'Admin\Division::index');
$routes->post('/admin/division/save', 'Admin\Division::save');
$routes->get('/admin/division/edit/(:num)', 'Admin\Division::edit/$1');
$routes->post('/admin/division/update/(:num)', 'Admin\Division::update/$1');
$routes->post('/admin/division/delete/(:num)', 'Admin\Division::delete/$1');

// Suppliers
$routes->get('/admin/suppliers', 'Admin\Suppliers::index');
$routes->get('/admin/suppliers/edit/(:num)', 'Admin\Suppliers::edit/$1');
$routes->post('/admin/suppliers/update', 'Admin\Suppliers::update');
$routes->post('/admin/suppliers/save', 'Admin\Suppliers::save');
$routes->post('/admin/suppliers/delete', 'Admin\Suppliers::delete');

// Admin Users routes
$routes->get('/admin/users', 'Admin\Users::index');
$routes->post('/admin/users/save', 'Admin\Users::save');
$routes->get('/admin/users/edit/(:num)', 'Admin\Users::edit/$1');
$routes->post('/admin/users/update', 'Admin\Users::update');
$routes->post('/admin/users/delete', 'Admin\Users::delete');

// Cari users berdasarkan division dan department
$routes->get('/divisioncontroller/getDivisions', 'Users::getDivisions');
$routes->get('/divisioncontroller/getDivisionsByDepartment/(:num)', 'Users::getDivisionsByDepartment/$1');
$routes->get('/divisioncontroller/getUsersByDivision/(:num)', 'Users::getUsersByDivision/$1');



// Setting Items 
$routes->get('/admin/listitems', 'Admin\ListItems::index');
$routes->get('/admin/listitems/edit/(:num)', 'Admin\ListItems::edit/$1');
$routes->post('/admin/listitems/update', 'Admin\ListItems::update');
// $routes->post('/admin/listitems/save', 'Admin\ListItems::save');
$routes->post('/admin/listitems/delete', 'Admin\ListItems::delete');
$routes->post('/admin/listitems/save', 'Admin\ListItems::save');


// Route to display roles list
$routes->get('/admin/roles', 'Admin\Roles::index');
$routes->get('/admin/roles/edit/(:num)', 'Admin\Roles::edit/$1');
$routes->post('/admin/roles/update', 'Admin\Roles::update');
$routes->post('/admin/roles/save', 'Admin\Roles::save');
$routes->post('/admin/roles/delete/(:num)', 'Admin\Roles::delete/$1');

// Routes for ItemController list Item Outbound
$routes->get('/items', 'ItemController::index');

// Routes for CartController Outbound
$routes->get('/cart', 'CartController::index');
$routes->post('/cart/add', 'CartController::add');
$routes->post('/cart/remove/(:num)', 'CartController::remove/$1');
$routes->post('/cart/update_quantity', 'CartController::update_quantity');

// Routes for CheckoutController Outbound
$routes->get('/checkout', 'CheckoutController::index');
$routes->get('/checkout/process', 'CheckoutController::process');
$routes->post('/checkout/process', 'CheckoutController::process');
$routes->get('/checkout/getUsers', 'CheckoutController::getUsers');

// Routes for OutboundController
$routes->get('/outbound/history', 'OutboundController::history');
$routes->get('/outbound/detail/(:num)', 'OutboundController::detail/$1');
$routes->get('/outbound/success', 'OutboundController::success');
$routes->get('/outbound/print/(:num)', 'OutboundController::print/$1');

// Routes for NeedItemsController
$routes->get('/needitems', 'NeedItemsController::index');
$routes->get('/needitems/create', 'NeedItemsController::create');
$routes->get('/needitems/history', 'NeedItemsController::history');
$routes->get('/needitems/detail/(:num)', 'NeedItemsController::detail/$1');
$routes->post('/needitems/store', 'NeedItemsController::store');
$routes->post('/needitems/updateStatus', 'NeedItemsController::updateStatus');
$routes->post('/needitems/updateStatusBundles', 'NeedItemsController::updateStatusBundles');

// Routes for PreOrderController
$routes->get('/pre_order', 'PreOrderController::index');
$routes->get('/pre_order/history', 'PreOrderController::history');
$routes->get('/pre_order/detail/(:num)', 'PreOrderController::detail/$1');
$routes->get('/pre_order/delete/(:num)', 'PreOrderController::delete/$1');

// Routes for PreOrderCartController
$routes->get('/pre_order/cart', 'PreOrderCartController::index');
$routes->get('/pre_order/cart/checkout', 'PreOrderCartController::checkout');
$routes->post('/pre_order/cart/remove/(:num)', 'PreOrderCartController::remove/$1');
$routes->post('/pre_order/cart/add', 'PreOrderCartController::add');
$routes->post('/pre_order/cart/update_quantity', 'PreOrderCartController::update_quantity');

// Routes for PreOrderCheckOutController
$routes->get('/pre_order/checkout', 'PreOrderCheckOutController::index');
$routes->get('/pre_order/checkout/process', 'PreOrderCheckOutController::process');
$routes->get('/pre_order/getSuppliers', 'PreOrderCheckOutController::getSuppliers');
$routes->get('/pre_order/getSupplierContact', 'PreOrderCheckOutController::getSupplierContact');
$routes->post('/pre_order/checkout/process', 'PreOrderCheckOutController::process');
$routes->post('/pre_order/saveOrder', 'PreOrderCheckOutController::saveOrder');

// Routes for InboundController
$routes->get('/inbound', 'InboundController::index');
$routes->get('/inbound/history', 'InboundController::history');
$routes->get('/inbound/check/(:num)', 'InboundController::check/$1');
$routes->get('/inbound/detailcheck/(:num)', 'InboundController::detailcheck/$1');
$routes->get('/inbound/detail_history/(:num)', 'InboundController::detailhistory/$1');
$routes->post('/inbound/checkitems', 'InboundController::checkitems');
$routes->post('/inbound/saveUpdatedPreOrder', 'InboundController::saveUpdatedPreOrder');

// Routes for ReportController
$routes->match(['get', 'post'], '/report/stock', 'ReportController::stockReport');
$routes->match(['get', 'post'], '/report/pre_order', 'ReportController::preOrderReport');
$routes->match(['get', 'post'], '/report/preOrderdetail/(:num)', 'ReportController::preOrderdetail/$1');
$routes->match(['get', 'post'], '/report/outboundDetail/(:num)', 'ReportController::outboundDetail/$1');
$routes->match(['get', 'post'], '/report/outbound', 'ReportController::outboundReport');
$routes->match(['get', 'post'], '/report/inbound', 'ReportController::inboundReport');
$routes->match(['get', 'post'], '/report/inboundDetail/(:num)', 'ReportController::inboundDetail/$1');

// Transaction Success
$routes->get('/transaction/outboundsuccess', 'TransactionController::outboundsuccess');
$routes->get('/transaction/inboundsuccess', 'TransactionController::inboundsuccess');

// Notifications
$routes->get('/notifications/getLowStockNotifications', 'NotificationsController::getLowStockNotifications');
