<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aplicacao extends Model
{
	protected $table = 'aplicacao';

    public $timestamps = false;
    
    protected $primaryKey = 'id';

    protected $fillable = [
    	'id',
    	'idQuestionario',
    	'dataInicio', 
    	'dataFim',
    	'idCampus'
    ];
 
}
