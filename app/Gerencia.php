<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gerencia extends Model
{
    protected $table = 'gerencias';
    public $timestamps=false;

    protected $primaryKey = 'id';
    public $incrementing = false;
    public $keyType = 'string';


    public function contrato()
    {
        return $this->hasMany('App\Contrato');
    }
    
    public function area()
    {
        return $this->hasMany('App\Area');
    }

}