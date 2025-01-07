<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuaris extends Model
{
    use HasFactory;
    protected $connection = 'servidor_connection';
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'usuaris';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nom',
        'cognoms',
        'adreca',
        'correu',
        'nom_usuari',
        'contrasenya',
        'targeta_bancaria',
        'data_naixement',
        'foto_perfil',
        'rol',
        'id_empresa',
    ];

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_usuari';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * The data type of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'int';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Get the role that owns the user.
     */
    public function role()
    {
        return $this->belongsTo(Rols_usuaris::class, 'rol');
    }

    /**
     * Get the company that owns the user.
     */
    public function company()
    {
        return $this->belongsTo(Empreses::class, 'id_empresa');
    }
}