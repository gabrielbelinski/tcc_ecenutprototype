<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnamneseAdultoIdoso extends Model
{
    public $timestamps = false;
    protected $table = 'anamneses_adultos_idosos';
    protected $fillable = [
        'tabagismo',
        'qtd_cigarros',
        'protese_dentaria',
        'deseja_hipertrofia'
    ];
}
