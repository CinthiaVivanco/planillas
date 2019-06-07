<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tiporegistro extends Model
{
    protected $table = 'tiporegistros';
    public $timestamps=false;

    protected $primaryKey = 'id';
    public $incrementing = false;
    public $keyType = 'string';



    public function trabajador()
    {
        return $this->hasMany('App\Trabajador');
    }

     public function indicadortiporegistro()
    {
        return $this->belongsTo('App\Indicadortiporegistro');
    }


}