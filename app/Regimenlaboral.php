<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Regimenlaboral extends Model
{
    protected $table = 'regimenlaborales';
    public $timestamps=false;

    protected $primaryKey = 'id';
    public $incrementing = false;
    public $keyType = 'string';


    public function trabajador()
    {
        return $this->hasMany('App\Trabajador');
    }


}