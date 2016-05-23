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
        $parteEntrada = ParteEntrada::paginate(5);
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
    public function store(Request $request)
    {
        //
        #Borramos la session para que se genere un nuevo Token
        Session::forget( 'token_new_pe' );
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
}
