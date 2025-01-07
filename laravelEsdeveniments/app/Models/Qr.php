<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qr extends Model
{
    use HasFactory;
    protected $connection = 'servidor_connection';
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'qr';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'codi_qr',
        'data_generacio',
        'data_expiracio',
        'id_esdeveniment',
        'id_usuari',
    ];

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_qr';

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
     * Get the esdeveniment that owns the QR code.
     */
    public function esdeveniment()
    {
        return $this->belongsTo(Esdeveniments::class, 'id_esdeveniment');
    }

    /**
     * Get the usuari that owns the QR code.
     */
    public function usuari()
    {
        return $this->belongsTo(Usuaris::class, 'id_usuari');
    }
}