<?php

namespace App\Http\Controllers;

use App\Models\Entrades;
use Illuminate\Http\Request;

class EntradesController extends Controller
{
    public function index()
    {
        $entrades = Entrades::all();
        return view('entrades.index', compact('entrades'));
    }

    public function show($id_entrada)
    {
        $entrada = Entrades::findOrFail($id_entrada);
        return view('entrades.show', compact('entrada'));
    }

    public function create()
    {
        return view('entrades.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipus_entrada' => 'required',
            'descompte' => 'nullable|integer',
        ]);

        Entrades::create($request->all());

        return redirect()->route('entrades.index')->with('success', 'Entrada creada correctament');
    }

    public function edit($id_entrada)
    {
        $entrada = Entrades::findOrFail($id_entrada);
        return view('entrades.edit', compact('entrada'));
    }

    public function update(Request $request, $id_entrada)
    {
        $request->validate([
            'tipus_entrada' => 'required',
            'descompte' => 'nullable|integer',
        ]);

        $entrada = Entrades::findOrFail($id_entrada);
        $entrada->update($request->all());

        return redirect()->route('entrades.index')->with('success', 'Entrada actualitzada correctament');
    }

    public function destroy($id_entrada)
    {
        $entrada = Entrades::findOrFail($id_entrada);
        $entrada->delete();

        return redirect()->route('entrades.index')->with('success', 'Entrada eliminada correctament');
    }

    public function dadesEntrada(Request $request)
    {
        $id_entrada = $request->input('id_entrada');
        
        $entrada = Entrades::findOrFail($id_entrada);

        return view('entrades.dadesEntrada', compact('entrada'));
    }

    public function validacioEntrada()
    {
        return view('entrades.validarEntrada', compact('entrada'));
    }
}