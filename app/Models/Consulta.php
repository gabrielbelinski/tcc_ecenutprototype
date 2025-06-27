<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Carbon\Carbon;
class Consulta extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'fk_id_pacientes',
        'fk_id_usuarios',
        'data_consulta',
        'hora_consulta',
        'modalidade_consulta',
        'status_pagamento',
        'forma_pagamento',
        'status_consulta',
        'comprovante_pagamento_url',
        'valor_total_consulta',
        'observacoes_consulta',
        'bioimpedancia_url',
        'gera_avaliacao',
        'nome_professor_responsavel_dia',
        'nome_professor_avaliador',
        'data_criacao_avaliacao',
        'status_plano_alimentar',
        'status_conduta_nutricional',
        'status_acompanhamento_nutricional',
        'plano_alimentar_url',
        'conduta_nutricional_url',
        'acompanhamento_nutricional_url',
        'avaliacao_finalizada',
        'observacoes_docente'
    ];

    public function paciente(): BelongsTo
    {
        return $this->belongsTo(Paciente::class, 'fk_id_pacientes');
    }

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class);
    }

    public function anamnese(): HasOne
    {
        return $this->hasOne(Anamnese::class, 'fk_id_consultas');
    }

    public function evolucao(): HasOne
    {
        return $this->hasOne(Evolucao::class, 'fk_id_consultas');
    }

    public function acompanhamento(): HasOne
    {
        return $this->hasOne(Acompanhamento::class, 'fk_id_consultas');
    }

    public static function getConsultasDia()
    {
        return self::with('paciente')->whereDate('data_consulta', Carbon::today())->orderBy('hora_consulta', 'desc')->get();
    }
}
