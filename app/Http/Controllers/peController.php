<?php

namespace farmacia\Http\Controllers;

use Illuminate\Http\Request;

use farmacia\Http\Requests;


use farmacia\Http\Requests\peCreateRequest;
use farmacia\Http\Requests\peUpdateRequest;
use farmacia\ParteEntrada;
use Session;
use Redirect;

use farmacia\proveedores;
use Carbon;
use DB;

use farmacia\kardex;

use farmacia\productos;

class peController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parteEntrada = ParteEntrada::paginate(10);
        return view('pe.homePE',compact('parteEntrada'));
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
        if(! Session::has('token_new_pe') )
        {
            #$token              = csrf_token();
            $token              = \Hash::make( $mytime->toDateTimeString() );
            Session::put( 'token_new_pe' , $token );
        }else{
            $token = Session::get('token_new_pe');
        }
        #
        $data['productos']  = $dataProductos = productos::all();
        $data['proveedor']  = proveedores::lists('nombre','id_proveedor');
        #
        $data['fecha'] = $mytime->format('d/m/Y');
        $data['token'] = $token;
        #csrf_token()
        $data['items'] = DB::table('parte_entrada_detalle')->where( "token" , $token )->get();

        return view('pe.addPE',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(peCreateRequest $request)
    {
        DB::enableQueryLog();
        $response = array();
        $data = array();
        $mytime = Carbon\Carbon::now('America/Lima');
        $mytime->toDateString();
        $dea_token = $request['tokenDoc'];
        list($dia,$mes,$anio) = explode('/', $request['fecha'] );
        #
        $pe = ParteEntrada::create([
            'id_proveedor'  => $request['id_proveedor'],
            'proveedor'     => $request['proveedor'],
            'fecha'         => $request['fecha'],#$anio.'-'.$mes.'-'.$dia,
            'token'         => $dea_token,
            'id_user'       => 1,
            'user'          => 'DDELACRUZ',
            'estado'        => 'ACT'
        ]);
        #Borramos la session para que se genere un nuevo Token
        Session::forget( 'token_new_pe' );
        #
        $id_pe = $pe->id;
        #uniendo con el detalle de parte de entrada
        DB::table('parte_entrada_detalle')
            ->where('token', $dea_token)
            ->update(['id_pe' => $id_pe]);
        $response['id_pe'] = $id_pe;
        #
        $data['proveedor']  = proveedores::lists('nombre','id_proveedor');
        #$data['pe']         = DB::table('parte_entrada')->where('id_pe','=',$id)->first();
        $data['pe']         = ParteEntrada::find( $id_pe );
        $data['productos']  = $dataProductos = productos::all();
        $data['items']      = DB::table('parte_entrada_detalle')->where( "id_pe" , $id_pe )->get();
        $data['token']      = $data['pe']->token;
        $data['fecha']      = $data['pe']->fecha;
        #
        return view('pe.updatePE', ['data' => $data] );
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
        $data = array();
        $mytime = Carbon\Carbon::now('America/Lima');
        $mytime->toDateString();
        $token              = '';
        #Colocando variable de session con el token
        if(! Session::has('token_new_pe') )
        {
            #$token              = csrf_token();
            $token              = \Hash::make( $mytime->toDateTimeString() );
            Session::put( 'token_new_pe' , $token );
        }else{
            $token = Session::get('token_new_pe');
        }
        #
        $data['proveedor']  = proveedores::lists('nombre','id_proveedor');
        #$data['pe']         = DB::table('parte_entrada')->where('id_pe','=',$id)->first();
        $data['pe']         = ParteEntrada::find( $id );
        $data['productos']  = $dataProductos = productos::all();
        $data['items']      = DB::table('parte_entrada_detalle')->where( "id_pe" , $id )->get();
        $data['token']      = $data['pe']->token;
        $data['fecha']      = $data['pe']->fecha;
        #
        #return $data['pe'];
        return view('pe.updatePE', ['data' => $data] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(peCreateRequest $request, $id)
    {
        #DB::enableQueryLog();
        $mytime = Carbon\Carbon::now('America/Lima');
        $mytime->toDateString();
        $fecha_mysql = $mytime->format('d/m/Y');
        #
        $pe = ParteEntrada::find( $id );
        $pe->fill( $request->all() );
        $pe->save();
        #
        #return DB::getQueryLog();
        #Movimiento de Kadex en almacen
        $productos      = DB::table('parte_entrada_detalle')->where( "id_pe" , $id )->get();
        $parte_entrada  = ParteEntrada::find( $id );
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
                    $saldo_precio     = $rs->compra;
                    $saldo_valor_f    = $rs->cantidad * $rs->compra;
                }
                #return $data_last;
                $cant       = $rs->cantidad;
                $precio     = $rs->compra;
                $valor_f    = $rs->cantidad * $rs->compra;
                #Valores Kardex anterior
                $data_insert = [
                    'movimiento'    => 'E',
                    'fecha'         => $fecha_mysql,
                    'id_producto'   => $rs->id_producto,
                    'producto'      => $rs->producto,
                    'id_persona'    => $parte_entrada->id_proveedor,
                    'persona'       => $parte_entrada->proveedor,
                    'documento'     => 'PE',
                    'numero_doc'    => $parte_entrada->id,
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
                
        #
        #Session::flash('message','Parte de entada cerrado correctamente');
        return redirect::to('/invoice_pe/'.$id);
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
        $data['pe']         = ParteEntrada::find( $id );
        $data['items']      = DB::table('parte_entrada_detalle')->where( "id_pe" , $id )->get();
        #
        #return DB::getQueryLog();
        #
        #return $data;
        return view('pe.invoice', ['data' => $data] );
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
}
