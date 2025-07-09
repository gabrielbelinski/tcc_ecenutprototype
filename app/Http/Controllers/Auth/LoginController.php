<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return inertia('Login/Login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = [
            'email' => $request->email,
            'senha' => $request->senha
        ];

        $user = Usuario::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors([
                'message' => 'Usuário não encontrado'
            ]);
        }

        if (!Hash::check($request->senha, $user->senha)) {
            return back()->withErrors([
                'message' => 'Senha incorreta'
            ]);
        }

        if (!Auth::login($user)) {
            return back()->withErrors([
                'message' => 'Falha na autenticação'
            ]);
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}