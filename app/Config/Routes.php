<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Main');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
//telas
$routes->get('/login', 'Main::index');
$routes->get('/Dashboard', 'Dash_controller::dashleet',['filter' => 'authGuard']);
$routes->get('/CadsPedidos', 'CadsPedido_controller::CadsPedidos');
$routes->get('/CadsCliente', 'Dash_controller::CadsCliente');
$routes->get('/CadsProduto', 'Dash_controller::CadsProduto');
$routes->get('/CadsUsuario', 'Dash_controller::CadsUsuario');
$routes->get('/CadsAcrescimo', 'Dash_controller::CadsAcrescimo');
$routes->get('/pdfLeet', 'pdfLeet_controller::pdfLeet');///(:any)/$1


//controllers
$routes->post('/InsereDadosCliente', 'Cliente_controller::InsereDadosCliente');
$routes->get('/getClientes', 'Cliente_controller::getClientes', ['filter' => 'authGuard']);
$routes->post('/InsereDadosUsuario', 'Usuario_controller::InsereDadosUsuario');
$routes->get('/getUsuario', 'Usuario_controller::getUsuario');
$routes->post('/InsereDadosProduto', 'Cadsproduto_controller::InsereDadosProduto');
$routes->post('/InsereDadosAcrescimos', 'Acrescimos_controller::InsereDadosAcrescimos');
$routes->get('/getProduto', 'Cadsproduto_controller::getProduto');
$routes->post('/InsereDadosPedido', 'CadsPedido_controller::InsereDadosPedido');
$routes->get('/getPedido', 'CadsPedido_controller::getPedido');

//functions
$routes->post('/CarregaPedido', 'CadsPedido_controller::CarregaEditaPedido');
$routes->post('/CarregaCliente', 'Cliente_controller::CarregaEditaCliente');
$routes->post('/CarregaAcresc', 'Acrescimos_controller::CarregaEditaAcresc');
$routes->post('/CarregaProduto', 'Cadsproduto_controller::CarregaEditaProduto');
$routes->post('/CarregaUsuario', 'Usuario_controller::CarregaEditaUsuario');
$routes->post('/getall', 'Cadsproduto_controller::getAllProd');
$routes->post('/getCliente', 'Cliente_controller::getAllCliente');
$routes->post('/getAcrescimo', 'Acrescimos_controller::getAcrescimo');
$routes->post('/excluiPedido', 'CadsPedido_controller::ExcluiPedido');
$routes->post('/excluiAcresc', 'Acrescimos_controller::excluiAcresc');
$routes->post('/excluiProdPedido', 'CadsPedido_controller::ExcluiProdPedido');
$routes->post('/ListaAcrescimo', 'CadsPedido_controller::acrescimoProd');
$routes->post('/CarregaAcrescimosProduto', 'CadsPedido_controller::CarregaAcrescimosProduto');
$routes->post('/situacao_cliente', 'Cliente_controller::situacao_cliente');
$routes->post('/situacao_usuario', 'Usuario_controller::situacao_usuario');
$routes->post('/listaEstado', 'Cliente_controller::getEstado');
$routes->post('/listaEstado', 'CadsPedido_controller::getEstado');
$routes->post('/cidadeporID', 'Cliente_controller::getCidade');
$routes->post('/cidadeporID', 'CadsPedido_controller::getCidade');
$routes->post('/pegaId', 'Cliente_controller::pegaId');
$routes->post('/pegaId', 'CadsPedido_controller::pegaId');
$routes->post('/verificaLogin', 'Login_Controller::verificaLogin');
$routes->post('/Pdfleet', 'pdfleet_controller::ListaAcrescimfuncaopuxaostremo');
$routes->get('/logout', 'Login_Controller::logout');



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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
