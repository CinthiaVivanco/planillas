<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Afp extends Model
{
    protected $table = 'afps';
    public $timestamps=false;

    protected $primaryKey = 'id';
    public $incrementing = false;
    public $keyType = 'string';

}