<?php

namespace farmacia;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ParteEntrada extends Model
{
    use SoftDeletes;
    protected $table = 'parte_entrada';
    protected $primaryKey = 'id';

    protected $fillable = ['id_proveedor','proveedor','fecha','token','id_user','user','estado'];
    protected $dates = ['deleted_at'];

    public function getfechaAttribute($valor)
    {
    	if( $valor != '' )
    	{
    		list($anio,$mes,$dia) = explode('-', $valor );
    		$fecha = $dia.'/'.$mes.'/'.$anio;
    		return $fecha;
    	}
    }

    public function setfechaAttribute($valor)
    {
        if( $valor != '' )
        {
            list($dia,$mes,$anio) = explode('/', $valor );
            $fecha = $anio.'-'.$mes.'-'.$dia;
            return $fecha;
        }
    }

}
