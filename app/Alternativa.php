<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alternativa extends Model
{
	protected $table = 'alternativa';

    public $timestamps = false;
    
    protected $primaryKey = 'id';

    protected $fillable = [
    	'id',
    	'alternativa',
    	'idPergunta'
    ];

    public function pergunta(){
        return $this->belongsTo(Pergunta::class, 'idPergunta');
    }
 
}
