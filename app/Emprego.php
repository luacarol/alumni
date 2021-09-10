<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Emprego extends Model
{
    protected $table = 'emprego';

    public $timestamps = false;
    
    protected $primaryKey = 'id';

    protected $guarded = ['id'];

    protected $fillable = [
        'nomeVaga',
	    'preRequisitos',
	    'atividadeVaga',
	    'salario',
	    'horario',
        'qtdVagas',
        'local',
        'dataPublicada',
        'idUsuarioCex',
        'imagem'
    ];
}
