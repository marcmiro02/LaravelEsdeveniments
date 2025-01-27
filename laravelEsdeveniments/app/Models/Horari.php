<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horari extends Model
{
    use HasFactory;

    protected $table = 'horaris';

    protected $fillable = [
        'data_hora',
        'id_esdeveniment',
    ];

    public function esdeveniment()
    {
        return $this->belongsTo(Esdeveniments::class, 'id_esdeveniment');
    }
    public $timestamps = false;

}