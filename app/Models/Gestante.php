<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Gestante extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'idade_gestacional',
        'qtd_gestacoes',
        'abortos',
        'houve_morte_perinatal',
        'intervalo_interpartal',
        'num_filhos_idade',
        'historico_bebe_peso',
        'historico_hipertensao',
        'paridade',
        'dum',
        'ultima_medida_pa',
        'leite_materno',
        'condicoes_seios',
        'suplementacao',
        'alteracao_humor',
        'edema',
        'nauseas',
        'pica',
        'anemia',
        'descricao_epoca_anemia',
        'substancias_pica',
        'azia',
        'frequencia_azia',
        'frequencia_nauseas',
        'vomito',
        'frequencia_vomito'
    ];

    public function gestante(): MorphTo{
        return $this->morphTo();
    }

}
