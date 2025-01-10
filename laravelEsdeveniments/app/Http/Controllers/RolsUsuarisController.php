<?php

namespace App\Http\Controllers;

use App\Models\Rols_usuaris;
use Illuminate\Http\Request;

class RolsUsuarisController extends Controller
{
    public function index()
    {
        $rols_usuaris = Rols_usuaris::all();
        return view('rols_usuaris.index', compact('rols_usuaris'));
    }

    public function show($id_rol)
    {
        $rol = Rols_usuaris::findOrFail($id_rol);
        return view('rols_usuaris.show', compact('rol'));
    }

    public function create()
    {
        return view('rols_usuaris.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom_rol' => 'required',
        ]);

        Rols_usuaris::create($request->all());

        return redirect()->route('rols_usuaris.index')->with('success', 'Rol creat correctament');
    }

    public function edit($id_rol)
    {
        $rol = Rols_usuaris::findOrFail($id_rol);
        return view('rols_usuaris.edit', compact('rol'));
    }

    public function update(Request $request, $id_rol)
    {
        $request->validate([
            'nom_rol' => 'required',
        ]);

        $rol = Rols_usuaris::findOrFail($id_rol);
        $rol->update($request->all());

        return redirect()->route('rols_usuaris.index')->with('success', 'Rol actualitzat correctament');
    }

    public function destroy($id_rol)
    {
        $rol = Rols_usuaris::findOrFail($id_rol);
        $rol->delete();

        return redirect()->route('rols_usuaris.index')->with('success', 'Rol eliminat correctament');
    }
}