<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Centromedico extends Model
{
    protected $table = 'centromedicos';
    public $timestamps=false;

    protected $primaryKey = 'id';
    public $incrementing = false;
    public $keyType = 'string';

    
    public function trabajador()
    {
        return $this->hasMany('App\Fichasocioeconomica');
    }

}
