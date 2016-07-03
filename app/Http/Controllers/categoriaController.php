<?php

namespace farmacia\Http\Controllers;

use Illuminate\Http\Request;

use farmacia\Http\Requests;

use farmacia\Http\Requests\CategoriaCreateRequest;
use farmacia\Http\Requests\CategoriaUpdateRequest;
use farmacia\categoria;
use Session;
use Redirect;

use Auth;
use farmacia\logs;
use Carbon;

class categoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth' );
        $this->middleware('categ' , ['only' => ['create','edit','show'] ] );
    }


    public function index()
    {
        $dataCategorias = categoria::paginate(5);
        return view('categoria.homeCategoria',compact('dataCategorias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categoria.addCategoria');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoriaCreateRequest $request)
    {
        #User data
        $id_user    = Auth::User()->id;
        $user       = Auth::User()->user;
        #
        $categ = categoria::create( $request->all() );
        #Personal Log
        $this->set_logs(['tipo'=>'PL','tipo_doc'=>'CA','key'=>$id_user,'evento'=>'make.Categoria','content'=>'Has creado una categoria '.$categ->nombre ,'res'=>'Creado', 'link_to' => $categ->id_categoria ]);
        #
        #Session::flash('message','Categoria creada correctamente');
        return redirect::to('/categoria')->with('message','Categoria creada correctamente');
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
        $categoria = categoria::find($id);
        return view('categoria.editCategoria',["categoria" => $categoria ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoriaUpdateRequest $request, $id)
    {
        #User data
        $id_user    = Auth::User()->id;
        $user       = Auth::User()->user;
        #
        $categoria = categoria::find( $id );
        $categoria->fill( $request->all() );
        $categoria->save();
        #Personal Log
        $this->set_logs(['tipo'=>'PL','tipo_doc'=>'CA','key'=>$id_user,'evento'=>'update.Categoria','content'=>'Has editado una categoria '.$categoria->nombre ,'res'=>'Editado', 'link_to' => $categoria->id_categoria ]);
        #
        return redirect::to('/categoria')->with('message','Categoria editada correctamente');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_categoria)
    {
        #User data
        $id_user    = Auth::User()->id;
        $user       = Auth::User()->user;
        #
        $data = categoria::where(['id_categoria' => $id_categoria])->delete();
        #Personal Log
        $this->set_logs(['tipo'=>'PL','tipo_doc'=>'CA','key'=>$id_user,'evento'=>'del.Categoria','content'=>'Has eliminado una categoria '.$data->nombre ,'res'=>'Eliminado', 'link_to' => $data->id_categoria ]);
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
