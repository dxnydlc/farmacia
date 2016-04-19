<?php

namespace farmacia\Http\Controllers;

use Illuminate\Http\Request;

use farmacia\Http\Requests;

use farmacia\Http\Requests\ProductoCreateRequest;
use farmacia\Http\Requests\ProductoUpdateRequest;
use farmacia\productos;
use farmacia\categoria;
use farmacia\marca;
use farmacia\clase;
use farmacia\proveedores;

use Session;
use Redirect;

class productoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = array();
        $dataProductos = productos::paginate(8);
    
        return view('producto.homeProducto',compact('dataProductos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = array();
        $data['categoria'] = categoria::lists('nombre','id_categoria');
        $data['marca']      = marca::lists('nombre','id_marca');
        $data['clase']      = clase::lists('nombre','id_clase');
        $data['proveedor']  = proveedores::lists('nombre','id_proveedor');
        #
        return view('producto.addProducto',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductoCreateRequest $request)
    {
        productos::create( $request->all() );
        Session::flash('message','Producto creado correctamente');
        return redirect::to('/producto');
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
        $producto = productos::find($id);
        $data = array();
        $data['categoria'] = categoria::lists('nombre','id_categoria');
        $data['marca']      = marca::lists('nombre','id_marca');
        $data['clase']      = clase::lists('nombre','id_clase');
        $data['proveedor']  = proveedores::lists('nombre','id_proveedor');
        $data['producto']   = $producto;

        return view('producto.editProducto',["data" => $data ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductoUpdateRequest $request, $id)
    {
        $producto = productos::find( $id );
        $producto->fill( $request->all() );
        $producto->save();

        session::flash('message','Producto editado correctamente');
        return redirect::to('/producto');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = productos::where(['id_producto' => $id])->delete();
        return $data;
    }

    public function buscar($q)
    {
        return $q;
    }

}
