<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnamneseAdolescente extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'anamneses_adolescentes';
    protected $fillable = [
            'turno_escolar',
            'escolaridade_responsavel',
            'estadiamento_puberal',
            'idade_inicio_ciclo_menstrual',
            'tempo_menarca',
            'problemas_associados_menarca',
            'alteracao_humor_periodo_menstrual',
            'tipo_alteracao_humor_periodo_menstrual',
            'alimentacao_e_suficiente',
            'nome_responsavel',
            'profissao_responsavel',
            'parentesco_responsavel',
            'profissional_tratamento',
            'tipo_problemas_associados_menarca',
    ];
}
