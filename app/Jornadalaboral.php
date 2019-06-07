<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jornadalaboral extends Model
{
    protected $table = 'jornadalaborals';
    public $timestamps=false;

    protected $primaryKey = 'id';
    public $incrementing = false;
    public $keyType = 'string';


    public function detallejornadalaboral()
    {
        return $this->hasMany('App\Detallejornadalaboral');
    }


}