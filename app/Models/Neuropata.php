<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Neuropata extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'se_alimenta_sozinho',
        'hipertonicidade_lingua',
        'movimento_temporo_mandibular_lingua',
        'succao',
        'tosse_durante_refeicao',
        'posicao_alimentacao',
        'posicao_dormir',
        'consistencia_alimentos',
        'infeccao_repeticao',
        'infeccoes_vias_aereas',
        'oitites',
        'sinusopatia',
        'broncoespasmo',
        'apneia',
        'saliva',
        'abre_boca_redor_colher',
        'vomitos',
        'periodo_dia_vomitos',
        'broncopneumopatias',
        'insuficiencia_respiratoria',
        'dor_toracica',
        'consegue_mastigar',
        'engasgo_durante_refeicao',
        'fecha_boca_redor_colher'
    ];

    public function neuropata(): MorphTo
    {
        return $this->morphTo();
    }
}
