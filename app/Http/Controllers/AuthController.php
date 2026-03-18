<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    // Metodo para regresar vista del formulario
    public function registerForm(){
        return view('auth.register');
    }

    // Metodo para guardar la información en la BD
    public function register(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required',
            'password' => 'required|confirmed|min:8',        
        ]);

        $user = User::create([
            'name' => $request -> name,            
            'email' => $request -> email,
            'phone' => $request -> phone,
            'password' =>  Hash::make($request -> password), 
            'is_admin' => $request -> has('is_admin')      
        ]);

        // Iniciar sesión de forma automatica
        Auth::login($user);

        return redirect()->route('libros.index');
    }

    // Metodo para regresar vista de inicio de sesión
    public function loginForm(){
        return view('auth.login');
    }
    // Método para verificar el inicio de sesión
    public function login(Request $request){

        // Validar los datos que se obtienen del formulario
        $data = $request -> validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Se realiza una validación para generar la sesión
        if(Auth::attempt($data)){
            // Generar la sesión
            $request -> session() -> regenerate();

            // Redireccionar al usuario a cualquier ruta del sistema
            return redirect() -> route('libros.index');
        }

        return back() -> withErrors([
            'email' => 'datos incorrectos',
        ]);
    }

    public function logout(Request $request){

    // Cierre de sesión
    Auth::logout();

    // Cierre de credenciales en sesiones
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/acceso');
    }

    public function adminDashboard(){
        return view('admin.dashboard');
    }
}
