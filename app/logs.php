<?php

namespace farmacia;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class logs extends Model
{
    use SoftDeletes;
    protected $table = 'logs';
    protected $primaryKey = 'id';

    protected $fillable = ['tipo','tipo_doc','key','evento','contenido','resultado','fecha','id_user','usuario','link_to'];
    protected $dates = ['deleted_at'];
}
