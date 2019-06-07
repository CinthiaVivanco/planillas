<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoriaocupacional extends Model
{
    protected $table = 'categoriaocupacionales';
    public $timestamps=false;

    protected $primaryKey = 'id';
    public $incrementing = false;
    public $keyType = 'string';


    public function trabajador()
    {
        return $this->hasMany('App\Trabajador');
    }


}