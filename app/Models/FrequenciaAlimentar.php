<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FrequenciaAlimentar extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'frequencias_alimentares';

    protected $fillable = [
        'nome',
        'qtd',
        'frequencia'
    ];

    public function anamnese(): BelongsTo{
        return $this->belongsTo(Anamnese::class);
    }
}
