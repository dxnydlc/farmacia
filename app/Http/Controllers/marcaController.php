<?php

namespace farmacia\Http\Controllers;

use Illuminate\Http\Request;

use farmacia\Http\Requests;

use farmacia\Http\Requests\MarcaCreateRequest;
use farmacia\Http\Requests\MarcaUpdateRequest;
use farmacia\marca;


use Session;
use Redirect;
use DB;


use Auth;
use farmacia\logs;
use Carbon;

class marcaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth' );
        $this->middleware('marcas' , ['only' => ['create','edit','show'] ] );
    }

    public function index()
    {
        $dataMarcas = marca::paginate(5);
        return view('marca.homeMarca',compact('dataMarcas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('marca.addMarca');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MarcaCreateRequest $request)
    {
        #User data
        $id_user    = Auth::User()->id;
        $user       = Auth::User()->user;
        #
        $marca = marca::create( $request->all() );
        #Personal Log
        $this->set_logs(['tipo'=>'PL','tipo_doc'=>'MA','key'=>$id_user,'evento'=>'make.Marca','content'=>'Has creado una marca '.$marca->nombre ,'res'=>'Creado', 'link_to' => $marca->id_marca ]);
        #
        #Session::flash('message','Marca creada correctamente');
        return redirect::to('/marca')->with('message','Marca creada correctamente');
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
        $marca = marca::find($id);
        return view('marca.editMarca',["marca" => $marca ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MarcaUpdateRequest $request, $id)
    {
        #User data
        $id_user    = Auth::User()->id;
        $user       = Auth::User()->user;
        #
        $marca = marca::find( $id );
        $marca->fill( $request->all() );
        $marca->save();
        #Personal Log
        $this->set_logs(['tipo'=>'PL','tipo_doc'=>'MA','key'=>$id_user,'evento'=>'update.Marca','content'=>'Has editado una marca '.$marca->nombre ,'res'=>'Actualizado', 'link_to' => $marca->id_marca ]);
        #
        session::flash('message','Marca editada correctamente');
        return redirect::to('/marca');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_marca)
    {
        #User data
        $id_user    = Auth::User()->id;
        $user       = Auth::User()->user;
        #
        $marca = marca::find( $id_marca );
        $data = marca::where(['id_marca' => $id_marca])->delete();
        #Personal Log
        $this->set_logs(['tipo'=>'PL','tipo_doc'=>'MA','key'=>$id_user,'evento'=>'del.Marca','content'=>'Has eliminado una marca '.$marca->nombre ,'res'=>'Eliminado', 'link_to' => $marca->id_marca ]);
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
