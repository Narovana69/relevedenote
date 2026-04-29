<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Catalogue::index');

$routes->group('catalogue', static function ($routes) {
    $routes->get('', 'Catalogue::index');
    $routes->get('details/(:num)', 'Catalogue::details/$1');

    $routes->get('ajouter', 'Catalogue::ajouter', ['filter' => ['auth', 'role:Administrateur,Bibliothécaire']]);
    $routes->post('ajouter', 'Catalogue::enregistrer', ['filter' => ['auth', 'role:Administrateur,Bibliothécaire']]);
    $routes->post('supprimer/(:num)', 'Catalogue::supprimer/$1', ['filter' => ['auth', 'role:Administrateur,Bibliothécaire']]);
});

$routes->group('mouvements', ['filter' => 'auth'], static function ($routes) {
    $routes->post('preter/(:num)', 'Mouvements::preter/$1');
    $routes->post('retourner/(:num)', 'Mouvements::retourner/$1');
});

$routes->get('/login', 'AuthController::login');
$routes->post('/login', 'AuthController::processLogin');
$routes->get('/logout', 'AuthController::logout');
$routes->get('/profil', 'AuthController::profil', ['filter' => 'auth']);
