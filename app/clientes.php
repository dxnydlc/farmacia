<?php

namespace farmacia;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class clientes extends Model
{
    use SoftDeletes;
    protected $table = 'clientes';
    protected $primaryKey = 'id';

    protected $fillable = ['nombre','ruc','direccion','telefono','contacto'];
    protected $dates = ['deleted_at'];
}
