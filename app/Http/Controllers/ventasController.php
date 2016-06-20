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
use \farmacia\config;

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
        $config             = $this->get_config();
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
        #Productos con lote
        $data['productos']  = DB::table('productos')->join('producto_lote', 'productos.id_producto', '=', 'producto_lote.id_producto')->get();
        $data['clientes']   = clientes::lists('nombre','id');
        #
        $data['fecha'] = $mytime->format('d/m/Y');
        $data['token'] = $token;
        $data['items'] = DB::table('detalle_venta')->where( "token" , $token )->whereNull('deleted_at')->get();

        $data['serie']          = $config->serie_boleta;
        $data['correlativo']    = $config->correlativo_boleta;
        $data['efectivo']       = '';
        $data['vuelto']         = '';
        $data['ruc']            = '';
        $data['razon_social']   = '';
        $data['forma_pago']     = '';
        $data['pago_efectivo']  = '';
        $data['vuelto']         = '';

        return view('venta.addVenta',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ventaCreateRequest $request)
    {
        DB::enableQueryLog();
        $response   = array();
        $data       = array();
        $config     = $this->get_config();
        #fecha
        $mytime = Carbon\Carbon::now('America/Lima');
        $mytime->toDateString();
        $dea_token = $request['tokenDoc'];
        list($dia,$mes,$anio) = explode('/', $request['fecha'] );
        #
        switch ($request['tipo_doc']) {
            case 'B':
                $serie          = $config->serie_boleta;
                $correlativo    = $config->correlativo_boleta;
            break;
            case 'F':
                $serie          = $config->serie_factura;
                $correlativo    = $config->correlativo_factura;
            break;
        }
        #
        $venta = venta::create([
            'tipo_doc'      => $request['tipo_doc'],
            'serie'         => $serie,
            'correlativo'   => $correlativo,
            'id_cliente'    => $request['id_cliente'],
            'cliente'       => $request['cliente'],
            'fecha'         => $request['fecha'],
            'total'         => $request['totalDoc'],
            'ruc'           => $request['ruc'],
            'razon_social'  => $request['razon_social'],
            'forma_pago'    => $request['forma_pago'],
            'pago_efectivo' => $request['pago_efectivo'],
            'vuelto'        => $request['vuelto'],
            'token'         => $dea_token,
            'id_user_creado'=> 1,
            'user_creado'   => 'DDELACRUZ',
            'estado'        => 'ACT'
        ]);
        $token = Session::get('token_new_venta');
        Session::forget( 'token_new_venta' );
        $id_venta = $venta->id;
        #
        $response['id_venta'] = $id_venta;
        #uniendo con el detalle de venta
        DB::table('detalle_venta')
            ->where('token', $dea_token)
            ->update(['id_venta' => $id_venta]);
        #
        #Productos con lote
        $data['productos']      = DB::table('productos')->join('producto_lote', 'productos.id_producto', '=', 'producto_lote.id_producto')->get();
        $data['venta']          = venta::find( $id_venta );
        #
        $data['clientes']       = clientes::lists('nombre','id');
        #
        $data['fecha']          = $data['venta']->fecha;
        $data['token']          = $token;
        $data['items']          = DB::table('detalle_venta')->where( "id_venta" , $id_venta )->get();

        $data['serie']          = $data['venta']->serie;
        $data['correlativo']    = $data['venta']->correlativo;
        $data['efectivo']       = $data['venta']->efectivo;
        $data['vuelto']         = $data['venta']->vuelto;
        $data['ruc']            = $data['venta']->ruc;
        $data['razon_social']   = $data['venta']->razon_social;
        #Logs
        $this->set_logs(['tipo'=>'Docs','tipo_doc'=>'VE','key'=>$token,'evento'=>'save.VE','content'=>'Guardar','res'=>'Guardado']);
        #
        #Session::flash('estado','Parte de entrada guardado');
        return redirect('ventas/'.$id_venta.'/edit')->with('estado', 'Documento de ventas guardado');

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
        #DB::enableQueryLog();
        $id_venta = $id;
        $response = array();
        $data = array();
        $mytime = Carbon\Carbon::now('America/Lima');
        $mytime->toDateString();
        #
        #Productos con lote
        $data['productos']      = DB::table('productos')->join('producto_lote', 'productos.id_producto', '=', 'producto_lote.id_producto')->get();
        $data['venta']          = venta::find( $id_venta );
        #
        $data['clientes']       = clientes::lists('nombre','id');
        #
        list($anio,$mes,$dia) = explode('-', $data['venta']->fecha );
        $fecha = $dia.'/'.$mes.'/'.$anio;
        #
        $data['fecha']          = $fecha;
        $data['token']          = $data['venta']->token;
        $data['items']          = DB::table('detalle_venta')->where( "id_venta" , $id_venta )->get();

        $data['serie']          = $data['venta']->serie;
        $data['correlativo']    = $data['venta']->correlativo;
        $data['pago_efectivo']  = $data['venta']->pago_efectivo;
        $data['vuelto']         = $data['venta']->vuelto;
        $data['ruc']            = $data['venta']->ruc;
        $data['razon_social']   = $data['venta']->razon_social;
        $data['forma_pago']     = $data['venta']->forma_pago;
        #
        #return $data;
        return view('venta.updateVenta', ['data' => $data] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ventaUpdateRequest $request, $id)
    {
        $config                 = $this->get_config();
        $request['serie']       = $config->serie_boleta;
        $request['correlativo'] = $config->correlativo_boleta;
        #
        $venta = venta::find( $id );
        $venta->fill( $request->all() );
        $venta->save();
        #Aumentando el correlativo en la serie
        #Movimiento de Kadex en almacen
        $productos      = DB::table('detalle_venta')->where( "id_venta" , $id )->whereNull('deleted_at')->get();
        $venta          = venta::find( $id );
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
        #logs
        $this->set_logs(['tipo'=>'Docs','tipo_doc'=>'PE','key'=>$request['tokenDoc'],'evento'=>'cerrar.PE','content'=>'Cerrar PE','res'=>'Cerrado']);
        return redirect::to('/invoice_venta/'.$id);
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


    public function invoice($id)
    {
        #DB::enableQueryLog();
        $data = array();
        $data['venta']      = venta::find( $id );
        $data['items']      = DB::table('detalle_venta')->where( "id_venta" , $id )->whereNull('deleted_at')->get();
        $data['logs']       = $this->get_logs( $data['venta']->token );
        #
        #return DB::getQueryLog();
        #
        #return $data['logs'];
        return view('venta.invoice', ['data' => $data] );
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

    public function set_correlativo()
    {
        //
    }

}
