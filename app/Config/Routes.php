<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Presensi');
$routes->setDefaultMethod('presensi');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Presensi::presensi');
$routes->group('', ['filter' => 'login'], function($routes){
    $routes->get('/presensi', 'Presensi::presensi');
    $routes->get('/kehadiran', 'Presensi::kehadiran');
    $routes->get('/monitoring', 'Presensi::monitorKehadiran');
    $routes->post('/update-absendatang', 'Presensi::UpdateAbsenDatang');
    $routes->post('/update-absenpulang', 'Presensi::UpdateAbsenPulang');
    $routes->get('/fetch-absen', 'Presensi::ReadAbsen');
    $routes->get('/ajax-readabsen', 'Presensi::AjaxReadAbsen');
    $routes->get('/fetch-firstabsen', 'Presensi::Readfirstabsen');
    $routes->get('/chartstatus', 'Presensi::Ajaxchartstatus');
    $routes->get('/chartjamkerja', 'Presensi::Ajaxchartjamkerja');
    $routes->get('/batch-row', 'Presensi::BatchRow');
    $routes->get('/abs-details/(:any)', 'Presensi::AbsDetails/$1');

    //activity
    $routes->get('/act-report', 'Activity::AddActivity');
    $routes->get('/kinerja', 'Activity::Recordkinerja');
    $routes->get('/recordkinerja', 'Activity::AjaxReadKinerja');
    $routes->get('/actdetails/(:any)', 'Activity::ActDetails/$1');
    $routes->post('/editkinerja', 'Activity::EdtActivity');
    $routes->post('/checkavailabledate', 'Activity::docheckDate');
});


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
