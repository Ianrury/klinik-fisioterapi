<?php
// filepath: /D:/laragon/www/rekam-medis-ci4/app/Config/Routes.php
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/detail/(:num)', 'Home::detail/$1');

$routes->get('/create', 'Home::create', ['filter' => 'role:admin']);
$routes->post('/register-user', 'Home::register', ['filter' => 'role:admin']);
$routes->get('/create-rm', 'Home::createRm', ['filter' => 'role:admin']);
$routes->post('/store', 'Home::store', ['filter' => 'role:admin']);

$routes->get('/pasiens', 'Home::pasien');
$routes->post('/pasiens/store', 'Home::store_pasien', ['filter' => 'role:admin']);
$routes->get('/pasiens/create', 'Home::create_pasien', ['filter' => 'role:admin']);
$routes->get('/pasiens/edit/(:num)', 'Home::edit_pasien/$1', ['filter' => 'role:admin']);
$routes->post('/pasiens/update/(:num)', 'Home::update_pasien/$1', ['filter' => 'role:admin']);
$routes->get('/pasiens/delete/(:num)', 'Home::delete_pasien/$1', ['filter' => 'role:admin']);
$routes->get('/pasiens/pasienid/(:num)', 'Home::pasienid/$1', ['filter' => 'role:admin']);
$routes->get('/kunjungan/riwayat/(:num)', 'Home::riwayat/$1');
$routes->get('/kunjungan/delete/(:num)', 'Home::delete_kunjungan/$1', ['filter' => 'role:admin']);
$routes->get('/kunjungan/verify/(:num)', 'Home::verify/$1');

$routes->get('/data/pasien', 'Home::data_pasien');
$routes->get('/kunjungan/input-data/(:num)', 'Home::input_data/$1');
$routes->post('/kunjungan/input-data', 'Home::update_terapi');
$routes->post('/search', 'Home::search');
$routes->post('/search-pasien', 'Home::search_pasien');
service('auth')->routes($routes);