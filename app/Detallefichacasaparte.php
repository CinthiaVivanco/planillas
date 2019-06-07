<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detallefichacasaparte extends Model
{
    protected $table = 'detallefichacasapartes';
    public $timestamps=false;

    protected $primaryKey = 'id';
    public $incrementing = false;
    public $keyType = 'string';

    
    public function fichasocioeconomicas()
    {
        return $this->hasMany('App\Fichasocioeconomica');
    }

    public function casaparte()
    {
        return $this->belongsTo('App\Casaparte');
    }
    

}