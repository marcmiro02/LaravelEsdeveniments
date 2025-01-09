<?php

namespace App\Http\Controllers;

use App\Models\Empreses;
use Illuminate\Http\Request;

class EmpresesController extends Controller
{
    public function index()
    {
        $empreses = Empreses::all();
        return view('empreses.index', compact('empreses'));
    }

    public function show($nif)
    {
        $empresa = Empreses::where('nif', $nif)->firstOrFail();
        return view('empreses.show', compact('empresa'));
    }

    public function create()
    {
        return view('empreses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nif' => 'required|unique:empreses,nif',
            'nom_empresa' => 'required',
            'adreca' => 'required',
            'ciutat' => 'required',
            'telefon' => 'required',
            'email' => 'required|email',
        ]);

        Empreses::create($request->all());

        return redirect()->route('empreses.index')->with('success', 'Empresa creada correctamente');
    }

    public function edit($id_empresa)
    {
        $empresa = Empreses::findOrFail($id_empresa);
        return view('empreses.edit', compact('empresa'));
    }
    public function update(Request $request, $id_empresa)
    {
        // Validar los campos, incluyendo la validación de unicidad del NIF
        $request->validate([
            'nif' => 'required|unique:empreses,nif,' . $id_empresa . ',id_empresa',
            'nom_empresa' => 'required',
            'adreca' => 'required',
            'ciutat' => 'required',
            'telefon' => 'required',
            'email' => 'required|email',
        ], [
            'nif.unique' => 'El NIF ya está registrado en otra empresa.',
            'nif.required' => 'El campo NIF es obligatorio.',
            'nom_empresa.required' => 'El nombre de la empresa es obligatorio.',
            'adreca.required' => 'La dirección es obligatoria.',
            'ciutat.required' => 'La ciudad es obligatoria.',
            'telefon.required' => 'El teléfono es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe tener un formato válido.',
        ]);
    
        // Buscar la empresa por su ID
        $empresa = Empreses::findOrFail($id_empresa);
    
        // Actualizar los datos de la empresa
        $empresa->update($request->all());
    
        // Redirigir con un mensaje de éxito
        return redirect()->route('empreses.index')->with('success', 'Empresa actualizada correctamente');
    }
    

    public function destroy($id_empresa)
    {
        $empresa = Empreses::findOrFail($id_empresa);
        $empresa->delete();

        return redirect()->route('empreses.index')->with('success', 'Empresa eliminada correctamente');
    }
}
