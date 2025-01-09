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
        'dies_dates',
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

    /**
     * Get the tipus_esdeveniment that owns the esdeveniment.
     */
    public function tipusEsdeveniment()
    {
        return $this->belongsTo(Tipus_esdeveniment::class, 'id_tipus');
    }

    /**
     * Get the categoria that owns the esdeveniment.
     */
    public function categoria()
    {
        return $this->belongsTo(Categories::class, 'id_categoria');
    }

    /**
     * Get the sala that owns the esdeveniment.
     */
    public function sala()
    {
        return $this->belongsTo(Sales::class, 'id_sala');
    }

    /**
     * Get the empresa that owns the esdeveniment.
     */
    public function empresa()
    {
        return $this->belongsTo(Empreses::class, 'id_empresa');
    }
}