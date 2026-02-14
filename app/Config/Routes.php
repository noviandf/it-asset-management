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
    // Barang
    $routes->get('/barang', 'Barang::index');
    $routes->get('/barang/create', 'Barang::create');
    $routes->post('/barang/store', 'Barang::store');
    $routes->get('/barang/edit/(:num)', 'Barang::edit/$1');
    $routes->post('/barang/update/(:num)', 'Barang::update/$1');
    $routes->get('/barang/delete/(:num)', 'Barang::delete/$1');

    // Catatan IT
    $routes->get('/catatanit', 'CatatanIt::index');
    $routes->get('/catatanit/create', 'CatatanIt::create');
    $routes->post('/catatanit/store', 'CatatanIt::store');
    $routes->get('/catatanit/edit/(:num)', 'CatatanIt::edit/$1');
    $routes->post('/catatanit/update/(:num)', 'CatatanIt::update/$1');
    $routes->get('/catatanit/delete/(:num)', 'CatatanIt::delete/$1');

    // Catatan Kerusakan
    $routes->get('/catatankerusakan', 'CatatanKerusakan::index');
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
});
