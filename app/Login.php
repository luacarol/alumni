<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Login extends Authenticatable
{
    use Notifiable;

    protected $guard = 'web';

    protected $table = 'login';

    public $timestamps = false;
    
    protected $primaryKey = 'id';

    protected $guarded = ['id'];

    protected $fillable = [
        'email',
        'password',
        'idTipoUsuario'
    ];
}
