<?php

namespace farmacia;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class producto_lote extends Model
{
    use SoftDeletes;
    protected $table = 'producto_lote';
    protected $primaryKey = 'id';

    protected $fillable = ['id_producto','producto','lote','laboratorio','vencimiento','precio','precio_old','id_proveedor','proveedor','stock'];
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
