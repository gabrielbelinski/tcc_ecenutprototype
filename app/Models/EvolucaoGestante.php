<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvolucaoGestante extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'evolucoes_gestantes';

    protected $fillable = [
        'pressao_arterial',
        'imc_pre_gestacional',
        'ganho_peso',
        'imc',
        'peso_habitual',
        'prega_biciptal_pcb',
        'suplementacao'
    ];
}
