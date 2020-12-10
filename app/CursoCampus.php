<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CursoCampus extends Model
{
    protected $table = 'cursocampus';

    public $timestamps = false;
    
    protected $primaryKey = ['idCurso','idCampus'];

    protected $fillable = [
        'idCurso',
        'idCampus'
    ];
}
