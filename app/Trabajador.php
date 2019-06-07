<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trabajador extends Model
{
    protected $table = 'trabajadores';
    public $timestamps=false;

    protected $primaryKey = 'id';
    public $incrementing = false;

    public function rubrotrabajador()
    {
        return $this->hasMany('App\Rubrotrabajador');
    }
    
    public function tipodocumento()
    {
        return $this->belongsTo('App\Tipodocumento');
    }

    public function estadocivil()
    {
        return $this->belongsTo('App\Estadocivil');
    }

    public function codigotelefono()
    {
        return $this->belongsTo('App\Codigotelefono');
    }

    public function nacionalidad()
    {
        return $this->belongsTo('App\Nacionalidad');
    }

    public function pais()
    {
        return $this->belongsTo('App\Pais');
    }

    public function departamento()
    {
        return $this->belongsTo('App\Departamento');
    }

    public function tipovia()
    {
        return $this->belongsTo('App\Tipovia');
    }

    public function horario()
    {
        return $this->belongsTo('App\Horario');
    }

    public function tipozona()
    {
        return $this->belongsTo('App\Tipozona');
    }


    public function tipotrabajador()
    {
        return $this->belongsTo('App\Tipotrabajador');
    }

   
    public function motivobaja()
    {
        return $this->belongsTo('App\Motivobaja');
    }

    public function entidadfinanciera()
    {
        return $this->belongsTo('App\Entidadfinanciera');
    }


    public function regimensalud()
    {
        return $this->belongsTo('App\Regimensalud');
    }

    public function regimenpensionario()
    {
        return $this->belongsTo('App\Regimenpensionario');
    }

    public function provincia()
    {
        return $this->belongsTo('App\Provincia');
    }

    public function distrito()
    {
        return $this->belongsTo('App\Distrito');
    }

    public function codigoeps()
    {
        return $this->belongsTo('App\Codigoeps');
    }

    public function situacion()
    {
        return $this->belongsTo('App\Situacion');
    }

    public function situacioneducativa()
    {
        return $this->belongsTo('App\Situacioneducativa');
    }

    public function regimeninstitucion()
    {
        return $this->belongsTo('App\Regimeninstitucion');
    }

     public function tipoinstitucion()
    {
        return $this->belongsTo('App\Tipoinstitucion');
    }

    public function institucion()
    {
        return $this->belongsTo('App\Institucion');
    }

     public function carrera()
    {
        return $this->belongsTo('App\Carrera');
    }

    public function regimenlaboral()
    {
        return $this->belongsTo('App\regimenlaboral');
    }

    public function categoriaocupacional()
    {
        return $this->belongsTo('App\Categoriaocupacional');
    }

    public function ocupacion()
    {
        return $this->belongsTo('App\Ocupacion');
    }

    public function local()
    {
        return $this->belongsTo('App\Local');
    }

    public function situacionespecial()
    {
        return $this->belongsTo('App\Situacionespecial');
    }

    public function derechohabiente()
    {
        return $this->hasMany('App\Derechohabiente');
    }

    public function fichasocioeconomica()
    {
        return $this->hasMany('App\Fichasocioeconomica');
    }

    public function contrato()
    {
        return $this->hasMany('App\Contrato');
    }

    public function paisemisordocumento()
    {
        return $this->belongsTo('App\Paisemisordocumento');
    }

    public function convenio()
    {
        return $this->belongsTo('App\Convenio');
    }

    public function categoria()
    {
        return $this->belongsTo('App\Categoria');
    }

    public function tiporegistro()
    {
        return $this->belongsTo('App\Tiporegistro');
    }


}
