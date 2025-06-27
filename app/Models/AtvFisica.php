<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AtvFisica extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'duracao_atv_fisica',
        'horario_atv_fisica',
        'tipo_atv_fisica',
        'intensidade_atv_fisica'
    ];

    public function acompanhamento(): BelongsTo{
        return $this->belongsTo(Acompanhamento::class);
    }

    public function anamnese(): BelongsTo{
        return $this->belongsTo(Anamnese::class);
    }
}
