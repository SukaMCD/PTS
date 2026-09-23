<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// Public Routes (Dashboard Sebelum Login / Showcase Restoran)
$routes->get('/', 'Home::index');
$routes->get('makanan/(:segment)', 'Home::detail/$1');

// Auth Routes (Login, Logout)
$routes->get('login', 'AuthController::login');
$routes->post('login', 'AuthController::processLogin');
$routes->get('logout', 'AuthController::logout');

// Protected Admin / Petugas CRUD Routes
$routes->group('admin', ['filter' => 'auth'], function($routes) {
    $routes->get('makanan', 'MakananController::index');
    $routes->get('makanan/create', 'MakananController::create');
    $routes->post('makanan/store', 'MakananController::store');
    $routes->get('makanan/edit/(:num)', 'MakananController::edit/$1');
    $routes->post('makanan/update/(:num)', 'MakananController::update/$1');
    $routes->get('makanan/delete/(:num)', 'MakananController::delete/$1');
});
