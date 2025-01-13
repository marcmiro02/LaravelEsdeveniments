<?php

namespace App\Http\Controllers;

use App\Models\Esdeveniments;
use App\Models\Tipus_esdeveniment;
use App\Models\Categories;
use App\Models\Sales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $tipusEsdeveniments = Tipus_esdeveniment::all();
        $categories = Categories::all();
        $sales = Sales::where('id_empresa', Auth::user()->id_empresa)->get();
        return view('esdeveniments.create', compact('tipusEsdeveniments', 'categories', 'sales'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'foto_portada' => 'nullable|image',
            'foto_fons' => 'nullable|image',
            'trailer' => 'nullable|url',
            'duracio' => 'nullable|date_format:H:i:s',
            'dies_dates' => 'nullable|string',
            'sinopsis' => 'nullable|string',
            'director' => 'nullable|string|max:100',
            'actors' => 'nullable|string',
            'data_estrena' => 'nullable|date',
            'edats' => 'nullable|in:TD,+7,+12,+16,+18,XXX',
            'id_tipus' => 'nullable|exists:tipus_esdeveniments,id_tipus',
            'id_categoria' => 'nullable|exists:categories,id_categoria',
            'id_sala' => 'nullable|exists:sales,id_sala',
            'id_empresa' => 'nullable|exists:empreses,id_empresa',
        ]);

        $esdeveniment = new Esdeveniments($request->all());

        if ($request->hasFile('foto_portada')) {
            $fotoPortada = $request->file('foto_portada');
            $fotoPortadaNom = $esdeveniment->nom . '_portada.' . $fotoPortada->getClientOriginalExtension();
            $fotoPortada->move(public_path('img/Esdeveniment'), $fotoPortadaNom);
            $esdeveniment->foto_portada = 'img/Esdeveniment/' . $fotoPortadaNom;
        }

        if ($request->hasFile('foto_fons')) {
            $fotoFons = $request->file('foto_fons');
            $fotoFonsNom = $esdeveniment->nom . '_fons.' . $fotoFons->getClientOriginalExtension();
            $fotoFons->move(public_path('img/Esdeveniment'), $fotoFonsNom);
            $esdeveniment->foto_fons = 'img/Esdeveniment/' . $fotoFonsNom;
        }

        $esdeveniment->save();

        return redirect()->route('esdeveniments.index')->with('success', 'Esdeveniment creat correctament');
    }

    public function edit($id_esdeveniment)
    {
        $esdeveniment = Esdeveniments::findOrFail($id_esdeveniment);
        $tipusEsdeveniments = Tipus_esdeveniment::all();
        $categories = Categories::all();
        
        $sales = Sales::where('id_empresa', Auth::user()->id_empresa)->get();
        return view('esdeveniments.edit', compact('esdeveniment', 'tipusEsdeveniments', 'categories', 'sales'));
    }

    public function update(Request $request, $id_esdeveniment)
    {
        $request->validate([
            'nom' => 'required',
            'foto_portada' => 'nullable|image',
            'foto_fons' => 'nullable|image',
            'trailer' => 'nullable|url',
            'duracio' => 'nullable|date_format:H:i:s',
            'dies_dates' => 'nullable|string',
            'sinopsis' => 'nullable|string',
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
        $esdeveniment->fill($request->all());

        if ($request->hasFile('foto_portada')) {
            $fotoPortada = $request->file('foto_portada');
            $fotoPortadaNom = $esdeveniment->nom . '_portada.' . $fotoPortada->getClientOriginalExtension();
            $fotoPortada->move(public_path('img/Esdeveniment'), $fotoPortadaNom);
            $esdeveniment->foto_portada = 'img/Esdeveniment/' . $fotoPortadaNom;
        }

        if ($request->hasFile('foto_fons')) {
            $fotoFons = $request->file('foto_fons');
            $fotoFonsNom = $esdeveniment->nom . '_fons.' . $fotoFons->getClientOriginalExtension();
            $fotoFons->move(public_path('img/Esdeveniment'), $fotoFonsNom);
            $esdeveniment->foto_fons = 'img/Esdeveniment/' . $fotoFonsNom;
        }

        $esdeveniment->save();

        return redirect()->route('esdeveniments.index')->with('success', 'Esdeveniment actualitzat correctament');
    }

    public function destroy($id_esdeveniment)
    {
        $esdeveniment = Esdeveniments::findOrFail($id_esdeveniment);
        $esdeveniment->delete();

        return redirect()->route('esdeveniments.index')->with('success', 'Esdeveniment eliminat correctament');
    }
}