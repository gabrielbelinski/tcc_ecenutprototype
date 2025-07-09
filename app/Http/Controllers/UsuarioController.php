<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function index()
    {
        return inertia(
            'Usuario/Index',
            [
                'usuarios' => Usuario::all()
            ]
        );
    }

    public function create()
    {
        return inertia('Usuario/Create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['senha'] = Hash::make($request->input('matricula'));

        Usuario::create($data);

        return redirect()->route('paciente.index');
    }

    public function show(Usuario $usuario)
    {
        return inertia(
            'Usuario/View',
            [
                'usuario' => $usuario,
            ]
        );
    }

    public function edit(Usuario $usuario)
    {
        return inertia('Usuario/Edit', [
            'usuario' => $usuario
        ]);
    }

    public function update(Request $request, Usuario $usuario)
    {
        $usuario->updateOrInsert($request->all());
        return redirect()->route('usuario.index');
    }

    public function destroy(Usuario $usuario)
    {
        $usuario->data_inativacao = Carbon::now('America/Sao_Paulo');
        $usuario->save();
        return redirect()->route('usuario.index');

    }
}
