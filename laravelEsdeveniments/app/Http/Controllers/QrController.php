<?php

namespace App\Http\Controllers;

use App\Models\Qr;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\Esdeveniments;

class QrController extends Controller
{
    public function index()
    {
        $qrs = Qr::all();
        return view('qrs.index', compact('qrs'));
    }

    public function show($id_qr)
    {
        $qr = Qr::findOrFail($id_qr);
        return view('qrs.show', compact('qr'));
    }

    public function create()
    {
        return view('qrs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'codi_qr' => 'required',
            'data_generacio' => 'required|date',
            'data_expiracio' => 'required|date',
            'id_esdeveniment' => 'required|exists:esdeveniments,id_esdeveniment',
            'id_usuari' => 'required|exists:users,id',
        ]);

        Qr::create($request->all());

        return redirect()->route('qrs.index')->with('success', 'QR creat correctament');
    }

    public function edit($id_qr)
    {
        $qr = Qr::findOrFail($id_qr);
        return view('qrs.edit', compact('qr'));
    }

    public function update(Request $request, $id_qr)
    {
        $request->validate([
            'codi_qr' => 'required',
            'data_generacio' => 'required|date',
            'data_expiracio' => 'required|date',
            'id_esdeveniment' => 'required|exists:esdeveniments,id_esdeveniment',
            'id_usuari' => 'required|exists:users,id',
        ]);

        $qr = Qr::findOrFail($id_qr);
        $qr->update($request->all());

        return redirect()->route('qrs.index')->with('success', 'QR actualitzat correctament');
    }

    public function destroy($id_qr)
    {
        $qr = Qr::findOrFail($id_qr);
        $qr->delete();

        return redirect()->route('qrs.index')->with('success', 'QR eliminat correctament');
    }

    public function generarQr($id_esdeveniment)
    {
        $codigo = Str::random(12);
        $nom_esdeveniment = Esdeveniments::find($id_esdeveniment)->nom;

        $qr = new Qr();
        $qr->codi_qr = $codigo;
        $qr->id_esdeveniment = $id_esdeveniment;
        $qr->data_generacio = Carbon::now();
        $qr->data_expiracio = Carbon::now()->addDays(7);
        $qr->id_usuari = 4;

        $qrContent = "$codigo\n$nom_esdeveniment\n";
        $qrImage = QrCode::format('png')->size(200)->generate($qrContent);
        $qrImageBlob = base64_encode($qrImage);

        $qr->dibuix_qr = $qrImageBlob;
        $qr->save();

        return $qr;
    }

    public function validarQr(Request $request)
    {
        $codigoQr = $request->input('codigo_qr');

        $qr = Qr::where('codi_qr', $codigoQr)->first();

        if (!$qr) {
            return response()->json([
                'success' => false,
                'message' => 'El código QR no existe.'
            ], 404);
        }

        if ($qr->validat) {
            return response()->json([
                'success' => false,
                'message' => 'El código QR ya ha sido validado.'
            ], 400);
        }

        if (Carbon::now()->greaterThan($qr->data_expiracio)) {
            return response()->json([
                'success' => false,
                'message' => 'El código QR ha expirado.'
            ], 400);
        }

        $qr->validat = 1;

        $qr->data_expiracio = Carbon::now();

        $qr->save();

        return response()->json([
            'success' => true,
            'message' => 'El código QR ha sido validado correctamente.',
            'qr' => $qr
        ]);
    }
}