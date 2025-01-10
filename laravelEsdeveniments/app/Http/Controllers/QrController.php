<?php

namespace App\Http\Controllers;

use App\Models\Qr;
use Illuminate\Http\Request;

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
}