<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questionario extends Model
{
	protected $table = 'questionario';

    public $timestamps = false;
    
    protected $primaryKey = 'id';

    protected $fillable = [
    	'id',
    	'titulo',
    	'descricao', 
    	'idUsuarioCex'
    ];
 
}
