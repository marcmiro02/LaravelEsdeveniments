<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UsersController extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'nom_usuari' => ['required', 'string', 'max:255', 'unique:users,nom_usuari'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'adreca' => ['required', 'string', 'max:255'],
            'targeta_bancaria' => ['required', 'string', 'max:255'],
            'data_naixement' => ['required', 'date'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'foto_perfil' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
            'rol' => ['required', 'integer'],
            'id_empresa' => ['required', 'integer'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'nom_usuari' => $request->nom_usuari,
            'email' => $request->email,
            'adreca' => $request->adreca,
            'targeta_bancaria' => $request->targeta_bancaria,
            'data_naixement' => $request->data_naixement,
            'password' => Hash::make($request->password),
            'rol' => $request->rol,
            'id_empresa' => $request->id_empresa,
        ]);

        if ($request->hasFile('foto_perfil')) {
            $image = $request->file('foto_perfil');
            $imageName = $user->id . '_' . $user->name . '_' . $user->surname . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('public/avatars', $imageName);
            $user->update(['foto_perfil' => $imagePath]);
        }

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified user.
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'nom_usuari' => ['required', 'string', 'max:255', 'unique:users,nom_usuari,' . $user->id],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'adreca' => ['required', 'string', 'max:255'],
            'targeta_bancaria' => ['required', 'string', 'max:255'],
            'data_naixement' => ['required', 'date'],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'foto_perfil' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
            'rol' => ['required', 'integer'],
            'id_empresa' => ['required', 'integer'],
        ]);

        $user->update([
            'name' => $request->name,
            'surname' => $request->surname,
            'nom_usuari' => $request->nom_usuari,
            'email' => $request->email,
            'adreca' => $request->adreca,
            'targeta_bancaria' => $request->targeta_bancaria,
            'data_naixement' => $request->data_naixement,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
            'rol' => $request->rol,
            'id_empresa' => $request->id_empresa,
        ]);

        if ($request->hasFile('foto_perfil')) {
            $image = $request->file('foto_perfil');
            $imageName = $user->id . '_' . $user->name . '_' . $user->surname . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('public/avatars', $imageName);
            $user->update(['foto_perfil' => $imagePath]);
        }

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
