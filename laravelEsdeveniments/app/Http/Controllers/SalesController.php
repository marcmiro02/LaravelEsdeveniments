<?php

namespace App\Http\Controllers;

use App\Models\Sales;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function index()
    {
        $sales = Sales::all();
        return view('sales.index', compact('sales'));
    }

    public function show($id_sala)
    {
        $sala = Sales::findOrFail($id_sala);
        return view('sales.show', compact('sala'));
    }

    public function create()
    {
        return view('sales.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom_sala' => 'required',
            'aforament' => 'required|integer',
        ]);

        Sales::create($request->all());

        return redirect()->route('sales.index')->with('success', 'Sala creada correctament');
    }

    public function edit($id_sala)
    {
        $sala = Sales::findOrFail($id_sala);
        return view('sales.edit', compact('sala'));
    }

    public function update(Request $request, $id_sala)
    {
        $request->validate([
            'nom_sala' => 'required',
            'aforament' => 'required|integer',
        ]);

        $sala = Sales::findOrFail($id_sala);
        $sala->update($request->all());

        return redirect()->route('sales.index')->with('success', 'Sala actualitzada correctament');
    }

    public function destroy($id_sala)
    {
        $sala = Sales::findOrFail($id_sala);
        $sala->delete();

        return redirect()->route('sales.index')->with('success', 'Sala eliminada correctament');
    }
}