<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvolucaoAdultoIdoso extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'evolucoes_adultos_idosos';

    protected $fillable = [
        'imc',
        'diagnostico_nutricional',
        'prega_biciptal_pcb',
        'prega_supra_iliaca_pcsi',
        'gordura_corporal_bia',
        'pressao_arterial',
        'circunferencia_cintura'
    ];
}
