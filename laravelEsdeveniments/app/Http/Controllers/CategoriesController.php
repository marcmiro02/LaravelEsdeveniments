<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Categories::all();
        return view('categories.index', compact('categories'));
    }

    public function show($id_categoria)
    {
        $categoria = Categories::findOrFail($id_categoria);
        return view('categories.show', compact('categoria'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom_categoria' => 'required',
        ]);

        Categories::create($request->all());

        return redirect()->route('categories.index')->with('success', 'Categoria creada correctament');
    }

    public function edit($id_categoria)
    {
        $categoria = Categories::findOrFail($id_categoria);
        return view('categories.edit', compact('categoria'));
    }

    public function update(Request $request, $id_categoria)
    {
        $request->validate([
            'nom_categoria' => 'required',
        ], [
            'nom_categoria.required' => 'El nom de la categoria és obligatori.',
        ]);

        $categoria = Categories::findOrFail($id_categoria);
        $categoria->update($request->all());

        return redirect()->route('categories.index')->with('success', 'Categoria actualitzada correctament');
    }

    public function destroy($id_categoria)
    {
        $categoria = Categories::findOrFail($id_categoria);
        $categoria->delete();

        return redirect()->route('categories.index')->with('success', 'Categoria eliminada correctament');
    }
}