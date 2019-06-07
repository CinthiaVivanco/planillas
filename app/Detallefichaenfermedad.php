<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detallefichaenfermedad extends Model
{
    protected $table = 'detallefichaenfermedades';
    public $timestamps=false;

    protected $primaryKey = 'id';
    public $incrementing = false;
    public $keyType = 'string';

    
    public function fichasocioeconomicas()
    {
        return $this->belongsTo('App\Fichasocioeconomica');
    }

    public function enfermedad()
    {
        return $this->belongsTo('App\Enfermedad');
    }
    

}