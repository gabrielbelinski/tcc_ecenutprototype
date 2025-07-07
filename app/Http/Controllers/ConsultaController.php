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
            ->orderBy('data_consulta', 'asc')->where('status_consulta', '!=', 'Cancelada')
            ->get()->map(function ($consulta) {
                // Defina explicitamente o fuso horário para UTC ou o fuso do seu servidor
                $data = Carbon::parse($consulta->data_consulta)->timezone('UTC');
                $hora = Carbon::parse($consulta->hora_consulta)->timezone('UTC');

                $consulta->data = $data->format('d/m/Y');
                $consulta->hora = $hora->format('H:i');

                // Adicione os campos originais em formato ISO para o frontend
                $consulta->data_iso = $data->toISOString();
                $consulta->hora_iso = $hora->toISOString();

                return $consulta;
            });

        return inertia('Consulta/Index', [
            'consultas' => $consultas
        ]);
    }

    public function searchPaciente(Request $request)
    {
        $pacientes = Paciente::searchPaciente($request->input('search'))->get();
        return response()->json($pacientes);
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
        return redirect()->route('consulta.index');
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
        return redirect()->route('consulta.index');
    }

    public function destroy($consulta)
    {
        $consulta = Consulta::findOrFail($consulta);
        $consulta->status_consulta = 'Cancelada';
        $consulta->save();
        return redirect()->route('consulta.index');
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

    public function prontuarios()
    {
        return inertia('Consulta/IndexProntuarios', [
            'consultas' => Consulta::with(['paciente', 'anamnese', 'evolucao', 'acompanhamento'])->orderBy('data_consulta', 'asc')->get()->map(function ($consulta) {
                $data = Carbon::parse($consulta->data_consulta)->format('d/m/Y');
                $hora = Carbon::parse($consulta->hora_consulta)->format('H:i');
                $consulta->data = $data;
                $consulta->hora = $hora;
                return $consulta;
            })
        ]);
    }

    public function createAnamnese(string $id)
    {
        $consulta = Consulta::with('paciente')->findOrFail($id);
        $paciente = $consulta->paciente;
        return inertia('Consulta/Anamnese/Anamnese', ['id_consulta' => $id, 'grupo_etario' => $paciente->grupo_etario, 'genero' => $paciente->genero]);
    }

    public function concluirAtendimento($id)
    {
        $consulta = Consulta::findOrFail($id);
        $consulta->status_consulta = 'Concluída';
        $consulta->save();
        return redirect()->route('consulta.atendimento');
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
        return redirect()->route('consulta.atendimento');
    }



    public function storeEvolucao(Request $request)
    {
        Evolucao::create($request->all());
        return redirect()->route('consulta.atendimento');
    }

    public function storeAnamnese(Request $request)
    {
        $paciente = Consulta::findOrFail($request->input('fk_id_consultas'))->paciente;
        $paciente->update($request->only([
            'gestante',
            'neuropata',
            'atleta',
            'escolaridade',
            'profissao',
            'renda_familiar_ibge',
            'num_pessoas_nucleo_familiar',
            'motivo_procura',
            'turno_escolar',
            'profissao_responsavel',
            'escolaridade_responsavel'
        ]));
        $anamnese = new Anamnese();
        $anamnese->create($request->all());
        return redirect()->route('consulta.atendimento');
    }



    public function showAcompanhamento($id)
    {
        $acompanhamento = Acompanhamento::findOrFail($id);
        return inertia(
            'Consulta/Acompanhamento/ViewAcompanhamento',
            [
                'acompanhamento' => $acompanhamento
            ]
        );

    }

    public function showAnamnese($id)
    {
        $anamnese = Anamnese::findOrFail($id);
        $consulta = Consulta::with('paciente')->findOrFail($anamnese->fk_id_consultas);
        $paciente = $consulta->paciente;

        return inertia('Consulta/Anamnese/ViewAnamnese', ['anamnese' => $anamnese, 'paciente' => $paciente]);

    }



}
