<?php

namespace farmacia\Http\Controllers;

use Illuminate\Http\Request;

use farmacia\Http\Requests;

use farmacia\Http\Requests\ClaseCreateRequest;
use farmacia\Http\Requests\ClaseUpdateRequest;
use farmacia\clase;
use Session;
use Redirect;

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
        clase::create( $request->all() );
        Session::flash('message','Clase creada correctamente');
        return redirect::to('/clase');
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
        $clase = clase::find( $id );
        $clase->fill( $request->all() );
        $clase->save();

        session::flash('message','Clase editada correctamente');
        return redirect::to('/clase');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_clase)
    {
        $data = clase::where(['id_clase' => $id_clase])->delete();
        return $data;
    }
}
