<?php

namespace farmacia\Http\Controllers;

use Illuminate\Http\Request;

use farmacia\Http\Requests;

use farmacia\Http\Requests\proveedorCreateRequest;
use farmacia\Http\Requests\proveedorUpdateRequest;
use farmacia\proveedores;
use Session;
use Redirect;


use Auth;
use farmacia\logs;
use Carbon;
use DB;


class proveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */


    public function __construct()
    {
        $this->middleware('auth' );
        $this->middleware('isAdmin' , ['only' => ['create','edit','show'] ] );
    }

    
    public function index()
    {
        $dataProveedor = proveedores::paginate(5);
        return view('proveedores.homeProveedores',compact('dataProveedor'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('proveedores.addProveedores');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(proveedorCreateRequest $request)
    {
        #User data
        $id_user    = Auth::User()->id;
        $user       = Auth::User()->user;
        #
        $proveedor = proveedores::create( $request->all() );
        #Personal Log
        $this->set_logs(['tipo'=>'PL','tipo_doc'=>'PRV','key'=>$id_user,'evento'=>'make.Proveedor','content'=>'Has agregado un proveedor '.$proveedor->nombre ,'res'=>'Creado', 'link_to' => $proveedor->id_proveedor ]);
        #
        return redirect::to('/proveedor')->with('message','Proveedor creado correctamente');
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
        $proveedor = proveedores::find($id);
        return view('proveedores.editProveedores',["proveedor" => $proveedor ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(proveedorUpdateRequest $request, $id)
    {
        #User data
        $id_user    = Auth::User()->id;
        $user       = Auth::User()->user;
        #
        $proveedores = proveedores::find( $id );
        $proveedores->fill( $request->all() );
        $proveedores->save();
        #Personal Log
        $this->set_logs(['tipo'=>'PL','tipo_doc'=>'PRV','key'=>$id_user,'evento'=>'update.Proveedor','content'=>'Has editado un proveedor '.$proveedores->nombre ,'res'=>'Editado', 'link_to' => $proveedores->id_proveedor ]);
        #
        return redirect::to('/proveedor')->with('message','Proveedor editado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        #User data
        $id_user    = Auth::User()->id;
        $user       = Auth::User()->user;
        #
        $data = proveedores::where(['id_proveedor' => $id])->delete();
        #Personal Log
        $this->set_logs(['tipo'=>'PL','tipo_doc'=>'PRV','key'=>$id_user,'evento'=>'del.Proveedor','content'=>'Has eliminado un proveedor '.$data->nombre ,'res'=>'Eliminado', 'link_to' => $data->id_proveedor ]);
        #
        return $data;
    }

    public function set_logs($param)
    {
        $id_user    = Auth::User()->id;
        $user       = Auth::User()->user;
        #
        $mytime = Carbon\Carbon::now('America/Lima');
        $mytime->toDateString();
        $fecha_mysql = $mytime->format('d/m/Y H:m:s');
        $link_to = '';
        #
        if( $param['tipo'] == 'PL' )
        {
            $link_to = $param['link_to'];
        }
        #
        $data_insert = [
            'tipo'          => $param['tipo'],
            'tipo_doc'      => $param['tipo_doc'],
            'key'           => $param['key'],
            'evento'        => $param['evento'],
            'contenido'     => $param['content'],
            'resultado'     => $param['res'],
            'fecha'         => $fecha_mysql,
            'id_user'       => $id_user,
            'usuario'       => $user,
            'link_to'       => $link_to
        ];
        logs::create($data_insert);
    }

}
