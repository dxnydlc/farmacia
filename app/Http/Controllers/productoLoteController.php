<?php

namespace farmacia\Http\Controllers;

use Illuminate\Http\Request;

use farmacia\Http\Requests;

use farmacia\productos;
use farmacia\logs;
use farmacia\producto_lote;

use Session;
use Redirect;
use Carbon;
use DB;


class productoLoteController extends Controller
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
        #Primero creamos el producto y luego el Lote
        $token = $request['tokenPL'];
        $data_prod = [
            'nombre'        => $request['producto'],
            'descripcion'   => '',
            'id_categoria'  => 1,
            'categoria'     => 'Ninguno',
            'id_marca'      => 1,
            'marca'         => 'Ninguno',
            'id_clase'      => 1,
            'clase'         => 'Ninguno',
            'laboratorio'   => '',
            'id_proveedor'  => 1,
            'proveedor'     => 'Ninguno'
        ];
        $prod = productos::create( $data_prod );
        #Ahora creamos el lote
        $data_lote = [
            'id_producto'   => $prod->id_producto,
            'producto'      => $request['lt_producto'],
            'lote'          => $request['lt_lote'],
            'laboratorio'   => $request['lt_laboratorio'],
            'vencimiento'   => $request['lt_vencimiento'],
            'precio'        => $request['lt_precio'],
            'precio_old'    => 0,
            'id_proveedor'  => 1,
            'proveedor'     => 'Ninguno'
        ];
        #Log de prodcuto
        $this->set_logs(['tipo'=>'Docs','tipo_doc'=>'V','key'=>$token,'evento'=>'add.ProdLote','content'=>'Nuevo Producto: '.$request['lt_producto'],'res'=>'Agregado']);
        $this->make_lote( $data_lote );
        return $request->all();
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

    public function make_lote( $data )
    {
        producto_lote::create($data);
    }

}
