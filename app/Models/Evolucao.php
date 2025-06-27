<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Evolucao extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'evolucoes';

    protected $fillable = [
        'fk_id_consultas',
        'diagnostico_nutricional',
        'pressao_arterial',
        'imc',
        'peso',
        'estatura',
        'circunferencia_braco',
        'circunferencia_muscular_braco',
        'prega_triciptal_pct',
        'prega_subescapular_pcse',
        'glicemia',
        'colesterol',
        'triglicerideos',
        'prega_biciptal_pcb',
        'prega_supra_iliaca_pcsi',
        'gordura_corporal_bia',
        'circunferencia_cintura',
        'idade_corrigida',
        'gordura_corporal_pregas',
        'imc_pre_gestacional',
        'ganho_peso',
        'peso_habitual',
        'suplementacao',
        'prega_toracica_ptx',
        'prega_coxa_pcx',
        'prega_panturrilha_pcp',
        'obs_adicionais',
    ];

    public function consulta(): BelongsTo
    {
        return $this->belongsTo(Consulta::class);
    }
}
