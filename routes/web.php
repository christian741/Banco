<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/////////////////////////////////////
//        PRINCIPAL               //
////////////////////////////////////
Route::get('/', function () {
    return view('inicio');
});

Route::get('/IniciarSesion', function () {
    return view('Administrador/formularioAdministrador');
});
Route::get('/Turnos', function () {
    return view('formularioTurnos');
});
Route::get('/Inicio', function () {
    return view('inicio');
});
/*Route::get('/Pantalla', function () {
    return view('pantallaTurnos');
});*/
Route::get('/ReportesCajero', 'administrador@traerDatos');
////////////////////////////////////
/// FORMULARIO  PERSONAS         //
Route::post('formularioNormal','personas@datosRegistrados');
////////////////////////////////


/////////////////////////////////////
//      MASTER CAJERO             //
////////////////////////////////////
Route::get('/Pantalla', 'administrador@traerUsuario');
Route::get('/Atender', function () {
    return view('Cajero/atenderUsuario');
});
Route::post('cajero','personas@llamarPersona');

Route::post('noCajero','personas@noAtenderPersona');

///////////////////////////////////


/////////////////////////////////////
//      MASTER ADMIN              //
///////////////////////////////////
Route::get('/RegistroCajero', function () {
    return view('Administrador/formularioCajero');
});
Route::get('/ReportesAdmin', function () {
    return view('Administrador/reportesAdmin');
});
Route::get('/CerrarSesion', 'administrador@CerrarSesion');
Route::get('/ReportesAdmin', 'administrador@traerDatos');
////////////////////////////////////
/// FORMULARIO CAJERO            //
Route::post('RegistrarCajero','administrador@crearCajero');
Route::post('formularioAdmin','administrador@datosRegistrados');
//////////////////////////////////




  





