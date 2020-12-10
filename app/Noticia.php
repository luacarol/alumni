<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
	protected $table = 'noticia';

    public $timestamps = false;
    
    protected $primaryKey = 'id';

     protected $guarded = ['id'];

    protected $fillable = [
    	'titulo',
    	'lide', 
    	'texto', 
    	'imagem', 
    	'data',
    	'idUsuarioCex'
    ];
 
}
