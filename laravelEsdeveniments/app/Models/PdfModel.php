<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PdfModel extends Model
{
    use HasFactory;

    protected $table = 'pdf';

    protected $primaryKey = 'id_pdf';

    public $incrementing = true;

    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
        'doc_pdf',
        'id_usuari',
    ];
}