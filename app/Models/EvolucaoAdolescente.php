<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvolucaoAdolescente extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'evolucoes_adolescentes';

    protected $fillable = [
        'gordura_corporal_bia'
    ];
}
