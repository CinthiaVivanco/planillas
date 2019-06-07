<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Derechohabiente extends Model
{
    protected $table = 'derechohabientes';
    public $timestamps=false;

    protected $primaryKey = 'id';
    public $incrementing = false;


    public function tipodocumento()
    {
        return $this->belongsTo('App\Tipodocumento');
    }

    public function vinculofamiliar()
    {
        return $this->belongsTo('App\Vinculofamiliar');
    }

    public function tipodocumentoacredita()
    {
        return $this->belongsTo('App\Tipodocumentoacredita');
    }

    public function tipobaja()
    {
        return $this->belongsTo('App\Tipobaja');
    }

     public function tipovia()
    {
        return $this->belongsTo('App\Tipovia');
    }

    public function tipozona()
    {
        return $this->belongsTo('App\Tipozona');
    }

    public function departamento()
    {
        return $this->belongsTo('App\Departamento');
    }

    public function provincia()
    {
        return $this->belongsTo('App\Provincia');
    }

    public function distrito()
    {
        return $this->belongsTo('App\Distrito');
    }

    public function trabajador()
    {
        return $this->belongsTo('App\Trabajadores');
    }

    public function local()
    {
        return $this->belongsTo('App\Local');
    }

    public function paisemisordocumento()
    {
        return $this->belongsTo('App\Paisemisordocumento');
    }

    public function codigotelefono()
    {
        return $this->belongsTo('App\Codigotelefono');
    }


    
}
