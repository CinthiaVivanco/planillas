<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detallejornadalaboral extends Model
{
    protected $table = 'Detallejornadalaborals';
    public $timestamps=false;

    protected $primaryKey = 'id';
    public $incrementing = false;
    public $keyType = 'string';

    
    public function contrato()
    {
        return $this->hasMany('App\contrato');
    }

    public function jornadalaboral()
    {
        return $this->belongsTo('App\Jornadalaboral');
    }
    

}