<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('auth/login');
});

Route::resource('almacen/categoria','CategoriaController');
Route::resource('almacen/articulo','ArticuloController');
Route::resource('compras/proveedor','ProveedorController');
Route::resource('ventas/cliente','ClienteController');
Route::resource('ventas/ventas','VentaController');
Route::resource('compras/ingreso','IngresoController');
Route::resource('acceso/usuario','UsuarioController');
Route::resource('acceso/empresa','EmpresaController');
Route::resource('acceso/sucursal','SucursalController');
Route::resource('compras/devolucioncom','DevolucionComController');
Route::resource('ventas/devolucionven','DevolucionVenController');
Route::resource('almacen/historialpro','HistorialProController');
Route::resource('compras/ingreso/modal','ModalProsaveController');
Route::resource('almacen/indicadorproduct','IndicadorProductController');
Route::resource('ventas/indicadores','IndicadorVentasController');
Route::resource('compras/indicadores','IndicadorCompraController');


Route::get('changStatus','CategoriaController@changStatus')->name('change.status');
Route::get('changStatusa','ArticuloController@changStatusa')->name('change.statusa');
Route::get('changStatusp','ProveedorController@changStatusp')->name('change.statusp');
Route::get('changStatusc','ClienteController@changStatusc')->name('change.statusc');
Route::get('changStatusv','VentaController@changStatusv')->name('change.statusv');
Route::get('changStatusi','IngresoController@changStatusi')->name('change.statusi');
Route::get('changStatusu','UsuarioController@changStatusu')->name('change.statusu');
Route::get('changStatuse','EmpresaController@changStatuse')->name('change.statuse');
Route::get('changStatuss','SucursalController@changStatuss')->name('change.statuss');
Route::get('changStatusw','DevolucionComController@changStatusw')->name('change.statusw');
Route::get('changStatust','DevolucionVenController@changStatust')->name('change.statust');
Route::get('save_data','DevolucionComController@save_data')->name('save_dataa');
Route::get('dtdev/{id}','DevolucionComController@showdtdev')->name('dtdev');
Route::get('dtprintc/{id}','DevolucionComController@showprintc')->name('dtprintc');
Route::get('dtprinti/{id}','IngresoController@showprinti')->name('dtprinti');  ///
Route::get('dtprintvv/{id}','VentaController@showprintv')->name('dtprintvv');
Route::get('dtdevv/{id}','DevolucionVenController@showdtdev')->name('dtdevv');
Route::get('dtprintv/{id}','DevolucionVenController@showprintdv')->name('dtprintv');
Route::get('acceso/{id}/sucursal','UsuarioController@byProyect');
Route::get('acceso/{id}/sucursales','SucursalController@byProyect');
Route::get('acceso/{id}/provincia','ProveedorController@byProyect');
Route::get('acceso/{id}/ciudad','ProveedorController@byProyectcity');

Route::auth();
Route::get('/home', 'HomeController@index');


Route::resource('Inicio','InicioController');

/*Url Validación si existe dato en base o no */

Route::get('changCedulaval','ProveedorController@changCedulaval')->name('change.cedulaval');
Route::get('changCedulavalcli','ClienteController@changCedulavalcli')->name('change.cedulavalcli');
Route::get('changCodigovalart','ArticuloController@changCodigovalart')->name('change.codigovalart');
Route::get('changCodigoextvalart','ArticuloController@changCodigoextvalart')->name('change.codigoextvalart');
Route::get('saveNewProduct','ArticuloController@saveNewProducto')->name('save.saveNewProduct');

Route::get('load1Product','IndicadorProductController@load1Product')->name('load.producto');
Route::get('load1Venta','IndicadorVentasController@load1Venta')->name('load.load1Venta');
Route::get('loadCompra','IndicadorCompraController@loadCompra')->name('load.loadCompra');
Route::get('saveNewCategoria','CategoriaController@saveNewCategoria')->name('save.saveNewCategoria');



Route::post('/saveNewProduct', 'ArticuloController@saveNewProducto');

