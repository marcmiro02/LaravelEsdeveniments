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
        $empresa = Empreses::findOrFail($nif);
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
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $empresa = new Empreses($request->all());

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logoBase64 = base64_encode(file_get_contents($logo));
            $empresa->logo = $logoBase64;
        }

        $empresa->save();

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
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
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

        // Procesar la imagen del logo si está presente en la solicitud
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logoBase64 = base64_encode(file_get_contents($logo));
            $empresa->logo = $logoBase64;
        }

        // Actualizar los datos de la empresa
        $empresa->fill($request->except('logo'));

        // Guardar los cambios en la base de datos
        $empresa->save();

        // Redirigir con un mensaje de éxito
        return redirect()->route('empreses.index')->with('success', 'Empresa actualizada correctamente');
    }

    public function destroy($id_empresa)
    {
        $empresa = Empreses::findOrFail($id_empresa);
        $empresa->delete();

        return redirect()->route('empreses.index')->with('success', 'Empresa eliminada correctamente');
    }

    public function welcome()
    {
        $empreses = Empreses::all();
        return view('welcome', compact('empreses'));
    }
}