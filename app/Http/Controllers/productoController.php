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
use Carbon;


use Auth;
use farmacia\logs;
use DB;


class productoController extends Controller
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


    public function index( Request $request )
    {
        #dd( $request->get('nombre') );
        $response = array();

        $dataProductos = productos::nombre( $request->get('nombre') )->orderBy('id_producto','DESC')->paginate(10);
    
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
        #User data
        $id_user    = Auth::User()->id;
        $user       = Auth::User()->user;
        #
        $producto = productos::create( $request->all() );
        #Personal Log
        $this->set_logs(['tipo'=>'PL','tipo_doc'=>'PRD','key'=>$id_user,'evento'=>'make.Producto','content'=>'Has agregado un producto '.$producto->nombre ,'res'=>'Creado', 'link_to' => $producto->id_producto ]);
        #
        return redirect::to('/producto')->with('message','Producto creado correctamente');
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
        #User data
        $id_user    = Auth::User()->id;
        $user       = Auth::User()->user;
        #
        $producto = productos::find( $id );
        $producto->fill( $request->all() );
        $producto->save();
        #Personal Log
        $this->set_logs(['tipo'=>'PL','tipo_doc'=>'PRD','key'=>$id_user,'evento'=>'update.Producto','content'=>'Has editado un producto '.$producto->nombre ,'res'=>'Editado', 'link_to' => $producto->id_producto ]);
        #
        return redirect::to('/producto')->with('message','Producto editado correctamente');
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
        $data = productos::where(['id_producto' => $id])->delete();
        #Personal Log
        $this->set_logs(['tipo'=>'PL','tipo_doc'=>'PRD','key'=>$id_user,'evento'=>'del.Producto','content'=>'Has eliminado un producto '.$data->nombre ,'res'=>'Eliminado', 'link_to' => $data->id_producto ]);
        #
        return $data;
    }

    public function buscar($q)
    {
        return $q;
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
