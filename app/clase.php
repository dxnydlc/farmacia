<?php

namespace farmacia;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class clase extends Model
{
    use SoftDeletes;
    protected $table = 'clase';
    protected $primaryKey = 'id_clase';

    protected $fillable = ['nombre'];
    protected $dates = ['deleted_at'];
}
