<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fichasocioeconomica extends Model
{
    protected $table = 'fichasocioeconomicas';
    public $timestamps=false;

    protected $primaryKey = 'id';
    public $incrementing = false;


    public function detallefichacasaparte()
    {
        return $this->hasMany('App\Detallefichacasaparte');
    }

     public function detallefichaservicio()
    {
        return $this->hasMany('App\Detallefichaservicio');
    }

        public function detallefichaenfermedad()
    {
        return $this->hasMany('App\Detallefichaenfermedad');
    }

    public function local()
    {
        return $this->belongsTo('App\Local');
    }

    public function tipovivienda()
    {
        return $this->belongsTo('App\Tipovivienda');
    }

    public function construccionmaterial()
    {
        return $this->belongsTo('App\Construccionmaterial');
    }

     public function centromedico()
    {
        return $this->belongsTo('App\Centromedico');
    }

    public function frecuenciamedico()
    {
        return $this->belongsTo('App\Frecuenciamedico');
    }

    public function frecuenciaexamen()
    {
        return $this->belongsTo('App\Frecuenciaexamen');
    }

    public function trabajador()
    {
        return $this->belongsTo('App\Trabajador');
    }


    
}
