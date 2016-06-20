<?php

namespace farmacia;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class venta extends Model
{
    use SoftDeletes;
    protected $table = 'venta';
    protected $primaryKey = 'id';

    protected $fillable = ['tipo_doc','serie','correlativo', 'id_cliente','cliente','fecha','total','ruc','razon_social','forma_pago','pago_efectivo','vuelto','motivo_anular','token','estado','id_user_creado','user_creado','id_user_anula','user_anula','id_user_cierra','user_cierra'];
    protected $dates = ['deleted_at'];

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
