<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Indicadortiporegistro extends Model
{
    protected $table = 'indicadortiporegistros';
    public $timestamps=false;

    protected $primaryKey = 'id';
    public $incrementing = false;
    public $keyType = 'string';

    public function tiporegistro()
    {
        return $this->hasMany('App\Tiporegistro');
    }

}