<?php

namespace farmacia\Http\Controllers;

use Illuminate\Http\Request;

use farmacia\Http\Requests;
use farmacia\Http\Requests\CategoriaCreateRequest;
use farmacia\categoria;

use Session;
use Redirect;

class categoriaController extends Controller
{
    public function __construct()
    {
        #$this->middleware('auth' );
        $this->middleware('categoria' , ['only' => ['create','edit'] ] );
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        categoria::create( $request->all() );
        Session::flash('message','Categoria creada correctamente');
        return redirect::to('/categoria');
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
    public function destroy($id_categoria)
    {
        categoria::find(['id_categoria' => $id_categoria]);
        #$this->categoria->delete();
        Session::flash('message','Categoria eliminada correctamente');
        return redirect::to('/categoria');
    }
}
