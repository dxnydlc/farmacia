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

    public function getFechaAttribute($valor)
    {
    	if( $valor != '' )
    	{
    		list($anio,$mes,$dia) = explode('-', $valor );
    		$fecha = $dia.'/'.$mes.'/'.$anio;
    		return $fecha;
    	}
    }

    public function getCreatedatAttribute($valor)
    {
        if( $valor != '' )
        {
            $ar = explode(' ', $valor );
            list($anio,$mes,$dia) = explode('-', $ar[0] );
            $fecha = $dia.'/'.$mes.'/'.$anio;
            return $fecha.' '.$ar[1];
        }
    }

    public function getUpdatedatAttribute($valor)
    {
        if( $valor != '' )
        {
            $ar = explode(' ', $valor );
            list($anio,$mes,$dia) = explode('-', $ar[0] );
            $fecha = $dia.'/'.$mes.'/'.$anio;
            return $fecha.' '.$ar[1];
        }
    }

    public function getEstadoAttribute($valor)
    {
        switch ($valor) {
            case 'ACT':
                return 'Activo';
                break;
            case 'CER':
                return 'Cerrado';
                break;
        }
    }

    public function setFechaAttribute($valor)
    {
        if( $valor != '' )
        {
            list($dia,$mes,$anio) = explode('/', $valor );
            $fecha = $anio.'-'.$mes.'-'.$dia;
            $this->attributes['fecha'] = $fecha;
        }
    }

}
