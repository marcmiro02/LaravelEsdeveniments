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
        'rol_id',
        'id_empresa',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the empresa that owns the user.
     */
    public function empresa()
    {
        return $this->belongsTo(Empreses::class, 'id_empresa');
    }

    /**
     * Get the role that owns the user.
     */
    public function role()
    {
        return $this->belongsTo(Rols_usuaris::class, 'rol', 'id_rol');
    }
}
