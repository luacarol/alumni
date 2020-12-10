<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genero extends Model
{
    protected $table = 'genero';

    public $timestamps = false;
    
    protected $primaryKey = 'id';

    protected $guarded = ['id'];

    protected $fillable = [
        'genero'
    ];
}
