<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seients;
use App\Models\Sales;
use Illuminate\Support\Facades\Auth;
use App\Models\Esdeveniments;
use App\Models\Entrades;
use App\Models\Reserves;
use Illuminate\Support\Facades\Session;

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

        return redirect()->route('seients.index')->with('success', 'Sala i seients creats correctament.');
    }

    public function edit($id_sala)
    {
        $sala = Sales::findOrFail($id_sala);
        $seients = Seients::where('id_sala', $id_sala)->get();
        $num_files = $seients->max('fila');
        $num_columnes = $seients->max('columna');

        return view('seients.edit', compact('sala', 'seients', 'num_files', 'num_columnes'));
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

        return redirect()->route('seients.index')->with('success', 'Sala i seients actualitzats correctament.');
    }

    public function destroy($id_sala)
    {
        // Eliminar los asientos de la sala
        Seients::where('id_sala', $id_sala)->delete();

        // Eliminar la sala
        Sales::destroy($id_sala);

        return redirect()->route('seients.index')->with('success', 'Sala i seients eliminats correctament.');
    }

    public function redirectToSeients(Request $request)
    {
        // Obtener la URL previa
        if (session('origen') === 'inici' || session('origen') === 'navbar') {
            session()->forget('imprimir_ticket');
            session()->forget('origen');
        }

        $request->validate([
            'id_sala' => 'required|integer|exists:sales,id_sala',
            'fecha' => 'required|date_format:Y-m-d H:i:s',
            'id_esdeveniment' => 'required|integer|exists:esdeveniments,id_esdeveniment',
        ]);
        // Obtener la sala asociada al evento
        $sala = Sales::find($request->id_sala);
        // Guardar datos en sesión
        session([
            'fecha_seleccionada' => $request->fecha,
            'id_esdeveniment' => $request->id_esdeveniment,
            'id_sala' => $request->id_sala,
            'id_tipus_sala' => $sala ? $sala->id_tipus_sala : null,
        ]);

        if ($sala->id_tipus_sala == 2) {
            return redirect()->route('tickets.quantitatEntradesDisco');
        }

        // Obtener los asientos reservados para el evento y fecha seleccionados
        $asientosReservados = Reserves::where('id_esdeveniment', $request->id_esdeveniment)
            ->where('data_event', $request->fecha)
            ->get(['fila', 'columna']);

        // Guardar los asientos reservados en la sesión
        session(['asientosReservados' => $asientosReservados]);

        // Redirigir a la vista con los datos correctos
        return redirect()->route('sales.show', ['id_sala' => $request->id_sala]);
    }

    /*
    public function redirectToSeients2(Request $request)
    {
        Session::forget('imprimir_ticket');

        $request->validate([
            'id_esdeveniment' => 'required|integer|exists:esdeveniments,id_esdeveniment',
        ]);
    
        // Obtener el evento y la sala
        $esdeveniment = Esdeveniments::findOrFail($request->id_esdeveniment);
        $id_sala = $esdeveniment->id_sala;
        $id_tipus_sala = $id_sala ? Sales::find($id_sala)->id_tipus_sala : null;
    
        // Guardar los datos en sesión
        session([
            'id_esdeveniment' => $request->id_esdeveniment,
            'id_sala' => $id_sala,
            'id_tipus_sala' => $id_tipus_sala,
        ]);
    
        // Solo asignar imprimir_ticket si está presente en la solicitud
        if ($request->has('imprimir_ticket')) {
            session(['imprimir_ticket' => true]);
        } else {
            session(['imprimir_ticket' => false]);
        }
    
        if ($id_tipus_sala == 2) {
            return redirect()->route('tickets.quantitatEntradesDisco');
        }
    
        // Obtener los asientos ocupados para el evento y fecha seleccionados
        $asientosReservados = Reserves::where('id_esdeveniment', $request->id_esdeveniment)
            ->where('data_event', $request->fecha)
            ->get(['fila', 'columna']);
    
        // Guardar los asientos reservados en la sesión
        session(['asientosReservados' => $asientosReservados]);
    
        // Redirigir a la vista con los datos correctos
        return redirect()->route('sales.show', ['id_sala' => $id_sala]);
    }
    */

    public function showSeients($id_sala, Request $request)
    {
        $fechaSeleccionada = session('fecha_seleccionada');
        $esdeveniment = Esdeveniments::where('id_sala', $id_sala)->first();
        $seients = Seients::where('id_sala', $id_sala)->get();
        $entrades = Entrades::all();

        if (!$esdeveniment) {
            return redirect()->route('sales.index')->with('error', 'Esdeveniment no trobat');
        }

        return view('seients.showSeients', compact('esdeveniment', 'seients', 'entrades', 'fechaSeleccionada'));
    }


    public function mostrarVista()
    {
        $idEsdeveniment = session('id_esdeveniment');
        $esdeveniment = $idEsdeveniment ? Esdeveniments::find($idEsdeveniment) : null;

        return view('tu_vista', compact('esdeveniment', 'entrades'));
    }

    public function saveSelectedEntrades(Request $request)
    {
        // Suponiendo que las entradas seleccionadas vienen del frontend como un array de objetos
        $entrades = $request->input('entrades');

        // Guardamos las entradas seleccionadas en la sesión
        session(['selectedEntrades' => $entrades]);

        return response()->json(['status' => 'success']);
    }

}
