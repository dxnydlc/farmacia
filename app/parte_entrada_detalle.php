<?php

namespace farmacia;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class parte_entrada_detalle extends Model
{
    use SoftDeletes;
    protected $table = 'parte_entrada_detalle';
    protected $primaryKey = 'id_detalle_pe';

    protected $fillable = ['id_producto','producto','laboratorio','vencimiento','lote','cantidad','porcentaje','fraccion','token'];
    protected $dates = ['deleted_at'];
}
