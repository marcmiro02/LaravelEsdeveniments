<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qr extends Model
{
    use HasFactory;

    protected $table = 'qr';

    protected $primaryKey = 'id_qr';

    public $incrementing = true;

    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
        'codi_qr',
        'data_generacio',
        'data_expiracio',
        'id_esdeveniment',
        'id_usuari',
        'dibuix_qr',
    ];

    public function esdeveniment()
    {
        return $this->belongsTo(Esdeveniments::class, 'id_esdeveniment');
    }

    public function usuari()
    {
        return $this->belongsTo(User::class, 'id_usuari');
    }
}