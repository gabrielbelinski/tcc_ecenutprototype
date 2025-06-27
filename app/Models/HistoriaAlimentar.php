<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HistoriaAlimentar extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'historias_alimentares';
    protected $fillable = ['nome', 'descricao'];

    public function anamnesesPediatricas(): BelongsTo{
        return $this->belongsTo(AnamnesePediatrica::class, 'fk_id_anamneses_pediatricas');
    }
}
