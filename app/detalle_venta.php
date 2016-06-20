<?php

namespace farmacia;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class detalle_venta extends Model
{
    use SoftDeletes;
    protected $table = 'detalle_venta';
    protected $primaryKey = 'id';

    protected $fillable = ['producto','id_producto','lote','laboratorio','vencimiento','cantidad','precio','total','descuento','id_user','usuario','token'];
    protected $dates = ['deleted_at'];

    public function getVencimientoAttribute($valor)
    {
    	if( $valor != '' )
    	{
    		list($anio,$mes,$dia) = explode('-', $valor );
    		$fecha = $dia.'/'.$mes.'/'.$anio;
    		return $fecha;
    	}
    }
    public function setVencimientoAttribute($valor)
    {
        if( $valor != '' )
        {
            list($dia,$mes,$anio) = explode('/', $valor );
            $fecha = $anio.'-'.$mes.'-'.$dia;
            $this->attributes['vencimiento'] = $fecha;
        }
    }
}
