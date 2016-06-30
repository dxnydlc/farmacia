<?php

namespace farmacia\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Auth;
use Session;
use Redirect;


use farmacia\Http\Requests;
use Illuminate\Routing\Route;

use farmacia\venta;

class homeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array();
        $data['logs']       = $this->get_personal_log();
        $data['header_vta'] = $this->get_headers_ventas_home();
        #
        #return $data['header_vta'];
        #
        try {
            if( Auth::User()->name != '' )
            {
                return view('index',compact('data'));
            }
        } catch (Exception $e) {
            return view('login.form');
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function destroy($id)
    {
        //
    }


    public function get_personal_log()
    {
        #User data
        $id_user    = Auth::User()->id;
        $user       = Auth::User()->user;
        #
        $response = array();
        $data = DB::table('logs')->where([['tipo','=','PL'],['id_user','=',$id_user]])->groupBy('contenido')->orderBy('id','DESC')->get();
        if(count($data)>0)
        {
            foreach ($data as $key => $rs) {
                $o = array();
                #Link
                switch ($rs->tipo_doc) {
                    case 'VE':
                        $link_to = '/invoice_venta/'.$rs->link_to;
                    break;
                    default:
                        $link_to = '';
                    break;
                }
                #
                switch ($rs->evento) {
                    case 'del.Clase': $evento = 'Eliminar Clase'; break;
                    case 'update.Clase': $evento = 'Actualizar Clase'; break;
                    case 'make.Clase': $evento = 'Crear Clase'; break;
                    case 'del.Marca': $evento = 'Eliminar Marca'; break;
                    case 'make.Clase': $evento = 'Crear Clase'; break;
                    case 'make.Categoria': $evento = 'Crear Categoria'; break;
                    case 'make.Marca': $evento = 'Crear Marca'; break;
                    case 'make.VE': $evento = 'Crear Doc. Ventas'; break;
                    case 'close.VE': $evento = 'Cerrar Doc. Ventas'; break;
                    default: $evento = ''; break;
                }
                $o['link_to']   = $link_to;
                $o['evento']    = $evento;
                $o['contenido'] = $rs->contenido;
                $o['fecha']     = $rs->fecha;
                $o['resultado'] = $rs->resultado;
                $o['tiempo']    = $this->time_elapsed_string( strtotime($rs->created_at) );
                $o['usuario']   = $rs->usuario;
                array_push( $response , $o );
            }
        }
        return $response;
    }


    public function time_elapsed_string($ptime)
    {
        $etime = time() - $ptime;

        if ($etime < 1)
        {
            return '0 seconds';
        }

        $a = array( 365 * 24 * 60 * 60  =>  'año',
                     30 * 24 * 60 * 60  =>  'mes',
                          24 * 60 * 60  =>  'día',
                               60 * 60  =>  'hora',
                                    60  =>  'minuto',
                                     1  =>  'segundo'
                    );
        $a_plural = array( 'año'    => 'años',
                           'mes'    => 'meses',
                           'día'    => 'dias',
                           'hora'   => 'horas',
                           'minuto' => 'minutos',
                           'segundo'=> 'segundos'
                    );

        foreach ($a as $secs => $str)
        {
            $d = $etime / $secs;
            if ($d >= 1)
            {
                $r = round($d);
                return $r . ' ' . ($r > 1 ? $a_plural[$str] : $str) . ' ';
            }
        }
    }

    public function get_headers_ventas_home()
    {
        $tipo     = Auth::User()->type;
        $id_user        = Auth::User()->id;
        $user           = Auth::User()->user;
        #
        $response = array();
        if( $tipo == 'Administrador' )
        {
            $response = DB::table('venta')->select( DB::raw("DATE_FORMAT(fecha,'%d/%m/%Y') as 'fecha', sum(total) as 'total', fecha as 'date' "))->groupBy('fecha')->orderBy('fecha','DESC')->get();
        }
        else
        {
            $response = DB::table('venta')->select( DB::raw("DATE_FORMAT(fecha,'%d/%m/%Y') as 'fecha', sum(total) as 'total', fecha as 'date' "))->where([['user_creado','=',$user],['estado','<>','DEL']])->groupBy('fecha')->orderBy('fecha','DESC')->get();
        }
        
        return $response;
    }

}
