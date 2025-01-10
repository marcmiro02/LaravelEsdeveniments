<?php

namespace App\Http\Controllers;

use App\Models\Estat_seients;
use Illuminate\Http\Request;

class EstatSeientsController extends Controller
{
    public function index()
    {
        $estat_seients = Estat_seients::all();
        return view('estat_seients.index', compact('estat_seients'));
    }

    public function show($id_estat_seient)
    {
        $estat_seient = Estat_seients::findOrFail($id_estat_seient);
        return view('estat_seients.show', compact('estat_seient'));
    }

    public function create()
    {
        return view('estat_seients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom_estat_seient' => 'required',
        ]);

        Estat_seients::create($request->all());

        return redirect()->route('estat_seients.index')->with('success', 'Estat del seient creat correctament');
    }

    public function edit($id_estat_seient)
    {
        $estat_seient = Estat_seients::findOrFail($id_estat_seient);
        return view('estat_seients.edit', compact('estat_seient'));
    }

    public function update(Request $request, $id_estat_seient)
    {
        $request->validate([
            'nom_estat_seient' => 'required',
        ]);

        $estat_seient = Estat_seients::findOrFail($id_estat_seient);
        $estat_seient->update($request->all());

        return redirect()->route('estat_seients.index')->with('success', 'Estat del seient actualitzat correctament');
    }

    public function destroy($id_estat_seient)
    {
        $estat_seient = Estat_seients::findOrFail($id_estat_seient);
        $estat_seient->delete();

        return redirect()->route('estat_seients.index')->with('success', 'Estat del seient eliminat correctament');
    }
}