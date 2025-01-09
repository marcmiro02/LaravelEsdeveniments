<?php

namespace App\Http\Controllers;

use App\Models\Seients;
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
            'fila' => 'required',
            'columna' => 'required',
            'estat_seient' => 'required',
            'id_sala' => 'required|exists:sales,id_sala',
        ]);

        Seients::create($request->all());

        return redirect()->route('seients.index')->with('success', 'Seient creat correctament');
    }

    public function edit($id_seient)
    {
        $seient = Seients::findOrFail($id_seient);
        return view('seients.edit', compact('seient'));
    }

    public function update(Request $request, $id_seient)
    {
        $request->validate([
            'fila' => 'required',
            'columna' => 'required',
            'estat_seient' => 'required',
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
}