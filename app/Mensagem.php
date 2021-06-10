<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mensagem extends Model
{
   protected $table = 'mensagemindex';

    public $timestamps = false;

    protected $primaryKey = 'id';

    protected $fillable = [
    	'nome',
		'assunto',
		'mensagem',
		'telefone',
		'email',
		'idCampus',
		'status',
		'data',
		'visualizadoPor'
    ];
}
