<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvolucaoPediatrica extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'evolucoes_pediatricas';

    protected $fillable = [
        'idade_corrigida',
        'gordura_corporal_pregas',
        'gordura_corporal_bia',
        'nome_responsavel',
        'parentesco_responsavel'
    ];
}
