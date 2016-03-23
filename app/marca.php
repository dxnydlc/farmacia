<?php

namespace farmacia;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class marca extends Model
{
    use SoftDeletes;
    protected $table = 'marca';
    protected $primaryKey = 'id_marca';

    protected $fillable = ['nombre'];
    protected $dates = ['deleted_at'];
}
