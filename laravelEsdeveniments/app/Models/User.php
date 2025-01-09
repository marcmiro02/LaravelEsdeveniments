<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'surname',
        'adreca',
        'nom_usuari',
        'targeta_bancaria',
        'data_naixement',
        'foto_perfil',
        'rol',
        'id_empresa',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'foto_perfil' => 'binary',
        ];
    }

    /**
     * Relationship with the RolsUsuaris model.
     */
    public function rol()
    {
        return $this->belongsTo(RolsUsuaris::class, 'rol', 'id_rol');
    }

    /**
     * Relationship with the Empreses model.
     */
    public function empresa()
    {
        return $this->belongsTo(Empreses::class, 'id_empresa', 'id_empresa');
    }
}
