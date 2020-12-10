<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $table = 'evento';

    public $timestamps = false;
    
    protected $primaryKey = 'id';

    protected $guarded = ['id'];

    protected $fillable = [
        'titulo',
	    'descricao',
	    'imagem',
	    'data',
	    'horarioIn',
	    'horarioFin',
	    'local',
	    'qtdVagas',
	    'idUsuarioCex'
    ];
}
