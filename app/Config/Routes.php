<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\Auth;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::login');
$routes->get('/register', 'Auth::register');
$routes->post('/register', 'Auth::register', ['method' => 'post']);
// $routes->get('/post', 'Auth::register', ['method' => 'post']);
$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::login', ['method' => 'post']);
$routes->get('/logout', 'Auth::logout');

$routes->group('tasks', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'TaskController::index');
    $routes->get('create', 'TaskController::create');
    $routes->post('create', 'TaskController::create');
    $routes->get('edit/(:num)', 'TaskController::edit/$1');
    $routes->post('edit/(:num)', 'TaskController::edit/$1');
    $routes->get('delete/(:num)', 'TaskController::delete/$1');
    $routes->get('toggle/(:num)', 'TaskController::toggleStatus/$1');
});
