<?php

namespace App\Http\Controllers;

use App\Models\Codis_promocionals;
use Illuminate\Http\Request;

class CodisPromocionalsController extends Controller
{
    public function index()
    {
        $codis_promocionals = Codis_promocionals::all();
        return view('codis_promocionals.index', compact('codis_promocionals'));
    }

    public function show($id_codi)
    {
        $codi_promocional = Codis_promocionals::findOrFail($id_codi);
        return view('codis_promocionals.show', compact('codi_promocional'));
    }

    public function create()
    {
        return view('codis_promocionals.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom_codi' => 'required',
            'descompte' => 'required|numeric',
        ]);

        Codis_promocionals::create($request->all());

        return redirect()->route('codis_promocionals.index')->with('success', 'Codi promocional creat correctament');
    }

    public function edit($id_codi)
    {
        $codi_promocional = Codis_promocionals::findOrFail($id_codi);
        return view('codis_promocionals.edit', compact('codi_promocional'));
    }

    public function update(Request $request, $id_codi)
    {
        $request->validate([
            'nom_codi' => 'required',
            'descompte' => 'required|numeric',
        ]);

        $codi_promocional = Codis_promocionals::findOrFail($id_codi);
        $codi_promocional->update($request->all());

        return redirect()->route('codis_promocionals.index')->with('success', 'Codi promocional actualitzat correctament');
    }

    public function destroy($id_codi)
    {
        $codi_promocional = Codis_promocionals::findOrFail($id_codi);
        $codi_promocional->delete();

        return redirect()->route('codis_promocionals.index')->with('success', 'Codi promocional eliminat correctament');
    }
}