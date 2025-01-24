<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seients;
use App\Models\Sales;
use App\Models\Esdeveniments;
use Illuminate\Support\Facades\Auth;

class SalesController extends Controller
{
    public function index()
    {
        $sales = Sales::all();
        return view('sales.index', compact('sales'));
    }

    
    public function show($id_sala)
    {
        $sala = Sales::findOrFail($id_sala);
        $seients = Seients::where('id_sala', $id_sala)->get()->groupBy('fila');
        $esdeveniment = Esdeveniments::where('id_sala', $id_sala)->firstOrFail();
        return view('sales.show', compact('sala', 'seients', 'esdeveniment'));
    }

    public function create()
    {
        return view('sales.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom_sala' => 'required|string|max:255',
            'seats.*.*.fila' => 'required|integer',
            'seats.*.*.columna' => 'required|integer',
            'seats.*.*.estat_seient' => 'required|integer',
            'seats.*.*.preu' => 'required|numeric',
        ]);

        // Crear la sala
        $sala = Sales::create([
            'nom_sala' => $request->nom_sala,
            'aforament' => 0, // Se actualizará después de contar los asientos
            'id_empresa' => Auth::user()->id_empresa,
        ]);

        $aforament = 0;

        // Crear los asientos
        foreach ($request->seats as $fila => $columnes) {
            foreach ($columnes as $columna => $seatData) {
                Seients::create([
                    'fila' => $seatData['fila'],
                    'columna' => $seatData['columna'],
                    'estat_seient' => $seatData['estat_seient'],
                    'id_sala' => $sala->id_sala,
                    'preu' => $seatData['preu'],
                ]);

                // Contar los asientos disponibles para el aforo
                if (in_array($seatData['estat_seient'], [1, 2, 3])) {
                    $aforament++;
                }
            }
        }

        // Actualizar el aforo de la sala
        $sala->aforament = $aforament;
        $sala->save();

        return redirect()->route('sales.index')->with('success', 'Sala i seients creats correctament.');
    }

    public function edit($id_sala)
    {
        $sala = Sales::findOrFail($id_sala);
        $seients = Seients::where('id_sala', $id_sala)->get();
        $num_files = $seients->max('fila');
        $num_columnes = $seients->max('columna');

        return view('sales.edit', compact('sala', 'seients', 'num_files', 'num_columnes'));
    }

    public function update(Request $request, $id_sala)
    {
        $request->validate([
            'nom_sala' => 'required|string|max:255',
            'seats.*.*.fila' => 'required|integer',
            'seats.*.*.columna' => 'required|integer',
            'seats.*.*.estat_seient' => 'required|integer',
            'seats.*.*.preu' => 'required|numeric',
        ]);

        // Actualizar la sala
        $sala = Sales::findOrFail($id_sala);
        $sala->nom_sala = $request->nom_sala;
        $sala->save();

        // Eliminar los asientos existentes
        Seients::where('id_sala', $id_sala)->delete();

        $aforament = 0;

        // Crear los nuevos asientos
        foreach ($request->seats as $fila => $columnes) {
            foreach ($columnes as $columna => $seatData) {
                Seients::create([
                    'fila' => $seatData['fila'],
                    'columna' => $seatData['columna'],
                    'estat_seient' => $seatData['estat_seient'],
                    'id_sala' => $sala->id_sala,
                    'preu' => $seatData['preu'],
                ]);

                // Contar los asientos disponibles para el aforo
                if (in_array($seatData['estat_seient'], [1, 2, 3])) {
                    $aforament++;
                }
            }
        }

        // Actualizar el aforo de la sala
        $sala->aforament = $aforament;
        $sala->save();

        return redirect()->route('sales.index')->with('success', 'Sala i seients actualitzats correctament.');
    }

    public function destroy($id_sala)
    {
        // Eliminar los asientos de la sala
        Seients::where('id_sala', $id_sala)->delete();

        // Eliminar la sala
        Sales::destroy($id_sala);

        return redirect()->route('sales.index')->with('success', 'Sala i seients eliminats correctament.');
    }
}