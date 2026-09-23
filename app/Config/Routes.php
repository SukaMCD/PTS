<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// Public & Pelanggan Routes
$routes->get('/', 'Home::index');
$routes->get('makanan/(:segment)', 'Home::detail/$1');
$routes->post('pesan', 'PesananController::store');
$routes->get('riwayat', 'PesananController::riwayat');
$routes->get('pesanan/batal/(:num)', 'PesananController::batalUser/$1');

// Auth Routes (Login, Register, Logout)
$routes->get('login', 'AuthController::login');
$routes->post('login', 'AuthController::processLogin');
$routes->get('register', 'AuthController::register');
$routes->post('register', 'AuthController::processRegister');
$routes->get('logout', 'AuthController::logout');

// LEVEL 1: KHUSUS ADMIN (Master Data & Manajemen Akun)
$routes->group('admin', ['filter' => 'role:admin'], function($routes) {
    // Master Makanan CRUD
    $routes->get('makanan', 'MakananController::index');
    $routes->get('makanan/create', 'MakananController::create');
    $routes->post('makanan/store', 'MakananController::store');
    $routes->get('makanan/edit/(:num)', 'MakananController::edit/$1');
    $routes->post('makanan/update/(:num)', 'MakananController::update/$1');
    $routes->get('makanan/delete/(:num)', 'MakananController::delete/$1');

    // Manajemen Pengguna & Hak Akses
    $routes->get('users', 'UserController::index');
    $routes->post('users/update-role/(:num)', 'UserController::updateRole/$1');
    $routes->get('users/delete/(:num)', 'UserController::delete/$1');

    // Rekapitulasi & Laporan Penjualan
    $routes->get('laporan', 'PesananController::laporanAdmin');
});

// LEVEL 2: OPERASIONAL PETUGAS & KASIR OUTLET
$routes->group('petugas', ['filter' => 'role:petugas,admin'], function($routes) {
    // Validasi & Update Status Transaksi Masuk
    $routes->get('pesanan', 'PesananController::indexPetugas');
    $routes->post('pesanan/status/(:num)', 'PesananController::updateStatus/$1');
    
    // Monitoring Stok Menu
    $routes->get('stok', 'MakananController::stokPetugas');
});
