<?php

namespace App\Http\Controllers;

use App\Models\Qr;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\Esdeveniments;
use App\Models\User;
use App\Models\PdfModel;
use Illuminate\Support\Facades\Auth;

class HistorialController extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        $pdfsVigents = PdfModel::where('id_usuari', $userId)
            ->whereHas('qr', function ($query) {
                $query->where('validat', false);
            })
            ->get();
        $pdfsExpirats = PdfModel::where('id_usuari', $userId)
            ->whereHas('qr', function ($query) {
                $query->where('validat', true);
            })
            ->get();
        return view('historial.index', compact('pdfsVigents', 'pdfsExpirats'));
    }
}