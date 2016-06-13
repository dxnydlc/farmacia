<?php

namespace farmacia\Http\Controllers;
use Illuminate\Http\Request;

use farmacia\Http\Requests;


use farmacia\Http\Requests\ventaCreateRequest;
use farmacia\Http\Requests\ventaUpdateRequest;
use farmacia\venta;
use farmacia\logs;
use farmacia\clientes;
use farmacia\kardex;
use farmacia\productos;

use Session;
use Redirect;
use Carbon;
use DB;

class ventasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Session::forget( 'token_new_venta' );
        $parteEntrada = venta::paginate(10);
        return view('venta.homeVenta',compact('parteEntrada'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mytime = Carbon\Carbon::now('America/Lima');
        $mytime->toDateString();
        #
        $data               = array();
        $token              = '';
        #Colocando variable de session con el token
        if(! Session::has('token_new_venta') )
        {
            #$token              = csrf_token();
            $token              = \Hash::make( $mytime->toDateTimeString() );
            #$token              = $mytime->toDateTimeString();
            Session::put( 'token_new_venta' , $token );
        }else{
            $token = Session::get('token_new_venta');
        }
        #
        $data['productos']  = $dataProductos = productos::all();
        $data['clientes']   = clientes::lists('nombre','id');
        #
        $data['fecha'] = $mytime->format('d/m/Y');
        $data['token'] = $token;
        $data['items'] = DB::table('detalle_venta')->where( "token" , $token )->get();

        $data['serie']          = 1;
        $data['correlativo']    = 100;
        $data['efectivo']       = '';
        $data['vuelto']         = '';

        return view('venta.addVenta',compact('data'));
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



    public function set_logs($param)
    {
        $mytime = Carbon\Carbon::now('America/Lima');
        $mytime->toDateString();
        $fecha_mysql = $mytime->format('d/m/Y H:m:s');
        #
        $data_insert = [
            'tipo'          => $param['tipo'],
            'tipo_doc'      => $param['tipo_doc'],
            'key'           => $param['key'],
            'evento'        => $param['evento'],
            'contenido'     => $param['content'],
            'resultado'     => $param['res'],
            'fecha'         => $fecha_mysql,
            'id_user'       => 1,
            'usuario'       => 'DDELACRUZ'
        ];
        logs::create($data_insert);
    }

    public function get_logs( $key )
    {
        $data      = DB::table('logs')->where( "key" , $key )->get();
        return $data;
    }


}
