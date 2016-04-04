<?php

namespace farmacia;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ParteEntrada extends Model
{
    use SoftDeletes;
    protected $table = 'parte_entrada';
    protected $primaryKey = 'id_pe';

    protected $fillable = ['id_proveedor','proveedor','fecha','token','id_user','user'];
    protected $dates = ['deleted_at'];
}
