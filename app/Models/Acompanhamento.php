<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Acompanhamento extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'fk_id_consultas',
        'habitos_atv_fisica',
        'duracao_atv_fisica',
        'horario_atv_fisica',
        'tipo_atv_fisica',
        'intensidade_atv_fisica',
        'intercorrencias',
        'habito_intestinal',
        'ingestao_hidrica',
        'mudancas_diagnostico',
        'medicamentos',
        'tipo_registro',
        'cafe_manha',
        'lanche_manha',
        'almoco',
        'lanche_tarde_I',
        'lanche_tarde_II',
        'jantar',
        'ceia',
        'outros_registro_alimentar'
    ];

    public function consulta(): BelongsTo
    {
        return $this->belongsTo(Consulta::class);
    }
}
