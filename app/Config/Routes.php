<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// login


$routes->get('/', 'Home::index');
$routes->get('admin', 'Admin\Home::index');

// Suppliers
$routes->get('admin/suppliers', 'Admin\Suppliers::index');
$routes->get('admin/suppliers/edit/(:num)', 'Admin\Suppliers::edit/$1');
$routes->post('admin/suppliers/update', 'Admin\Suppliers::update');
$routes->post('admin/suppliers/save', 'Admin\Suppliers::save');
$routes->post('admin/suppliers/delete', 'Admin\Suppliers::delete');
