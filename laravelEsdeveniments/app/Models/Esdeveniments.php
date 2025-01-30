<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Esdeveniments extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'esdeveniments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nom',
        'foto_portada',
        'foto_fons',
        'duracio',
        'sinopsis',
        'trailer',
        'director',
        'actors',
        'data_estrena',
        'edats',
        'id_tipus',
        'id_categoria',
        'id_sala',
        'id_empresa',
    ];

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_esdeveniment';

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

    public function horaris()
    {
        return $this->hasMany(Horari::class, 'id_esdeveniment');
    }
}