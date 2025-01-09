<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'surname',
        'nom_usuari',
        'email',
        'adreca',
        'targeta_bancaria',
        'data_naixement',
        'password',
        'foto_perfil',  // Solo guardaremos la ruta de la imagen
        'rol',
        'id_empresa',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
