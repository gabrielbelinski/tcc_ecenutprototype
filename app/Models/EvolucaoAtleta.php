<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvolucaoAtleta extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'evolucoes_atletas';

    protected $fillable = [
        'pressao_arterial',
        'imc',
        'prega_biciptal_pcb',
        'prega_supra_iliaca_pcsi',
        'prega_toracica_ptx',
        'prega_coxa_pcx',
        'prega_panturrilha_pcp',
        'circunferencia_cintura',
        'gordura_corporal_bia'
    ];
}
