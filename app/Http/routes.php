<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('index');
});
Route::resource('login','logController');


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::get('invoice_pe/{id}','peController@invoice');
Route::get('invoice_venta/{id}','ventasController@invoice');

Route::group(['middleware' => ['web']], function () {
    Route::resource('categoria','categoriaController');
    Route::resource('marca','marcaController');
    Route::resource('clase','claseController');
    Route::resource('proveedor','proveedorController');
    
    Route::resource('producto','productoController');
    Route::get('producto/{q}','productoController@buscar');

    Route::resource('detpe','detallePEController');

    Route::resource('pe','peController');
    Route::resource('kardex','kardexController');
    Route::resource('ventas','ventasController');
    Route::resource('cliente','clientesController');
    Route::resource('detventa','detalle_ventaController');
    Route::resource('addProLot','productoLoteController');
    
});

