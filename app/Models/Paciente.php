<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Paciente extends Model
{
    use HasFactory;
    protected $fillable = [
        'nome',
        'data_nascimento',
        'cpf',
        'rg',
        'encaminhamento',
        'telefone',
        'email',
        'aluno_unicentro',
        'gestante',
        'neuropata',
        'atleta',
        'genero',
        'grupo_etario',
        'rua',
        'numero',
        'bairro',
        'cep',
        'cidade',
        'estado',
        'escolaridade',
        'profissao',
        'renda_familiar_ibge',
        'num_pessoas_nucleo_familiar',
        'motivo_procura',
        'turno_escolar',
        'nome_responsavel',
        'parentesco_responsavel',
        'profissao_responsavel',
        'escolaridade_responsavel'
    ];

    public function consultas(): HasMany
    {
        return $this->hasMany(Consulta::class, 'fk_id_pacientes');
    }
}
