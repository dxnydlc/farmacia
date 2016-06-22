<?php

namespace farmacia\Http\Controllers;

use Illuminate\Http\Request;

use farmacia\Http\Requests;


use farmacia\venta;
use farmacia\logs;
use farmacia\clientes;
use farmacia\kardex;
use farmacia\productos;
use \farmacia\config;

use Session;
use Redirect;
use Carbon;
use DB;



class delVenta extends Controller
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
        #Anular el doc de ventas
        $mytime         = Carbon\Carbon::now('America/Lima');
        $mytime->toDateString();
        $fecha_mysql    = $mytime->format('d/m/Y H:m:s');
        $id             = $request['id'];
        #
        #Movimiento de Kadex en almacen
        $productos      = DB::table('detalle_venta')->where( "id_venta" , $id )->whereNull('deleted_at')->get();
        $venta          = venta::find( $id );
        $data           = venta::where(['id' => $id])->delete();
        #
        if( count($productos) > 0 )
        {
            foreach ($productos as $key => $rs) {
                $data_last = array();
                $data_last  = $this->get_lastkardex( $rs->id_producto );
                if( $data_last != 'no' ){
                    $saldo_cant       = $data_last['cant'] + $rs->cantidad;
                    $saldo_precio     = $data_last['precio'];
                    $saldo_valor_f    = $data_last['valor'];
                }else{
                    $saldo_cant       = $rs->cantidad;
                    $saldo_precio     = $rs->precio;
                    $saldo_valor_f    = $rs->cantidad * $rs->precio;
                }
                #return $data_last;
                $cant       = $rs->cantidad;
                $precio     = $rs->precio;
                $valor_f    = $rs->cantidad * $rs->precio;
                #Valores Kardex anterior
                $data_insert = [
                    'movimiento'    => 'S',
                    'fecha'         => $fecha_mysql,
                    'id_producto'   => $rs->id_producto,
                    'producto'      => $rs->producto,
                    'id_persona'    => $venta->id_cliente,
                    'persona'       => $venta->cliente,
                    'documento'     => 'VE',
                    'numero_doc'    => $venta->serie.'-'.$venta->correlativo,
                    'cantidad_e'    => $cant,
                    'precio_e'      => $precio,
                    'valor_e'       => $valor_f,
                    'cantidad_s'    => 0,
                    'precio_s'      => 0,
                    'valor_s'       => 0,
                    'cantidad_f'    => $saldo_cant,
                    'precio_f'      => $saldo_precio,
                    'valor_f'       => $saldo_valor_f,
                    'id_user'       => '1',
                    'usuario'       => 'DDELACRUZ'
                ];
                $Kardex = kardex::create($data_insert);
            }
            unset($rs);
        }
        #/Movimiento de Kadex en almacen
        #uniendo con el detalle de venta
        DB::table('venta')
            ->where('id', $request['id'])
            ->update(['estado'=>'DEL', 'motivo_anular' => $request['motivo_anular'], 'id_user_anula' => 1, 'user_anula' => 'DDELACRUZ']);
        #
        #return $venta;
        return redirect('ventas/');
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


    public function get_lastkardex($id_prod)
    {
        $response = array();
        $data = DB::table('kardex')->where('id_producto','=',$id_prod)->orderBy('id', 'desc')->first();
        if( count($data) > 0 ){
            #foreach ($data as $key => $rs) {
                $response['cant']   = $data->cantidad_f;
                $response['precio'] = $data->precio_f;
                $response['valor']  = $data->valor_f;
            #}
            #unset($rs);
            return $response;
        }else{
            return 'no';
        }
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

    public function get_config()
    {
        $data      = DB::table('config')->first();
        return $data;
    }

}
