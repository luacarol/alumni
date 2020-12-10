<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Pergunta extends Model
{
	protected $table = 'pergunta';

    public $timestamps = false;
    
    protected $primaryKey = 'id';

    protected $fillable = [
    	'id',
    	'pergunta',
    	'tipo', 
    	'idQuestionario'
    ];

    public function alternativas()
    {
       
        return $this->hasMany(Alternativa::class,'idPergunta','id');

    }
 
}
