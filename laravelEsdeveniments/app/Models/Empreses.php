<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empreses extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'empreses';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nom_empresa',
        'nif',
        'compte_bancari',
        'adreca',
        'ciutat',
        'codi_postal',
        'telefon',
        'email',
        'web',
        'horari',
        'logo',
        'logo_capsalera',
    ];

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_empresa';

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

    public function sales()
    {
        return $this->hasMany(Sales::class, 'id_empresa');
    }

    public function esdeveniments()
    {
        return $this->hasMany(Esdeveniments::class, 'id_empresa');
    }
}