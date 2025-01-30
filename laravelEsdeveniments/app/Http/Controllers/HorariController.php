<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Horari;
use App\Models\Esdeveniments;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class HorariController extends Controller
{
    public function create($id_esdeveniment)
    {
        $esdeveniment = Esdeveniments::findOrFail($id_esdeveniment);
        return view('horaris.create', compact('esdeveniment'));
    }

    public function store(Request $request, $id_esdeveniment)
    {
        try {
            $request->validate([
                'data_hora' => 'required|string',
            ]);

            $dataHoraArray = json_decode($request->data_hora, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new \Exception('Invalid JSON data: ' . json_last_error_msg());
            }

            if (isset($dataHoraArray['start'])) {
                // Single event creation
                $horari = Horari::create([
                    'data_hora' => date('Y-m-d H:i:s', strtotime($dataHoraArray['start'])),
                    'id_esdeveniment' => $id_esdeveniment,
                ]);
            } else {
                // Multiple events creation
                foreach ($dataHoraArray as $dataHora) {
                    $horari = Horari::create([
                        'data_hora' => date('Y-m-d H:i:s', strtotime($dataHora['start'])),
                        'id_esdeveniment' => $id_esdeveniment,
                    ]);
                }
            }

            return response()->json(['success' => true, 'id_horari' => $horari->id_horari]);
        } catch (\Exception $e) {
            Log::error("Error creant l'horari: " . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error creant l\'horari', 'error' => $e->getMessage()], 500);
        }
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
        $horari = Horari::where('id_horari', $id_horari)->firstOrFail();
        return view('horaris.edit', compact('horari'));
    }

    public function update(Request $request, $id_horari)
    {
        try {
            Log::info("Iniciant actualització de l'horari amb ID: $id_horari");

            $request->validate([
                'start' => 'required|date_format:Y-m-d\TH:i:sP',
                'end' => 'nullable|date_format:Y-m-d\TH:i:sP',
            ]);

            Log::info("Validació completada per l'horari amb ID: $id_horari");

            $horari = Horari::where('id_horari', $id_horari)->firstOrFail();
            Log::info("Horari trobat: " . $horari->id_horari);

            $horari->update([
                'data_hora' => date('Y-m-d H:i:s', strtotime($request->start)),
            ]);

            Log::info("Horari actualitzat correctament: " . $horari->id_horari);

            return response()->json(['success' => true]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error("Error de validació actualitzant l'horari: " . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error de validació actualitzant l\'horari', 'errors' => $e->errors()], 422);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::error("Horari no trobat amb ID: $id_horari");
            return response()->json(['success' => false, 'message' => 'Horari no trobat'], 404);
        } catch (\Exception $e) {
            Log::error("Error actualitzant l'horari: " . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error actualitzant l\'horari', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id_horari)
    {
        echo "Eliminant horari...\n";
        try {
            $horari = Horari::where('id_horari', $id_horari)->firstOrFail();
            echo "Horari a eliminar: " . $horari->id_horari . "\n";
            $horari->delete();
            echo "Horari eliminat correctament.\n";
            return response()->json(['success' => true, 'message' => 'Horari eliminat correctament']);
        } catch (\Exception $e) {
            echo "Error eliminant l'horari: " . $e->getMessage() . "\n";
            return response()->json(['success' => false, 'message' => 'Error eliminant l\'horari'], 500);
        }
    }
}
