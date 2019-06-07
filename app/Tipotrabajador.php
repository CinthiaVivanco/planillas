<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipotrabajador extends Model
{
    protected $table = 'tipotrabajadores';
    public $timestamps=false;

    protected $primaryKey = 'id';
    public $incrementing = false;
    public $keyType = 'string';

    
    public function trabajador()
    {
        return $this->hasMany('App\Trabajador');
    }

}
