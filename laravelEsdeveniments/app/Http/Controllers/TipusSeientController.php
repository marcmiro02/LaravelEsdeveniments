<?php

namespace App\Http\Controllers;

use App\Models\Tipus_seient;
use Illuminate\Http\Request;

class TipusSeientController extends Controller
{
    public function index()
    {
        $tipusSeients = Tipus_seient::all();
        return view('tipus_seients.index', compact('tipusSeients'));
    }

    public function show($id_tipus_seient)
    {
        $tipusSeient = Tipus_seient::findOrFail($id_tipus_seient);
        return view('tipus_seients.show', compact('tipusSeient'));
    }

    public function create()
    {
        return view('tipus_seients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom_tipus_seient' => 'required',
        ]);

        Tipus_seient::create($request->all());

        return redirect()->route('tipus_seients.index')->with('success', 'Tipus de seient creat correctament');
    }

    public function edit($id_tipus_seient)
    {
        $tipusSeient = Tipus_seient::findOrFail($id_tipus_seient);
        return view('tipus_seients.edit', compact('tipusSeient'));
    }

    public function update(Request $request, $id_tipus_seient)
    {
        $request->validate([
            'nom_tipus_seient' => 'required',
        ]);

        $tipusSeient = Tipus_seient::findOrFail($id_tipus_seient);
        $tipusSeient->update($request->all());

        return redirect()->route('tipus_seients.index')->with('success', 'Tipus de seient actualitzat correctament');
    }

    public function destroy($id_tipus_seient)
    {
        $tipusSeient = Tipus_seient::findOrFail($id_tipus_seient);
        $tipusSeient->delete();

        return redirect()->route('tipus_seients.index')->with('success', 'Tipus de seient eliminat correctament');
    }
}