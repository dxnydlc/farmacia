<?php

namespace farmacia;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class categoria extends Model
{
    use SoftDeletes;
    protected $table = 'categoria';
    protected $primarykey = 'id_categoria';

    protected $fillable = ['nombre'];
    protected $dates = ['deleted_at'];
}
