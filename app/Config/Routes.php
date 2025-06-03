<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Routes utama
$routes->get('/', 'Beranda::index'); // Route untuk beranda
//middleware
//authorixation token
// Nutrisi Routes
$routes->get('lansia', 'LansiaController::index', ['filter' => 'cors']);
$routes->match(['post', 'options'], 'lansia', 'LansiaController::create', ['filter' => 'cors']);
$routes->match(['get', 'options'], 'lansia/(:num)', 'LansiaController::show/$1');
$routes->match(['put', 'options'], 'lansia/(:num)', 'LansiaController::update/$1');
$routes->match(['delete', 'options'], 'lansia/delete/(:num)', 'LansiaController::delete/$1');

$routes->get('remaja', 'RemajaController::index', ['filter' => 'cors']);
$routes->match(['post', 'options'], 'remaja', 'RemajaController::create', ['filter' => 'cors']);
$routes->match(['get', 'options'], 'remaja/(:num)', 'RemajaController::show/$1');
$routes->match(['put', 'options'], 'remaja/(:num)', 'RemajaController::update/$1');
$routes->match(['delete', 'options'], 'remaja/delete/(:num)', 'RemajaController::delete/$1');

$routes->get('ibu_hamil', 'IbuHamilController::index', ['filter' => 'cors']);
$routes->match(['post', 'options'], 'ibu_hamil', 'IbuHamilController::create', ['filter' => 'cors']);
$routes->match(['get', 'options'], 'ibu_hamil/(:num)', 'IbuHamilController::show/$1');
$routes->match(['put', 'options'], 'ibu_hamil/(:num)', 'IbuHamilController::update/$1');
$routes->match(['delete', 'options'], 'ibu_hamil/delete/(:num)', 'IbuHamilController::delete/$1');

$routes->get('ibu_menyusui', 'IbuMenyusuiController::index', ['filter' => 'cors']);
$routes->match(['post', 'options'], 'ibu_menyusui', 'IbuMenyusuiController::create', ['filter' => 'cors']);
$routes->match(['get', 'options'], 'ibu_menyusui/(:num)', 'IbuMenyusuiController::show/$1');
$routes->match(['put', 'options'], 'ibu_menyusui/(:num)', 'IbuMenyusuiController::update/$1');
$routes->match(['delete', 'options'], 'ibu_menyusui/delete/(:num)', 'IbuMenyusuiController::delete/$1');

// Routes untuk mendapatkan data nutrisi
$routes->get('lansia/getNutrisiPayload', 'LansiaController::getNutrisiPayload', ['filter' => 'cors']);
$routes->get('remaja/getNutrisiPayload', 'RemajaController::getNutrisiPayload', ['filter' => 'cors']);
$routes->get('ibu_hamil/getNutrisiPayload', 'IbuHamilController::getNutrisiPayload', ['filter' => 'cors']);
$routes->get('ibu_menyusui/getNutrisiPayload', 'IbuMenyusuiController::getNutrisiPayload', ['filter' => 'cors']);

// Kalkulator Gizi Routes
$routes->get('kalkulator_gizi', 'KalkulatorGiziController::index', ['filter' => 'cors']);
$routes->match(['post', 'options'], 'kalkulator_gizi/calculate', 'KalkulatorGiziController::calculate', ['filter' => 'cors']);
$routes->match(['get', 'options'], 'kalkulator_gizi/(:num)', 'KalkulatorGiziController::show/$1');
$routes->match(['put', 'options'], 'kalkulator_gizi/(:num)', 'KalkulatorGiziController::update/$1');
$routes->match(['delete', 'options'], 'kalkulator_gizi/delete/(:num)', 'KalkulatorGiziController::delete/$1');

// Berita
$routes->get('berita', 'BeritaController::index', ['filter' => 'cors']);
$routes->match(['post', 'options'], 'berita', 'BeritaController::post', ['filter' => 'cors']);
$routes->match(['get', 'options'], 'berita/(:num)', 'BeritaController::show/$1', ['filter' => 'cors']);
$routes->match(['put', 'options'], 'berita/(:num)', 'BeritaController::update/$1', ['filter' => 'cors']);
$routes->match(['delete', 'options'], 'berita/(:num)', 'BeritaController::delete/$1', ['filter' => 'cors']);

// Routes for Ibu SignUp and Login
$routes->match(['post', 'options'], 'ibu/signup', 'SignUpIbuController::post', ['filter' => 'cors']);
// Routes for Ibu SignUp and Login
$routes->match(['post', 'options'], 'ibu/login', 'LoginIbuController::login', ['filter' => 'cors']);

//penyakit
$routes->get('penyakit', 'PenyakitController::index', ['filter' => 'cors']);
$routes->match(['post', 'options'], 'penyakit', 'PenyakitController::create', ['filter' => 'cors']);
$routes->match(['get', 'options'], 'penyakit/(:num)', 'PenyakitController::show/$1');
$routes->match(['put', 'options'], 'penyakit/(:num)', 'PenyakitController::update/$1');
$routes->match(['delete', 'options'], 'penyakit/delete/(:num)', 'PenyakitController::delete/$1');

//nutrisi
$routes->get('nutrisi', 'NutrisiController::index', ['filter' => 'cors']);
$routes->match(['post', 'options'], 'nutrisi', 'NutrisiController::create', ['filter' => 'cors']);
$routes->match(['get', 'options'], 'nutrisi/(:num)', 'NutrisiController::show/$1');
$routes->match(['put', 'options'], 'nutrisi/(:num)', 'NutrisiController::update/$1');
$routes->match(['delete', 'options'], 'nutrisi/delete/(:num)', 'NutrisiController::delete/$1');

//video
$routes->get('videos', 'VideoController::index', ['filter' => 'cors']);
$routes->match(['post', 'options'], 'videos', 'VideoController::create', ['filter' => 'cors']);
$routes->match(['get', 'options'], 'videos/(:num)', 'VideoController::show/$1');
$routes->match(['put', 'options'], 'videos/(:num)', 'VideoController::update/$1');
$routes->match(['delete', 'options'], 'videos/delete/(:num)', 'VideoController::delete/$1');
$routes->get('videos/category/(:segment)', 'VideoController::getByCategory/$1');


// In app/Config/Routes.php
$routes->get('uploads/(:segment)', 'Uploads::serve/$1');

// In app/Config/Routes.php
$routes->get('ibu', 'IbuController::index', ['filter' => 'cors']);
$routes->match(['post', 'options'], 'ibu', 'IbuController::create', ['filter' => 'cors']);
$routes->match(['get', 'options'], 'ibu/(:num)', 'IbuController::show/$1', ['filter' => 'cors']);
$routes->match(['put', 'options'], 'ibu/(:num)', 'IbuController::update/$1', ['filter' => 'cors']);
$routes->match(['delete', 'options'], 'ibu/delete/(:num)', 'IbuController::delete/$1', ['filter' => 'cors']);

$routes->group('datauser', function($routes) {
    $routes->get('/', 'DataUser::index');
    $routes->post('/', 'DataUser::create');
    $routes->post('(:num)', 'DataUser::update/$1');
    $routes->delete('delete/(:num)', 'DataUser::delete/$1');
});


$routes->get('kalkulator_gizi/ibu/(:num)', 'KalkulatorGiziController::getKalkulatorData/$1'); // Mendapatkan hasil kalkulator berdasarkan ibu_id
$routes->get('profile/(:segment)', 'ProfileController::index/$1');

$routes->post('forgot-password', 'AuthController::forgotPassword');
$routes->post('reset-password/(:segment)', 'AuthController::resetPassword/$1');

$routes->options('(:any)', function() {
    return service('response')->setStatusCode(200);
});

// app/Config/Routes.php
$routes->get('api/map', 'MapController::getMapData');
$routes->post('api/map', 'MapController::addMapData');
$routes->put('api/map/(:num)', 'MapController::updateMapData/$1');
$routes->delete('api/map/(:num)', 'MapController::deleteMapData/$1');

$routes->get('api/map_asi_eksklusif', 'AsiEksklusifController::getMapData');
$routes->post('api/map_asi_eksklusif', 'AsiEksklusifController::addMapData');
$routes->put('api/map_asi_eksklusif/(:num)', 'AsiEksklusifController::updateMapData/$1');
$routes->delete('api/map_asi_eksklusif/(:num)', 'AsiEksklusifController::deleteMapData/$1');

$routes->get('api/map_pangan', 'MapPanganController::getMapData');
$routes->post('api/map_pangan', 'MapPanganController::addMapData');
$routes->put('api/map_pangan/(:num)', 'MapPanganController::updateMapData/$1');
$routes->delete('api/map_pangan/(:num)', 'MapPanganController::deleteMapData/$1');

$routes->get('api/map_gizi_balita', 'GiziBalitaController::getMapData');
$routes->post('api/map_gizi_balita', 'GiziBalitaController::addMapData');
$routes->put('api/map_gizi_balita/(:num)', 'GiziBalitaController::editMapData/$1');
$routes->delete('api/map_gizi_balita/(:num)', 'GiziBalitaController::deleteMapData/$1');

// $routes->get('/api/geojson_provinsi', 'GeojsonController::provinsi');






// // Berita Lansia
// $routes->get('berita_remaja', 'BeritaLansiaController::index', ['filter' => 'cors']);
// $routes->match(['post', 'options'], 'berita_lansia', 'BeritaLansiaController::post', ['filter' => 'cors']);
// $routes->match(['get', 'options'], 'berita_lansia/(:num)', 'BeritaLansiaController::show/$1', ['filter' => 'cors']);
// $routes->match(['put', 'options'], 'berita_lansia/(:num)', 'BeritaLansiaController::update/$1', ['filter' => 'cors']);
// $routes->match(['delete', 'options'], 'berita_lansia/(:num)', 'BeritaLansiaController::delete/$1', ['filter' => 'cors']);


// // Berita Ibu Hamil
// $routes->get('berita_ibu_hamil', 'BeritaIbuHamilController::index', ['filter' => 'cors']);
// $routes->match(['post', 'options'], 'berita_ibu_hamil', 'BeritaIbuHamilController::post', ['filter' => 'cors']);
// $routes->match(['get', 'options'], 'berita_ibu_hamil/(:num)', 'BeritaIbuHamilController::show/$1', ['filter' => 'cors']);
// $routes->match(['put', 'options'], 'berita_ibu_hamil/(:num)', 'BeritaIbuHamilController::update/$1', ['filter' => 'cors']);
// $routes->match(['delete', 'options'], 'berita_ibu_hamil/(:num)', 'BeritaIbuHamilController::delete/$1', ['filter' => 'cors']);

// // Berita Ibu Menyusui
// $routes->get('berita_ibu_menyusui', 'BeritaIbuMenyusuiController::index', ['filter' => 'cors']);
// $routes->match(['post', 'options'], 'berita_ibu_menyusui', 'BeritaIbuMenyusuiController::post', ['filter' => 'cors']);
// $routes->match(['get', 'options'], 'berita_ibu_menyusui/(:num)', 'BeritaIbuMenyusuiController::show/$1', ['filter' => 'cors']);
// $routes->match(['put', 'options'], 'berita_ibu_menyusui/(:num)', 'BeritaIbuMenyusuiController::update/$1', ['filter' => 'cors']);
// $routes->match(['delete', 'options'], 'berita_ibu_menyusui/(:num)', 'BeritaIbuMenyusuiController::delete/$1', ['filter' => 'cors']);

// Route untuk webhook
$routes->match(['post', 'options'], 'webhook', 'WebhookController::index', ['filter' => 'cors']);
