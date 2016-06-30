<?php

namespace farmacia\Http\Controllers;

use Illuminate\Http\Request;

use farmacia\Http\Requests;


use farmacia\venta;
use farmacia\logs;
use farmacia\clientes;
use farmacia\kardex;
use farmacia\productos;
use farmacia\config;
use farmacia\Routing\Route;


use Session;
use Redirect;
use Carbon;
use DB;
use Auth;
use Excel;

class exportDocs extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function __construct()
    {
        $this->middleware('auth' );
        #$this->middleware('ventas' , ['only' => ['create','edit','show'] ] );
    }

    public function all_ventas()
    {
        $tipo       = Auth::User()->type;
        $id_user    = Auth::User()->id;
        $user       = Auth::User()->user;
        #
        $data = venta::select(DB::raw('tipo_doc, serie, correlativo, cliente, direccion, fecha, ruc, razon_social, total, forma_pago, pago_efectivo, vuelto, user_creado,estado'))->get()->toArray();
        return Excel::create('itsolutionstuff_example', function($excel) use ($data) {
            $excel->sheet('mySheet', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });
        })->download("xls");
        return redirect('/ventas')->with('estado', 'Documento exportado a Excel');
    }

    public function fecha_hoy($tipo='fecha')
    {
        #
        $mytime = Carbon\Carbon::now('America/Lima');
        $mytime->toDateString();
        if( $tipo == 'fecha' )
        {
            $fecha_mysql = $mytime->format('Y-m-d');
        }
        else
        {
            $fecha_mysql = $mytime->format('Y-m-d H:m:s');
        }
        #
        return $fecha_mysql;
    }

}
