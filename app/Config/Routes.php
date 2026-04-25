<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Authentication::index');
$routes->get('/login', 'Authentication::index');
$routes->post('/login', 'Authentication::login');

$routes->get('/logout', 'Authentication::logout');

$routes->group('', ['namespace' => 'App\Controllers\adminController'], function ($routes) {
    $routes->get('/dashboard', 'Dashboard::index');
    $routes->get('/addEmployee', 'AdminNavigation::index');
    $routes->get('/homePage', 'AdminNavigation::home');
    $routes->get('/addEmployee', 'EmployeeController::index');
    $routes->post('/addEmployee', 'EmployeeController::store');
    $routes->get('/employees', 'EmployeeListController::index');
    $routes->get('/addClient', 'clientController::index');
    $routes->post('/addClient', 'clientController::store');
});

$routes->group('', ['namespace' => 'App\Controllers\UserController'], function ($routes) {
    $routes->get('/employeeDashboard', 'UserNavigation::index');
    $routes->get('/billingPage', 'BillingClients::index');
    $routes->get('/computeBilling', 'GetClientController::index');
    $routes->get('/billingHistory', 'billingHistoryController::index');
    // ✅ FIXED ROUTE
    $routes->post('compute_bill', 'ComputeBillsController::billComputation');
});