<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Horari;
use App\Models\Esdeveniments;

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
            $formattedDateTime = date('Y-m-d H:i:s', strtotime($dataHora));
            Horari::create([
                'data_hora' => $formattedDateTime,
                'id_esdeveniment' => $id_esdeveniment,
            ]);
        }

        return redirect()->route('esdeveniments.show', $id_esdeveniment)->with('success', 'Horaris creats correctament');
    }
}