<?php

namespace farmacia\Http\Controllers;

use Illuminate\Http\Request;

use farmacia\Http\Requests;

use farmacia\Http\Requests\ClaseCreateRequest;
use farmacia\Http\Requests\ClaseUpdateRequest;
use farmacia\clase;
use Session;
use Redirect;
use DB;

use Auth;
use farmacia\logs;
use Carbon;

class claseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataClases = clase::paginate(5);
        return view('clase.homeClase',compact('dataClases'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clase.addClase');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClaseCreateRequest $request)
    {
        #User data
        $id_user    = Auth::User()->id;
        $user       = Auth::User()->user;
        #
        $clase = clase::create( $request->all() );
        #Personal Log
        $this->set_logs(['tipo'=>'PL','tipo_doc'=>'CLS','key'=>$id_user,'evento'=>'make.Clase','content'=>'Has creado una clase '.$clase->nombre ,'res'=>'Creado', 'link_to' => $clase->id_clase ]);
        #
        return redirect::to('/clase')->with('message','Clase creada correctamente');
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
        $clase = clase::find($id);
        return view('clase.editClase',["clase" => $clase ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClaseUpdateRequest $request, $id)
    {
        #User data
        $id_user    = Auth::User()->id;
        $user       = Auth::User()->user;
        #
        $clase = clase::find( $id );
        $clase->fill( $request->all() );
        $clase->save();
        #Personal Log
        $this->set_logs(['tipo'=>'PL','tipo_doc'=>'CLS','key'=>$id_user,'evento'=>'update.Clase','content'=>'Has editado una clase '.$clase->nombre ,'res'=>'Editado', 'link_to' => $clase->id_clase ]);
        #
        return redirect::to('/clase')->with('message','Clase editada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_clase)
    {
        #User data
        $id_user    = Auth::User()->id;
        $user       = Auth::User()->user;
        #
        $clase = clase::find( $id_clase );
        $data = clase::where(['id_clase' => $id_clase])->delete();
         #Personal Log
        $this->set_logs(['tipo'=>'PL','tipo_doc'=>'CLS','key'=>$id_user,'evento'=>'del.Clase','content'=>'Has eliminado una clase '.$clase->nombre ,'res'=>'Eliminado', 'link_to' => $clase->id_clase ]);
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
