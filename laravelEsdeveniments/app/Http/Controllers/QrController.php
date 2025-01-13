<?php

namespace App\Http\Controllers;

use App\Models\Qr;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


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

    public function generarQr()
    {
        $codigo = Str::random(12);
        $id_esdeveniment = rand(2, 5);
        if($id_esdeveniment == 2) {
            $nom_esdeveniment = 'Ive Got the Cimex';
        }
        if($id_esdeveniment == 3) {
            $nom_esdeveniment = 'Manole del Flow';
        }
        if($id_esdeveniment == 4) {
            $nom_esdeveniment = 'Tinc caca';
        }
        if($id_esdeveniment == 5) {
            $nom_esdeveniment = 'Berlingo is not pipolian';
        }

        $qr = new Qr();
        $qr->codi_qr = $codigo;
        $qr->data_generacio = Carbon::now();
        $qr->data_expiracio = Carbon::now()->addDays(7);
        $qr->id_esdeveniment = $id_esdeveniment;
        $qr->id_usuari = 4; // Ajusta según corresponda

        $qrContent = "$codigo\n$nom_esdeveniment";
        $qrImage = QrCode::format('png')->size(200)->generate($qrContent);
        $qrImageBlob = base64_encode($qrImage);

        $qr->dibuix_qr = $qrImageBlob;
        $qr->save();

        return $qr; // Devolver el modelo de QR
    }

}