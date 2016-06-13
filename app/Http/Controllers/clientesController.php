<?php

namespace farmacia\Http\Controllers;

use Illuminate\Http\Request;

use farmacia\Http\Requests;
use farmacia\Http\Requests\clienteCreateRequest;
use farmacia\Http\Requests\clienteUpdateRequest;
use farmacia\clientes;

use Session;
use Redirect;

class clientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        clientes::create( $request->all() );
        #Session::flash('message','Proveedor creado correctamente');
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
        $clientes = clientes::find( $id );
        $clientes->fill( $request->all() );
        $clientes->save();

        #session::flash('message','Proveedor editado correctamente');
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
        $data = clientes::where(['id' => $id])->delete();
        return $data;
    }
}
