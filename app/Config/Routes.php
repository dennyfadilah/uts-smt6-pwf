<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'HomeController::index', ['filter' => 'auth']);
$routes->match(['get', 'post'], '/login', 'UserController::login');
$routes->match(['get', 'post'], '/register', 'UserController::register');
$routes->get('/logout', 'UserController::logout', ['filter' => 'auth']);

$routes->group('users', ['filter' => 'auth'], function ($routes) {
    $routes->match(['get', 'post'], '/', 'UserController::index');
    $routes->match(['get', 'post'], 'create', 'UserController::create');
    $routes->match(['get', 'post'], '(:any)/(:num)', 'UserController::$1/$2');
});

$routes->group('products', ['filter' => 'auth'], function ($routes) {
    $routes->match(['get', 'post'], '/', 'ProductController::index');
    $routes->match(['get', 'post'], 'create', 'ProductController::create');
    $routes->match(['get', 'post'], '(:any)/(:num)', 'ProductController::$1/$2');
});

$routes->group('transactions', ['filter' => 'auth'], function ($routes) {
    $routes->match(['get', 'post'], '/', 'TransactionController::index');
    $routes->match(['get', 'post'], 'create', 'TransactionController::create');
    $routes->match(['get', 'post'], '(:any)/(:num)', 'TransactionController::$1/$2');
});

$routes->group('api', function ($routes) {
    $routes->get('get-by-category/(:any)', 'APIController::getProductsByCategory/$1');
    $routes->get('get-unit-price/(:any)', 'APIController::getUnitPrice/$1');
});
