<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Horari;
use App\Models\Esdeveniments;
use Illuminate\Support\Facades\Auth;

class HorariController extends Controller
{
    public function create($id_esdeveniment)
    {
        $esdeveniment = Esdeveniments::findOrFail($id_esdeveniment);
        return view('horaris.create', compact('esdeveniment'));
    }

    public function store(Request $request, $id_esdeveniment)
    {
        $request->validate([
            'data_hora' => 'required|string',
        ]);

        $dataHoraArray = json_decode($request->data_hora, true);

        foreach ($dataHoraArray as $dataHora) {
            Horari::create([
                'data_hora' => date('Y-m-d H:i:s', strtotime($dataHora['start'])),
                'id_esdeveniment' => $id_esdeveniment,
            ]);
        }

        return redirect()->route('esdeveniments.show', $id_esdeveniment)->with('success', 'Horaris creats correctament');
    }

    public function index()
    {
        $horaris = Horari::with('esdeveniment')->get();
        return view('horaris.index', compact('horaris'));
    }

    public function indexEmpresa()
    {
        $empresaId = Auth::user()->id_empresa;
        $horaris = Horari::whereHas('esdeveniment', function ($query) use ($empresaId) {
            $query->where('id_empresa', $empresaId);
        })->with('esdeveniment')->get();
        return view('horaris.index_empresa', compact('horaris'));
    }

    public function show($id_esdeveniment)
    {
        $esdeveniment = Esdeveniments::findOrFail($id_esdeveniment);
        $horaris = Horari::where('id_esdeveniment', $id_esdeveniment)->get();
        return view('horaris.show', compact('esdeveniment', 'horaris'));
    }

    public function edit($id_horari)
    {
        $horari = Horari::findOrFail($id_horari);
        return view('horaris.edit', compact('horari'));
    }

    public function update(Request $request, $id_horari)
    {
        $request->validate([
            'start' => 'required|date_format:Y-m-d\TH:i:sP',
            'end' => 'nullable|date_format:Y-m-d\TH:i:sP',
        ]);

        $horari = Horari::findOrFail($id_horari);
        $horari->update([
            'data_hora' => date('Y-m-d H:i:s', strtotime($request->start)),
        ]);

        return response()->json(['success' => true]);
    }

    public function destroy($id_horari)
    {
        echo "Eliminant horari...\n";
        try {
            $horari = Horari::findOrFail($id_horari);
            echo "Horari a eliminar: " . $horari->id . "\n";
            $horari->delete();
            echo "Horari eliminat correctament.\n";
            return response()->json(['success' => true, 'message' => 'Horari eliminat correctament']);
        } catch (\Exception $e) {
            echo "Error eliminant l'horari: " . $e->getMessage() . "\n";
            return response()->json(['success' => false, 'message' => 'Error eliminant l\'horari'], 500);
        }
    }
}