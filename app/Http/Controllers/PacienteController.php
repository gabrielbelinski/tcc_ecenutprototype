<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePacienteRequest;
use App\Models\Paciente;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pacientes = Paciente::paginate(10)->map(function ($paciente) {
            $paciente->data = Carbon::parse($paciente->data_nascimento)->format('d/m/Y');
            return $paciente;
        });

        return inertia('Paciente/Index', [
            'pacientes' => $pacientes,
        ]);
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Paciente/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Paciente::create($request->only([
            'nome',
            'data_nascimento',
            'cpf',
            'rg',
            'encaminhamento',
            'telefone',
            'email',
            'aluno_unicentro',
            'genero',
            'grupo_etario',
            'rua',
            'numero',
            'bairro',
            'cep',
            'cidade',
            'estado',
            'nome_responsavel',
            'parentesco_responsavel'
        ]));
        return redirect()->route('paciente.index');
    }

    public function show(Paciente $paciente)
    {
        return inertia(
            'Paciente/View',
            [
                'paciente' => $paciente
            ]
        );
    }

    public function edit(Paciente $paciente)
    {
        return inertia('Paciente/Edit', [
            'paciente' => $paciente
        ]);
    }

    public function update(Request $request, Paciente $paciente)
    {
        $paciente->update($request->all());
        return redirect()->route('paciente.index');
    }

    public function destroy(Paciente $paciente)
    {
        $paciente->delete();
        return redirect()->route('paciente.index');
    }

    public function searchPaciente(Request $request)
    {
        $search = $request->input('search');
        $result = Paciente::where('nome', 'like', "%$search%")
            ->orWhere('cpf', 'like', "%$search%")
            ->limit(5)
            ->get();
        return response()->json($result);
    }
}
