<?php

namespace farmacia\Http\Controllers;

use Illuminate\Http\Request;

use farmacia\Http\Requests;

use farmacia\Http\Requests\proveedorCreateRequest;
use farmacia\Http\Requests\proveedorUpdateRequest;
use farmacia\proveedores;
use Session;
use Redirect;

class proveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        proveedores::create( $request->all() );
        Session::flash('message','Proveedor creado correctamente');
        return redirect::to('/proveedor');
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
        $proveedores = proveedores::find( $id );
        $proveedores->fill( $request->all() );
        $proveedores->save();

        session::flash('message','Proveedor editado correctamente');
        return redirect::to('/proveedor');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = proveedores::where(['id_proveedor' => $id])->delete();
        #$this->categoria->delete();
        return $data;
    }
}
