<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Frecuenciamedico extends Model
{
    protected $table = 'frecuenciamedicos';
    public $timestamps=false;

    protected $primaryKey = 'id';
    public $incrementing = false;
    public $keyType = 'string';

    
    public function trabajador()
    {
        return $this->hasMany('App\Fichasocioeconomica');
    }

}
