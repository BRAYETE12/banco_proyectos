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

Route::get('/', function () { return view('auth.login'); });

Auth::routes();

Route::get('/Dependencias', 'HomeController@dependencias');
Route::get('/getDependencias', 'HomeController@getDependencias');
Route::post('/guardarDependencia', 'HomeController@guardarDependencia');

Route::get('/Usuarios', 'HomeController@usuarios');
Route::get('/getDataUsuarios', 'HomeController@getDataUsuarios');
Route::post('/guardarUsuario', 'HomeController@guardarUsuario');


Route::get('/dashboard', 'HomeController@dashboard');
Route::get('/proyectos/listado', 'ProyectoCtrl@Listado');
Route::get('/proyectos/crear', 'ProyectoCtrl@Crear');
Route::get('/proyectos/editar/{id}', 'ProyectoCtrl@Editar');

Route::get('/proyectos/getDataListado', 'ProyectoCtrl@getDataListado');
Route::get('/proyectos/getData/{id}', 'ProyectoCtrl@getData');
Route::post('/proyectos/guardarGeneral', 'ProyectoCtrl@guardarGeneral');
Route::post('/proyectos/guardarPresupuesto', 'ProyectoCtrl@guardarPresupuesto');
Route::post('/proyectos/guardarEjecucion', 'ProyectoCtrl@guardarEjecucion');
Route::post('/proyectos/guardarDocumento', 'ProyectoCtrl@guardarDocumento');
Route::post('/proyectos/guardarBitacora', 'ProyectoCtrl@guardarBitacora');
Route::post('/proyectos/guardarIntegrante', 'ProyectoCtrl@guardarIntegrante');
Route::post('/proyectos/eliminarIntegrante', 'ProyectoCtrl@eliminarIntegrante');
Route::post('/proyectos/eliminarDocumento', 'ProyectoCtrl@eliminarDocumento');
Route::post('/proyectos/eliminarBitacora', 'ProyectoCtrl@eliminarBitacora');
Route::post('/proyectos/eliminarItemPresupuesto', 'ProyectoCtrl@eliminarItemPresupuesto');
Route::post('/proyectos/eliminarItemEjecucion', 'ProyectoCtrl@eliminarItemEjecucion');
Route::post('/proyectos/buscarPersona', 'ProyectoCtrl@buscarPersona');


Route::get('/FuentesRecursos/listado', 'FuentesRecursosCtrl@getListadoFuentesRecursos');
Route::get('/FuentesRecursos/getDataListado', 'FuentesRecursosCtrl@getDataListadoFuentesRecursos');
Route::post('/FuentesRecursos/guardar', 'FuentesRecursosCtrl@guardarFuenteRecursos');

Route::get('/cdps/listado', 'FuentesRecursosCtrl@getListadoCDPS');
Route::get('/cdps/getDataListado', 'FuentesRecursosCtrl@getDataListadoCDPS');
Route::post('/cdps/guardar', 'FuentesRecursosCtrl@guardarCDP');
Route::get('/cdps/getDataRecursosCDPS/{id}', 'FuentesRecursosCtrl@getDataRecursosCDPS');
Route::post('/cdps/guardarMovimiento', 'FuentesRecursosCtrl@guardarMovimientoCDP');
Route::post('/cdps/guardarProyecto', 'FuentesRecursosCtrl@guardarProyectoCDP');


Route::get('/Reporte/CDPS', 'ReportesCtrl@cdps');
Route::get('/Reporte/FuentesRecursos', 'ReportesCtrl@fuentes');
Route::get('/Reporte/Proyectos', 'ReportesCtrl@proyectos');
Route::get('/GetDataReporte/{id}', 'ReportesCtrl@GetDataReporte');

Route::get('/ExcelProyectos', 'ReportesCtrl@ExcelProyectos');
Route::get('/ExcelFuentes', 'ReportesCtrl@ExcelFuentes');
Route::get('/ExcelCdps', 'ReportesCtrl@ExcelCdps');