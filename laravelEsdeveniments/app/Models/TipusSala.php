<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipusSala extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';

    protected $table = 'tipus_sala';

    protected $fillable = [
        'nom_sala',
    ];

    public $timestamps = false;

    public function sales()
    {
        return $this->belongsTo(Sales::class, 'id_sala');
    }
}