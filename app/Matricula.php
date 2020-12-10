<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    protected $table = 'matricula';

    public $timestamps = false;
    
    protected $primaryKey = 'prontuario';


    protected $fillable = [
        'prontuario',
        'idCurso',
        'idCampus',
        'idStatusFormacao',
        'cpfAluno'
    ];
}
