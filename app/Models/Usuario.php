<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'email',
        'senha',
        'matricula',
        'genero',
        'data_nascimento',
        'data_inativacao',
        'nome',
        'telefone',
        'rg',
        'cpf',
        'rua',
        'numero',
        'bairro',
        'cep',
        'cidade',
        'estado',
        'tipo_usuario'
    ];

    public function consultasUsuario(): HasMany
    {
        return $this->hasMany(Consulta::class, 'fk_id_usuarios');
    }
}
