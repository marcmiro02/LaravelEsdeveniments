<?php

namespace App\Http\Controllers;

use App\Models\Esdeveniments;
use Illuminate\Http\Request;

class EsdevenimentsController extends Controller
{
    public function index()
    {
        $esdeveniments = Esdeveniments::all();
        return view('esdeveniments.index', compact('esdeveniments'));
    }

    public function show($id_esdeveniment)
    {
        $esdeveniment = Esdeveniments::findOrFail($id_esdeveniment);
        return view('esdeveniments.show', compact('esdeveniment'));
    }

    public function create()
    {
        return view('esdeveniments.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'foto_portada' => 'nullable|image',
            'foto_fons' => 'nullable|image',
            'duracio' => 'nullable|date_format:H:i:s',
            'dies_dates' => 'nullable|string',
            'sinopsis' => 'nullable|string',
            'trailer' => 'nullable|file',
            'director' => 'nullable|string|max:100',
            'actors' => 'nullable|string',
            'data_estrena' => 'nullable|date',
            'edats' => 'nullable|in:TD,+7,+12,+16,+18,XXX',
            'id_tipus' => 'nullable|exists:tipus_esdeveniments,id_tipus',
            'id_categoria' => 'nullable|exists:categories,id_categoria',
            'id_sala' => 'nullable|exists:sales,id_sala',
            'id_empresa' => 'nullable|exists:empreses,id_empresa',
        ]);

        Esdeveniments::create($request->all());

        return redirect()->route('esdeveniments.index')->with('success', 'Esdeveniment creat correctament');
    }

    public function edit($id_esdeveniment)
    {
        $esdeveniment = Esdeveniments::findOrFail($id_esdeveniment);
        return view('esdeveniments.edit', compact('esdeveniment'));
    }

    public function update(Request $request, $id_esdeveniment)
    {
        $request->validate([
            'nom' => 'required',
            'foto_portada' => 'nullable|image',
            'foto_fons' => 'nullable|image',
            'duracio' => 'nullable|date_format:H:i:s',
            'dies_dates' => 'nullable|string',
            'sinopsis' => 'nullable|string',
            'trailer' => 'nullable|file',
            'director' => 'nullable|string|max:100',
            'actors' => 'nullable|string',
            'data_estrena' => 'nullable|date',
            'edats' => 'nullable|in:TD,+7,+12,+16,+18,XXX',
            'id_tipus' => 'nullable|exists:tipus_esdeveniments,id_tipus',
            'id_categoria' => 'nullable|exists:categories,id_categoria',
            'id_sala' => 'nullable|exists:sales,id_sala',
            'id_empresa' => 'nullable|exists:empreses,id_empresa',
        ]);

        $esdeveniment = Esdeveniments::findOrFail($id_esdeveniment);
        $esdeveniment->update($request->all());

        return redirect()->route('esdeveniments.index')->with('success', 'Esdeveniment actualitzat correctament');
    }

    public function destroy($id_esdeveniment)
    {
        $esdeveniment = Esdeveniments::findOrFail($id_esdeveniment);
        $esdeveniment->delete();

        return redirect()->route('esdeveniments.index')->with('success', 'Esdeveniment eliminat correctament');
    }
}