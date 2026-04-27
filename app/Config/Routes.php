<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// ================= AUTH =================
$routes->get('/', 'Authentication::index');
$routes->get('/login', 'Authentication::index');
$routes->post('/login', 'Authentication::login');
$routes->get('/logout', 'Authentication::logout');


// ================= ADMIN ROUTES =================
$routes->group('', ['namespace' => 'App\Controllers\AdminController'], function ($routes) {

    $routes->get('/dashboard', 'Dashboard::index');

    // Employee
    $routes->get('/addEmployee', 'EmployeeController::index');
    $routes->post('/addEmployee', 'EmployeeController::store');
    $routes->get('/employees', 'EmployeeListController::index');


    // Client
    $routes->get('/addClient', 'ClientController::index');
    $routes->post('/addClient', 'ClientController::store');
    $routes->get('employee/delete/(:num)', 'EmployeeListController::delete/$1');
    $routes->get('audit-logs', 'AuditController::index');
    $routes->post('employee/update/(:num)', 'EmployeeListController::update/$1');
});


// ================= USER ROUTES =================
$routes->group('', ['namespace' => 'App\Controllers\UserController'], function ($routes) {

    $routes->get('/employeeDashboard', 'UserNavigation::index');

    // Billing
    $routes->get('/billingPage', 'BillingClients::index');
    $routes->get('/computeBilling', 'GetClientController::index');
    $routes->post('/compute_bill', 'ComputeBillsController::billComputation');

    // Billing History
    $routes->get('/billingHistory', 'BillingHistoryController::index');
});