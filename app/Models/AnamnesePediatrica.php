<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AnamnesePediatrica extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'anamneses_pediatricas';
    protected $fillable = [
        'nome_responsavel',
        'escolaridade_responsavel',
        'parentesco_responsavel',
        'profissao_responsavel',
        'idade_gestacional',
        'peso_nascimento',
        'estatura_nascimento',
        'intercorrencias_nascimento',
        'alimentacao_e_suficiente',
        'tipo_parto',
        'turno_escolar',
        'outras_intercorrencias'
    ];


}
