<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Paciente>
 */
class PacienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        'nome' => fake()->name(),
        'data_nascimento' => fake('pt-BR')->date('d-m-Y'),
        'cpf' =>fake('pt-BR')->numberBetween(5000,10000),
        'rg' =>fake('pt-BR')->numberBetween(5000,10000),
        'encaminhamento' =>fake()->randomElement(['Não', 'SUS', 'CEFISIO', 'Outro']),
        'telefone' => fake('pt-BR')->phoneNumber(),
        'email' => fake('pt-BR')->unique()->safeEmail(),
        'aluno_unicentro' =>fake()->randomElement(['S', 'N']),
        'genero'  =>fake()->randomElement(['M', 'F']),
        'tipo' =>fake()->randomElement(['Adulto', 'Idoso', 'Pediatria', 'Adolescente', 'Gestante', 'Neuropata']),
        'rua' =>fake('pt-BR')->streetName(),
        'numero' => fake('pt-BR')->numberBetween(1,500),
        'bairro' =>fake('pt-BR')->citySuffix(),
        'cep' =>fake('pt-BR')->postcode(),
        'cidade' =>fake('pt-BR')->city(),
        'estado' =>fake('pt-BR')->citySuffix(),
        'escolaridade'=>fake()->randomElement(['Não alfabetizado', 'Ensino Médio Incompleto', 'Ensino Médio Completo', 'Ensino Fundamental Incompleto', 'Ensino Fundamental Completo', 'Ensino Superior Incompleto', 'Ensino Superior Completo']),
        'profissao' =>fake()->jobTitle(),
        'renda_familiar_ibge' => '5000',
        'num_pessoas_nucleo_familiar' => fake('pt-BR')->numberBetween(1,10),
        'motivo_procura' => 'Lorem ipsum'
        ];
    }
}
