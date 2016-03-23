<?php

namespace farmacia;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class proveedor extends Model
{
    use SoftDeletes;
    protected $table = 'proveedor';
    protected $primaryKey = 'id_proveedor';

    protected $fillable = ['nombre','ruc','direccion','telefono','contacto'];
    protected $dates = ['deleted_at'];
}
