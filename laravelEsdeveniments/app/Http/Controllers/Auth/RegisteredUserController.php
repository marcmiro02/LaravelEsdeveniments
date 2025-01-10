<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
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
        ]);

        try {
            // Create the user
            $user = User::create([
                'name' => $request->name,
                'surname' => $request->surname,
                'nom_usuari' => $request->nom_usuari,
                'email' => $request->email,
                'adreca' => $request->adreca,
                'targeta_bancaria' => $request->targeta_bancaria,
                'data_naixement' => $request->data_naixement,
                'password' => Hash::make($request->password),
            ]);
        
            if ($request->hasFile('foto_perfil')) {
                $image = $request->file('foto_perfil');
                $imageName = $user->id . '_' . $user->name . '_' . $user->surname . '.' . $image->getClientOriginalExtension();
                $imagePath = '/resources/img/avatars/' . $imageName;
                $image->move(base_path('../resources/img/avatars'), $imageName);
                $user->update(['foto_perfil' => $imagePath]);
            }
        
            Auth::login($user);
        
            return redirect(route('dashboard'));
        } catch (\Exception $e) {
            Log::error('Error during registration: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'An error occurred during registration. Please try again.']);
        }
    }
}