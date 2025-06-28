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
