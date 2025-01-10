<?php

namespace App\Http\Controllers;

use App\Models\Tipus_esdeveniment;
use Illuminate\Http\Request;

class TipusEsdevenimentController extends Controller
{
    public function index()
    {
        $tipusEsdeveniments = Tipus_esdeveniment::all();
        return view('tipus_esdeveniments.index', compact('tipusEsdeveniments'));
    }

    public function show($id_tipus)
    {
        $tipusEsdeveniment = Tipus_esdeveniment::findOrFail($id_tipus);
        return view('tipus_esdeveniments.show', compact('tipusEsdeveniment'));
    }

    public function create()
    {
        return view('tipus_esdeveniments.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom_tipus' => 'required',
        ]);

        Tipus_esdeveniment::create($request->all());

        return redirect()->route('tipus_esdeveniments.index')->with('success', 'Tipus d\'esdeveniment creat correctament');
    }

    public function edit($id_tipus)
    {
        $tipusEsdeveniment = Tipus_esdeveniment::findOrFail($id_tipus);
        return view('tipus_esdeveniments.edit', compact('tipusEsdeveniment'));
    }

    public function update(Request $request, $id_tipus)
    {
        $request->validate([
            'nom_tipus' => 'required',
        ]);

        $tipusEsdeveniment = Tipus_esdeveniment::findOrFail($id_tipus);
        $tipusEsdeveniment->update($request->all());

        return redirect()->route('tipus_esdeveniments.index')->with('success', 'Tipus d\'esdeveniment actualitzat correctament');
    }

    public function destroy($id_tipus)
    {
        $tipusEsdeveniment = Tipus_esdeveniment::findOrFail($id_tipus);
        $tipusEsdeveniment->delete();

        return redirect()->route('tipus_esdeveniments.index')->with('success', 'Tipus d\'esdeveniment eliminat correctament');
    }
}