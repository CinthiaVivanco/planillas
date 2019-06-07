<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detallefichaservicio extends Model
{
    protected $table = 'detallefichaservicios';
    public $timestamps=false;

    protected $primaryKey = 'id';
    public $incrementing = false;
    public $keyType = 'string';

    
    public function fichasocioeconomicas()
    {
        return $this->belongsTo('App\Fichasocioeconomica');
    }

    public function servicio()
    {
        return $this->belongsTo('App\Servicio');
    }
    

}