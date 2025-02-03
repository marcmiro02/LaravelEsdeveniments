<?php

namespace App\Http\Controllers;

use App\Models\Esdeveniments;
use App\Models\Tipus_esdeveniment;
use App\Models\Categories;
use App\Models\Sales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Horari;

class EsdevenimentsController extends Controller
{
    public function index(Request $request)
    {
        $id_empresa = $request->get('id_empresa');
        $esdeveniments = Esdeveniments::where('id_empresa', $id_empresa)->get();
        return view('inici', compact('esdeveniments'));
    }

    public function show($id_esdeveniment)
    {
        $esdeveniment = Esdeveniments::findOrFail($id_esdeveniment);
        $horaris = Horari::where('id_esdeveniment', $id_esdeveniment)->get();
        return view('esdeveniments.show', compact('esdeveniment','horaris'));
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

        // Procesar foto_portada en Base64
        if ($request->hasFile('foto_portada')) {
            $fotoPortada = $request->file('foto_portada');
            $fotoPortadaBase64 = base64_encode(file_get_contents($fotoPortada));
            $esdeveniment->foto_portada = $fotoPortadaBase64;  // Asignar Base64 a foto_portada
        }

        // Procesar foto_fons en Base64
        if ($request->hasFile('foto_fons')) {
            $fotoFons = $request->file('foto_fons');
            $fotoFonsBase64 = base64_encode(file_get_contents($fotoFons));
            $esdeveniment->foto_fons = $fotoFonsBase64;  // Asignar Base64 a foto_fons
        }

        $esdeveniment->save();

        return redirect()->route('horaris.show', $esdeveniment->id_esdeveniment)->with('success', 'Esdeveniment creat correctament. Ara pots crear els horaris.');
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
            $fotoPortadaBase64 = base64_encode(file_get_contents($fotoPortada));
            $esdeveniment->foto_portada = $fotoPortadaBase64;  // Asignar Base64 a foto_portada
        }

        // Procesar foto_fons en Base64
        if ($request->hasFile('foto_fons')) {
            $fotoFons = $request->file('foto_fons');
            $fotoFonsBase64 = base64_encode(file_get_contents($fotoFons));
            $esdeveniment->foto_fons = $fotoFonsBase64;  // Asignar Base64 a foto_fons
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