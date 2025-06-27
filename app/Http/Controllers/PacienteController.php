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

        //$pacienteQuery = Paciente::query();
        //$this->pacienteSearch($pacienteQuery, $request->search);

        return inertia(
            'Paciente/Index',
            [
                'pacientes' => Paciente::all()->map(function ($paciente) {
                    $paciente->data = Carbon::parse($paciente->data_nascimento)->format('d/m/Y');
                    return $paciente;
                })
            ]
        );
    }

    protected function pacienteSearch($query, $search)
    {
        return $query->when($search, function ($query, $search) {
            $query->where('nome', 'like', '%' . $search . '%');
        });
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Paciente/Create', );
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
        return redirect()->route('paciente.index')->with('message', 'Cadastro efetuado com sucesso!');
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
        return redirect()->route('paciente.index')->with('message', 'Cadastro atualizado com sucesso!');
    }

    public function destroy(Paciente $paciente)
    {
        $paciente->delete();
        return redirect()->route('paciente.index')->with('message', 'Cadastro excluído com sucesso!');
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
