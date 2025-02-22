<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserves extends Model
{
    use HasFactory;

    protected $table = 'reserves';
    protected $primaryKey = 'id_reserva';
    public $timestamps = true;

    protected $fillable = [
        'id_esdeveniment',
        'id_usuari',
        'fila',
        'columna',
        'estat',
        'data_event',
    ];

    // Relación con el evento
    public function event()
    {
        return $this->belongsTo(Esdeveniments::class, 'id_esdeveniment');
    }

    // Relación con el usuario
    public function user()
    {
        return $this->belongsTo(User::class, 'id_usuari');
    }
}

?>