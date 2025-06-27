<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Usuario>
 */
class UsuarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'email' => fake('pt-BR')->unique()->safeEmail(),
        'senha' => '123456',
        'matricula' =>fake('pt-BR')->unique()->numberBetween(5000,10000),
        'genero' =>fake()->randomElement(['M','F']),
        'data_nascimento' =>fake('pt-BR')->date('d-m-Y'),
        'nome' => fake('pt-BR')->name(),
        'telefone' => fake('pt-BR')->phoneNumber(),
        'rg'  =>fake('pt-BR')->numberBetween(5000,10000),
        'cpf' =>fake('pt-BR')->numberBetween(5000,10000),
        'rua' =>fake('pt-BR')->streetName(),
        'numero' =>fake('pt-BR')->numberBetween(1, 4000),
        'bairro' => 'Centro',
        'cep'=>fake('pt-BR')->postcode(),
        'cidade'=>fake('pt-BR')->city(),
        'estado' =>fake('pt-BR')->citySuffix(),
        'tipo' =>fake('pt-BR')->randomElement(['Professor','Estagiario', 'Secretario']),
        ];
    }
}
