<?php

namespace sisInv;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table='categoria';

    protected $primaryKey='id_categoria';

    public $timestamps=true;

    protected $fillable =[
        'nombre',
        'descripcion',
        'estado',
    ];

    protected $guarded =[

    ];
}
