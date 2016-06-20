<?php

namespace farmacia\Http\Controllers;

use Illuminate\Http\Request;

use farmacia\Http\Requests;
use farmacia\detalle_venta;
use farmacia\logs;

use DB;
use Carbon;
use Session;
use Redirect;

class detalle_ventaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        #DB::enableQueryLog();
        $response       = array();
        $id_return      = 0;
        $token          = $request->token;
        $data_insert = [
            'id_venta'      => $request['id_venta'],
            'producto'      => $request['producto'],
            'id_producto'   => $request['id_producto'],
            'lote'          => $request['lote'],
            'laboratorio'   => $request['laboratorio'],
            'vencimiento'   => $request['vencimiento'],
            'cantidad'      => $request['cantidad'],
            'precio'        => $request['precio'],
            'total'         => $request['total'],
            'descuento'     => $request['descuento'],
            'id_user'       => 1,
            'usuario'       => 'DDELACRUZ',
            'token'         => $request['token']
        ];
        $id_return = detalle_venta::create( $data_insert );
        $response['id']     = $id_return->id;
        $response['token']  = $token;
        #$response['query'] = DB::getQueryLog();
        $response['items'] = DB::table('detalle_venta')->where( "token" , $token )->get();

        #logs
        $this->set_logs(['tipo'=>'Docs','tipo_doc'=>'VE','key'=>$token,'evento'=>'add.Prod','content'=>$request['producto'],'res'=>'Agregado']);
        return $response;
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
        $token = Session::get('token_new_pe');
        $detalle = detalle_venta::find($id);
        $this->set_logs(['tipo'=>'Docs','tipo_doc'=>'VE','key'=>$token,'evento'=>'del.Prod','content'=>$detalle->producto,'res'=>'Eliminado']);
        #detalle_venta::delete();
        detalle_venta::where('id','=',$id)->delete(); 
        return $detalle;
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

}
