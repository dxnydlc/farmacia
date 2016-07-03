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


    public function setTipodocAttribute($valor)
    {
        if( $valor != '' )
        {
            switch ($valor) {
                case 'Boleta':
                    $this->attributes['tipo_doc'] = 'B';
                    break;
                case 'Factura':
                    $this->attributes['tipo_doc'] = 'F';
                    break;
                default:
                    $this->attributes['tipo_doc'] = $valor;
                break;
            }
            
        }
    }

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
            case 'DEL':
                return 'Anulado';
                break;
        }
    }

    public function getTipodocAttribute($valor)
    {
        switch ($valor) {
            case 'B':
                return 'Boleta';
                break;
            case 'F':
                return 'Factura';
                break;
        }
    }
    
}
