<?php

namespace farmacia;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'last_name', 'dni', 'email', 'type', 'user', 'password',
    ];

    public function getTypeAttribute($valor)
    {
        if( $valor != '' )
        {
            switch ($valor) {
                case 'admin':
                    return 'Administrador';
                break;
                case 'normal':
                    return 'Estándar';
                break;
            }
        }
    }

    public function setPasswordAttribute($valor)
    {
        if( !empty($valor) ){
           $this->attributes['password'] = \Hash::make( $valor);
        }
    }

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
