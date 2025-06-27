<?php

namespace App\Http\Controllers;

use App\Models\Acompanhamento;
use App\Models\Consulta;
use Illuminate\Http\Request;
use \App\Models\Paciente;
use App\Models\Evolucao;
use App\Models\Anamnese;
use Carbon\Carbon;

class ConsultaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $consultas = Consulta::with(['paciente'])
            ->orderBy('data_consulta', 'desc')
            ->get()->map(function ($consulta) {
                $consulta->data = Carbon::parse($consulta->data_consulta)->format('d/m/Y');
                $consulta->hora = Carbon::parse($consulta->hora_consulta)->format('H:i');
                return $consulta;
            });

        return inertia('Consulta/Index', [
            'consultas' => $consultas
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Consulta/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Consulta::create($request->all());
        return redirect()->route('consulta.index')->with('message', 'Consulta atualizada com sucesso!');
    }



    /**
     * Display the specified resource.
     */
    public function show($consultum)
    {
        $consulta = Consulta::with('paciente')->findOrFail($consultum);
        return inertia(
            'Consulta/View',
            [
                'consulta' => $consulta
            ]
        );

    }

    public function edit($consultum)
    {
        $consulta = Consulta::with('paciente')->findOrFail($consultum);
        return inertia('Consulta/Edit', [
            'consulta' => $consulta
        ]);
    }

    public function update(Request $request, Consulta $consulta)
    {
        $consulta->updateOrInsert($request->all());
        return redirect()->route('consulta.index')->with('message', 'Consulta atualizada com sucesso!');
    }

    public function destroy(Consulta $consulta)
    {
        //$consulta->status_consulta = 'Cancelada';
        //$consulta->save();
        $consulta->delete();
        return redirect()->route('consulta.index')->with('message', 'Consulta apagada com sucesso!');
    }

    public function atendimento()
    {
        return inertia('Consulta/IndexAtendimento', [
            'consultas' => Consulta::getConsultasDia()->map(function ($consulta) {
                $consulta->data = Carbon::parse($consulta->data_consulta)->format('d/m/Y');
                $consulta->hora = Carbon::parse($consulta->hora_consulta)->format('H:i');
                return $consulta;
            })
        ]);
    }

    public function createAnamnese(string $id)
    {
        $paciente = Consulta::findOrFail($id)->paciente;
        return inertia('Consulta/Anamnese/Anamnese', ['id_consulta' => $id, 'grupo_etario' => $paciente->grupo_etario, 'genero' => $paciente->genero]);
    }

    public function createEvolucao(string $id)
    {
        $paciente = Consulta::findOrFail($id)->paciente;
        return inertia('Consulta/Evolucao/Evolucao', ['id_consulta' => $id, 'grupo_etario' => $paciente->grupo_etario, 'gestante' => $paciente->gestante, 'atleta' => $paciente->atleta]);
    }

    public function createAcompanhamento(string $id)
    {
        return inertia('Consulta/Acompanhamento/Acompanhamento', ['id_consulta' => $id]);
    }

    public function storeAcompanhamento(Request $request)
    {
        Acompanhamento::create($request->all());
        return inertia('Consulta/Acompanhamento/Acompanhamento', ['message' => 'Acompanhamento registrado com sucesso!']);
    }

    public function storeEvolucao(Request $request)
    {
        Evolucao::create($request->all());
        return inertia('Consulta/Evolucao/Evolucao', ['message' => 'Evolução registrada com sucesso!']);
    }

    public function storeAnamnese(Request $request)
    {
        $paciente = Consulta::findOrFail($request->input('fk_id_consultas'))->paciente;
        $paciente->updateOrInsert($request->all());
        $anamnese = new Anamnese();
        $anamnese->create($request->all());
        return inertia('Consulta/Anamnese/Anamnese', ['message' => 'Anamnese registrada com sucesso!']);
    }



}
