<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'LoginAdministrator::index');
$routes->get('/dbtest', 'DBTest::index');

$routes->get('/dashboardadministrator', 'DashboardAdministrator::index',['filter'=>'auth']);

$routes->get('/registeradministrator', 'RegisterAdministrator::index');
$routes->post('/registeradministrator/save', 'RegisterAdministrator::save');
$routes->get('/registeradministrator/edit/(:num)', 'RegisterAdministrator::edit/$1');
$routes->post('/registeradministrator/update/(:num)', 'RegisterAdministrator::update/$1');
$routes->get('/registeradministrator/confirmdeleteadministrator/(:num)', 'RegisterAdministrator::confirmdelete/$1');
$routes->post('/registeradministrator/delete/(:num)', 'RegisterAdministrator::delete/$1');

$routes->get('/loginadministrator', 'LoginAdministrator::index');
$routes->post('/loginadministrator/auth', 'LoginAdministrator::auth');
$routes->get('/logout', 'LoginAdministrator::index');

$routes->get('/atursiswa', 'AturSiswa::index',['filter'=>'auth']);
$routes->post('/atursiswa/save', 'AturSiswa::save');
$routes->get('/atursiswa/edit/(:num)', 'AturSiswa::edit/$1');
$routes->post('/atursiswa/update/(:num)', 'AturSiswa::update/$1');
$routes->get('/atursiswa/confirmdelete/(:num)', 'AturSiswa::confirmdelete/$1');
$routes->post('/atursiswa/delete/(:num)', 'AturSiswa::delete/$1');

$routes->get('/aturinfaq', 'AturInfaq::index',['filter'=>'auth']);
$routes->post('/aturinfaq/save', 'AturInfaq::save');
$routes->get('/aturinfaq/edit/(:num)', 'AturInfaq::edit/$1');
$routes->post('/aturinfaq/update/(:num)', 'AturInfaq::update/$1');
$routes->get('/aturinfaq/confirmdeleteinfaq/(:num)', 'AturInfaq::confirmdeleteinfaq/$1');
$routes->post('/aturinfaq/delete/(:num)', 'AturInfaq::delete/$1');

$routes->get('/pembayaran', 'Pembayaran::index',['filter'=>'auth']);
$routes->post('/pembayaran/save', 'Pembayaran::save');
$routes->get('/pembayaran/searchSiswa', 'Pembayaran::searchSiswa');
$routes->get('/pembayaran/getInfaqByKelas', 'Pembayaran::getInfaqByKelas');
$routes->get('/pembayaran/getTagihanForPembayaran', 'Pembayaran::getTagihanForPembayaran');
$routes->get('/pembayaran/detail/(:num)', 'Pembayaran::detailPembayaran/$1');
$routes->get('/pembayaran/delete/(:num)', 'Pembayaran::delete/$1');
$routes->post('/pembayaran/deleteall/(:num)', 'Pembayaran::deleteall/$1');

$routes->get('/tagihan', 'Tagihan::index',['filter'=>'auth']);
$routes->get('/tagihan/daftartagihan/(:num)', 'Tagihan::daftartagihan/$1');
$routes->get('/tagihan/lihatkartu', 'Tagihan::lihatkartu');
$routes->post('/tagihan/buattagihan', 'Tagihan::buatTagihan');
$routes->post('/tagihan/checkbox', 'Tagihan::checkbox');
$routes->get('/tagihan/detail/(:num)', 'Tagihan::detail/$1');
$routes->get('/tagihan/request/(:num)', 'Tagihan::request/$1');
$routes->get('/tagihan/requestdetail', 'Tagihan::requestdetail');
$routes->get('/pdf/tagihan/(:num)', 'PdfController::tagihan/$1');

$routes->get('/request_tagihan', 'RequestTagihan::index',['filter'=>'auth']);
$routes->post('/request_tagihan/save','RequestTagihan::save');
$routes->get('/request_tagihan/edit/(:num)', 'RequestTagihan::edit/$1');
$routes->post('/request_tagihan/update/(:num)', 'RequestTagihan::update/$1');
$routes->get('/request_tagihan/delete/(:num)', 'RequestTagihan::delete/$1');

$routes->get('/siswa', 'carisiswa::index');
$routes->get('/infaq', 'cariinfaq::index');

$routes->get('/export-pdf', 'PdfController::exportToPdf');

$routes->get('/export-pdf/infaq', 'PdfController::exportInfaq');

$routes->get('/laporanbulanan', 'LaporanBulanan::index',['filter'=>'auth']);
$routes->get('/pdf/laporanbulanan/(:segment)', 'PdfController::laporanBulanan/$1');
$routes->get('/laporantahunan', 'LaporanTahunan::index',['filter'=>'auth']);

$routes->get('/pdf/laporantahunan', 'PdfController::laporanTahunan');

