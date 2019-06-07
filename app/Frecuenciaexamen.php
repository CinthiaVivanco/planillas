<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Frecuenciaexamen extends Model
{
    protected $table = 'frecuenciaexamenes';
    public $timestamps=false;

    protected $primaryKey = 'id';
    public $incrementing = false;
    public $keyType = 'string';



    public function trabajador()
    {
        return $this->hasMany('App\Trabajador');
    }


}