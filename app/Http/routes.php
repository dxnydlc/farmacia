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



Route::get('logout','logController@logout');

Route::group(['middleware' => ['web']], function () {
    
    Route::resource('home','homeController');
    Route::resource('/','homeController');
    Route::resource('login','logController');


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
    Route::resource('allventas','allVentas');
    Route::resource('mb','ventasController@make_boleta');
    Route::resource('cliente','clientesController');
    Route::resource('detventa','detalle_ventaController');
    Route::resource('addProLot','productoLoteController');
    Route::resource('delventa','delVenta');
    Route::resource('usuario','UsuarioController');

    Route::resource('ex_ventas','exportDocs@all_ventas');

    Route::get('invoice_venta/{id}','ventasController@invoice');
    Route::get('invoice_pe/{id}','peController@invoice');
    Route::get('ventas_fecha/{fecha}','ventasController@venta_fecha');
    
});

