<?php

namespace App\Http\Controllers;

use App\Models\Seients;
use App\Models\Sales;
use Illuminate\Http\Request;

class SeientsController extends Controller
{
    public function index()
    {
        $seients = Seients::all();
        return view('seients.index', compact('seients'));
    }

    public function show($id_seient)
    {
        $seient = Seients::findOrFail($id_seient);
        return view('seients.show', compact('seient'));
    }

    public function create()
    {
        return view('seients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'seats.*.*.fila' => 'required|integer',
            'seats.*.*.columna' => 'required|integer',
            'seats.*.*.preu' => 'required|numeric',
            'seats.*.*.estat_seient' => 'required|integer',
            'id_sala' => 'required|exists:sales,id_sala',
        ]);

        foreach ($request->seats as $fila => $columnes) {
            foreach ($columnes as $columna => $seatData) {
                Seients::create([
                    'fila' => $seatData['fila'],
                    'columna' => $seatData['columna'],
                    'preu' => $seatData['preu'],
                    'estat_seient' => $seatData['estat_seient'],
                    'id_sala' => $request->id_sala,
                ]);
            }
        }

        return redirect()->route('seients.index')->with('success', 'Seients creats correctament');
    }

    public function edit($id_seient)
    {
        $seient = Seients::findOrFail($id_seient);
        return view('seients.edit', compact('seient'));
    }

    public function update(Request $request, $id_seient)
    {
        $request->validate([
            'fila' => 'required|integer',
            'columna' => 'required|integer',
            'preu' => 'required|numeric',
            'estat_seient' => 'required|integer',
            'id_sala' => 'required|exists:sales,id_sala',
        ]);

        $seient = Seients::findOrFail($id_seient);
        $seient->update($request->all());

        return redirect()->route('seients.index')->with('success', 'Seient actualitzat correctament');
    }

    public function destroy($id_seient)
    {
        $seient = Seients::findOrFail($id_seient);
        $seient->delete();

        return redirect()->route('seients.index')->with('success', 'Seient eliminat correctament');
    }

    public function showSeients($id_sala)
    {
        $sala = Sales::findOrFail($id_sala);
        $seients = Seients::where('id_sala', $id_sala)->orderBy('fila')->orderBy('columna')->get()->groupBy('fila');
        return view('seients.showSeients', compact('sala', 'seients'));
    }
}