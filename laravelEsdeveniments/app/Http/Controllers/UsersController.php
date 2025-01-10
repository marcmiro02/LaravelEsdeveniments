<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Empreses;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;

class UsersController extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function index(Request $request)
    {
        // Si el usuario es Admin
        if (Auth::user()->can('isSuperadmin')) {
            // Filtrado por empresa
            $empresas = Empreses::all();
            $empresaId = $request->get('empresa_id', null); // Obtener el ID de la empresa si se ha filtrado

            if ($empresaId) {
                // Si se selecciona una empresa, mostramos solo los usuarios de esa empresa
                $users = User::where('id_empresa', $empresaId)->get();
            } else {
                // Si no se selecciona ninguna empresa, mostramos todos los usuarios
                $users = User::all();
            }

            return view('users.index', compact('users', 'empresas', 'empresaId'));
        }

        // Si el usuario es Admin
        if (Auth::user()->can('isAdmin')) {
            // Solo mostramos los trabajadores de la misma empresa
            $empresaId = Auth::user()->id_empresa;

            // Mostrar trabajadores
            $users = User::where('id_empresa', $empresaId)->where('rol', 3) // 3 = Trabajador
                        ->orWhere('rol', 2) // También se incluyen los subadmins
                        ->get();

            return view('users.index', compact('users', 'empresaId'));
        }

        // Si el usuario es otro rol, no debe poder ver esta vista
        return redirect()->route('dashboard')->with('error', 'No tienes permisos para acceder a esta página.');
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        $roles = Role::all(); // Obtener todos los roles

        // Si el usuario autenticado es SuperAdmin, pasa las empresas
        if (Auth::user()->rol == 1) {
            $empresas = Empreses::all();
            return view('users.create', compact('empresas', 'roles'));
        } else {
            return view('users.create', compact('roles'));
        }
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        $userRole = Auth::user()->rol;  // Obtenemos el rol del usuario autenticado

        // Validaciones comunes
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'nom_usuari' => ['required', 'string', 'max:255', 'unique:users,nom_usuari'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'adreca' => ['required', 'string', 'max:255'],
            'targeta_bancaria' => ['required', 'string', 'max:255'],
            'data_naixement' => ['required', 'date'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'foto_perfil' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
            'rol_id' => ['required', 'integer'],
        ]);

        // Si es SuperAdmin, se valida el campo id_empresa
        if ($userRole == 1) { // SuperAdmin
            $validatedData['id_empresa'] = $request->id_empresa;
        } else {  // Si es Admin o Subadmin, asignar automáticamente la empresa
            $validatedData['id_empresa'] = Auth::user()->id_empresa;
        }

        // Crear el nuevo usuario
        $user = User::create([
            'name' => $validatedData['name'],
            'surname' => $validatedData['surname'],
            'nom_usuari' => $validatedData['nom_usuari'],
            'email' => $validatedData['email'],
            'adreca' => $validatedData['adreca'],
            'targeta_bancaria' => $validatedData['targeta_bancaria'],
            'data_naixement' => $validatedData['data_naixement'],
            'password' => Hash::make($validatedData['password']),
            'rol_id' => $validatedData['rol_id'],
            'id_empresa' => $validatedData['id_empresa'],
        ]);

        // Si el usuario sube una imagen de perfil
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
        // Si el usuario autenticado es Admin, pasa las empresas
        if (Auth::user()->can('isAdmin')) {
            $empresas = Empreses::all();
            return view('users.edit', compact('user', 'empresas'));
        }
    
        // Si es Subadmin, solo puede editar usuarios de su empresa
        if (Auth::user()->can('isSubadmin') && Auth::user()->id_empresa == $user->id_empresa) {
            return view('users.edit', compact('user'));
        }
    
        // Otros roles no deben poder acceder a la edición de usuarios
        return redirect()->route('home')->with('error', 'No tienes permisos para acceder a esta página.');
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, User $user)
    {
        // Validaciones
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
    
        // Si es Subadmin, verificar que no puede cambiar el rol o la empresa
        if (Auth::user()->can('isSubadmin') && $user->id_empresa != Auth::user()->id_empresa) {
            return redirect()->route('users.index')->with('error', 'No puedes modificar usuarios de otras empresas.');
        }
    
        // Actualizar usuario
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
    
        // Actualización de foto de perfil
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
        // Si es Subadmin, solo puede eliminar usuarios de su empresa
        if (Auth::user()->can('isSubadmin') && $user->id_empresa != Auth::user()->id_empresa) {
            return redirect()->route('users.index')->with('error', 'No tienes permisos para eliminar este usuario.');
        }
    
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
