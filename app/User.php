<?php

namespace sisInv;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    protected $table='users'; 
    
    protected $primaryKey='id'; 

    protected $fillable = [
        'name', 'email', 'pass', 'password','password_confirmation', 'id_cargo', 'id_empresa','id_sucursal','cedula','imagen','status'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    
    function cargo() {
        return $this->belongsTo('App\Cargo', 'id_cargo', 'id_cargo');
    }

    function company() {
        return $this->belongsTo('App\Empresa', 'id_empresa', 'id_empresa');
    }

    function sucursalc() {
        return $this->belongsTo('App\Sucursal', 'id_sucursal', 'id_sucursal');
    }
}
