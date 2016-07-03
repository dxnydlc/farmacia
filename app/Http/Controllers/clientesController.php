<?php

namespace farmacia\Http\Controllers;

use Illuminate\Http\Request;

use farmacia\Http\Requests;
use farmacia\Http\Requests\clienteCreateRequest;
use farmacia\Http\Requests\clienteUpdateRequest;
use farmacia\clientes;

use Session;
use Redirect;


use Auth;
use farmacia\logs;
use Carbon;
use DB;


class clientesController extends Controller
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
        $dataClientes = clientes::paginate(5);
        return view('clientes.homeClientes',compact('dataClientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clientes.addClientes');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(clienteCreateRequest $request)
    {
        #User data
        $id_user    = Auth::User()->id;
        $user       = Auth::User()->user;
        #
        $clientes = clientes::create( $request->all() );
        #Personal Log
        $this->set_logs(['tipo'=>'PL','tipo_doc'=>'CL','key'=>$id_user,'evento'=>'make.Cliente','content'=>'Has agregado un cliente '.$clientes->nombre ,'res'=>'Creado', 'link_to' => $clientes->id ]);
        #
        return redirect::to('/cliente')->with('estado','Cliente: '.$request['nombre'].' creado correctamente');
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
        $cliente = clientes::find($id);
        return view('clientes.editClientes',["cliente" => $cliente ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(clienteUpdateRequest $request, $id)
    {
        #User data
        $id_user    = Auth::User()->id;
        $user       = Auth::User()->user;
        #
        $clientes = clientes::find( $id );
        $clientes->fill( $request->all() );
        $clientes->save();
        #Personal Log
        $this->set_logs(['tipo'=>'PL','tipo_doc'=>'CL','key'=>$id_user,'evento'=>'update.Cliente','content'=>'Has editado un cliente '.$clientes->nombre ,'res'=>'Editado', 'link_to' => $clientes->id ]);
        #
        return redirect::to('/cliente')->with('estado','Cliente '.$request['nombre'].' editado correctamente');
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
        $data = clientes::where(['id' => $id])->delete();
        #Personal Log
        $this->set_logs(['tipo'=>'PL','tipo_doc'=>'CL','key'=>$id_user,'evento'=>'del.Cliente','content'=>'Has eliminado un cliente '.$data->nombre ,'res'=>'Eliminado', 'link_to' => $data->id ]);
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
