<?php

namespace farmacia\Http\Controllers;

use Illuminate\Http\Request;

use farmacia\Http\Requests;

use farmacia\Http\Requests\MarcaCreateRequest;
use farmacia\Http\Requests\MarcaUpdateRequest;
use farmacia\marca;
use Session;
use Redirect;

class marcaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        marca::create( $request->all() );
        Session::flash('message','Marca creada correctamente');
        return redirect::to('/marca');
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
        $marca = marca::find( $id );
        $marca->fill( $request->all() );
        $marca->save();

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
        $data = marca::where(['id_marca' => $id_marca])->delete();
        #$this->categoria->delete();
        return $data;
    }
}
