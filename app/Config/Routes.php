<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Route untuk auth
$routes->get('/', 'Auth::index');
$routes->get('/auth', 'Auth::index');
$routes->post('/auth/login', 'Auth::login');
$routes->get('/logout', 'Auth::logout');

// Grup yang membutuhkan login
$routes->group('', ['filter' => 'auth'], function($routes) {
$routes->get('/dashboard', 'Home::index');
    // Barang (Legacy)
    $routes->get('/barang', 'Barang::index');
    $routes->get('/barang/create', 'Barang::create');
    $routes->post('/barang/store', 'Barang::store');
    $routes->get('/barang/edit/(:num)', 'Barang::edit/$1');
    $routes->post('/barang/update/(:num)', 'Barang::update/$1');
    $routes->get('/barang/delete/(:num)', 'Barang::delete/$1');
    $routes->post('/barang/bulk_delete', 'Barang::bulk_delete');
    $routes->post('/barang/bulk_delete', 'Barang::bulk_delete');

    // Aset IT (EAM Baru)
    $routes->get('/asetit', 'AsetIt::index');
    $routes->get('/asetit/detail', 'AsetIt::detail');
    $routes->get('/asetit/create_multiple', 'AsetIt::create_multiple');
    $routes->post('/asetit/store_multiple', 'AsetIt::store_multiple');
    $routes->post('/asetit/bulk_delete', 'AsetIt::bulk_delete');
    $routes->post('/asetit/bulk_edit', 'AsetIt::bulk_edit');
    $routes->get('/asetit/edit/(:num)', 'AsetIt::edit/$1');
    $routes->post('/asetit/update/(:num)', 'AsetIt::update/$1');
    $routes->get('/asetit/delete/(:num)', 'AsetIt::delete/$1');
    $routes->get('/asetit/history/(:num)', 'AsetIt::history/$1');
    $routes->get('/asetit/print_labels', 'AsetIt::print_labels');
    $routes->get('/asetit/scan/(:num)', 'AsetIt::scan/$1');

    // Log Mutasi
    $routes->get('/logmutasi', 'LogMutasi::index');

    // Catatan IT
    $routes->get('/catatanit', 'CatatanIt::index');
    $routes->get('/catatanit/create', 'CatatanIt::create');
    $routes->post('/catatanit/store', 'CatatanIt::store');
    $routes->get('/catatanit/edit/(:num)', 'CatatanIt::edit/$1');
    $routes->post('/catatanit/update/(:num)', 'CatatanIt::update/$1');
    $routes->get('/catatanit/delete/(:num)', 'CatatanIt::delete/$1');

    // Catatan Kerusakan
    $routes->get('/catatankerusakan', 'CatatanKerusakan::index');
    $routes->get('/catatankerusakan/export', 'CatatanKerusakan::exportCsv');
    $routes->get('/catatankerusakan/create', 'CatatanKerusakan::create');
    $routes->post('/catatankerusakan/store', 'CatatanKerusakan::store');
    $routes->get('/catatankerusakan/edit/(:num)', 'CatatanKerusakan::edit/$1');
    $routes->post('/catatankerusakan/update/(:num)', 'CatatanKerusakan::update/$1');
    $routes->get('/catatankerusakan/delete/(:num)', 'CatatanKerusakan::delete/$1');

    // Catatan Planning
    $routes->get('/catatanplanning', 'CatatanPlanning::index');
    $routes->get('/catatanplanning/create', 'CatatanPlanning::create');
    $routes->post('/catatanplanning/store', 'CatatanPlanning::store');
    $routes->get('/catatanplanning/edit/(:num)', 'CatatanPlanning::edit/$1');
    $routes->post('/catatanplanning/update/(:num)', 'CatatanPlanning::update/$1');
    $routes->get('/catatanplanning/delete/(:num)', 'CatatanPlanning::delete/$1');
    // User Management
    $routes->get('/user', 'User::index');
    $routes->get('/user/create', 'User::create');
    $routes->post('/user/store', 'User::store');
    $routes->get('/user/edit/(:num)', 'User::edit/$1');
    $routes->post('/user/update/(:num)', 'User::update/$1');
    $routes->get('/user/delete/(:num)', 'User::delete/$1');
});
