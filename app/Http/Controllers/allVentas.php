<?php

namespace farmacia\Http\Controllers;

use Illuminate\Http\Request;

use farmacia\Http\Requests;

use farmacia\venta;
use farmacia\logs;
use farmacia\clientes;
use farmacia\kardex;
use farmacia\productos;
use farmacia\config;

use Session;
use Redirect;
use Carbon;
use DB;
use Auth;


class allVentas extends Controller
{
    public function __construct()
    {
        $this->middleware('auth' );
        #$this->middleware('ventas' , ['only' => ['create','edit','show'] ] );
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipo       = Auth::User()->type;
        $id_user    = Auth::User()->id;
        $user       = Auth::User()->user;
        #
        Session::forget( 'token_new_venta' );
        $fecha = $this->fecha_hoy();
        if( $tipo == 'Administrador' )
        {
            $venta = venta::paginate(10);
        }
        else
        {
            $venta = venta::where([['id_user_creado','=',$id_user]])->paginate(10);
        }
        return view('venta.homeVenta',compact('venta'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function fecha_hoy($tipo='fecha')
    {
        #
        $mytime = Carbon\Carbon::now('America/Lima');
        $mytime->toDateString();
        if( $tipo == 'fecha' )
        {
            $fecha_mysql = $mytime->format('Y-m-d');
        }
        else
        {
            $fecha_mysql = $mytime->format('Y-m-d H:m:s');
        }
        #
        return $fecha_mysql;
    }
    
}
