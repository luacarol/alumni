<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsuarioAluno extends Model
{
    protected $table = 'usuarioaluno';

    public $timestamps = false;
    
    protected $primaryKey = 'cpf';


    protected $fillable = [
        'nome',
        'dataNasc',
        'rg',
        'idLogin',
        'idGenero',
        'cpf'
    ];
}
