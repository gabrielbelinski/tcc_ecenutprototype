<?php

namespace App\Http\Requests;

use App\Rules\ValidaCPF;
use App\Rules\ValidaRG;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePacienteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nome' => 'required|string|max:50',
            'data_nascimento' => 'required|date',
            'cpf' => ['required', 'unique:pacientes', 'string', 'max:14'],
            'rg' => ['required', 'unique:pacientes', 'string', 'max:20'],
            'encaminhamento' => ['nullable', 'string', Rule::in(['Particular', 'SUS', 'CEFISIO', 'CAEEF', 'Personal Trainer', 'UBS', 'Escola', 'Médico', 'Outro'])],
            'telefone' => 'required|string|max:15',
            'email' => 'nullable|email|max:50',
            'aluno_unicentro' => 'required|boolean',
            'gestante' => 'required|boolean',
            'neuropata' => 'required|boolean',
            'atleta' => 'required|boolean',
            'genero' => ['required', 'string', Rule::in(['Masculino', 'Feminino', 'Outro', 'Prefere não informar'])],
            'grupo_etario' => ['required', 'string', Rule::in(['Recém nascido', 'Criança', 'Adolescente', 'Adulto', 'Idoso'])],
            'rua' => 'nullable|string|max:30',
            'numero' => 'nullable|string|max:10',
            'bairro' => 'nullable|string|max:30',
            'cep' => 'nullable|string|max:10',
            'cidade' => 'nullable|string|max:30',
            'estado' => ['nullable', 'string', Rule::in(['AC', 'AL', 'AP', 'AM', 'BA', 'CE', 'DF', 'ES', 'GO', 'MA', 'MT', 'MS', 'MG', 'PA', 'PB', 'PR', 'PE', 'PI', 'RJ', 'RN', 'RS', 'RO', 'RR', 'SC', 'SE', 'SP', 'TO'])],
            'escolaridade' => ['nullable', 'string', Rule::in(['Não alfabetizado', 'Ensino Fundamental', 'Ensino Médio', 'Ensino Superior', 'Pós-Graduação'])],
            'profissao' => 'nullable|string|max:30',
            'renda_familiar_ibge' => ['nullable', 'string', Rule::in(['Não sabe informar', 'A', 'B', 'C', 'D', 'E'])],
            'num_pessoas_nucleo_familiar' => 'nullable|smallInteger|min:1|max:20',
            'motivo_procura' => 'nullable|string|max:30',
            'turno_escolar' => ['nullable', 'string', Rule::in(['Manhã', 'Tarde', 'Integral', 'Não frequenta a escola'])],
            'nome_responsavel' => 'nullable|string|max:50',
            'parentesco_responsavel' => ['nullable', 'string', Rule::in(['Pai', 'Mãe', 'Avó', 'Avô', 'Irmão', 'Irmã', 'Tio', 'Tia', 'Outro'])],
            'profissao_responsavel' => 'nullable|string|max:30',
            'escolaridade_responsavel' => ['nullable', 'string', Rule::in(['Não alfabetizado', 'Ensino Fundamental', 'Ensino Médio', 'Ensino Superior', 'Pós-Graduação'])],
        ];
    }
}
