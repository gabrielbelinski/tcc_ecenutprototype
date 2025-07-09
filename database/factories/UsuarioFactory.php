<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Usuario>
 */
class UsuarioFactory extends Factory
{
    public function definition(): array
    {
        $faker = \Faker\Factory::create('pt_BR');

        return [
            'nome' => $faker->name(),
            'email' => $faker->unique()->safeEmail(),
            'senha' => bcrypt('senha123'),
            'matricula' => $faker->unique()->numerify('########'),
            'genero' => $faker->randomElement([
                'Masculino',
                'Feminino',
                'Outro',
                'Prefere não informar',
            ]),
            'data_nascimento' => $faker->optional()->date(),
            'data_inativacao' => $faker->optional(0.1)->dateTime(),
            'telefone' => $faker->optional()->cellphoneNumber(),
            'rg' => $faker->optional()->numerify('##.###.###-#'),
            'cpf' => $faker->optional()->cpf(false),
            'rua' => $faker->optional()->streetName(),
            'numero' => $faker->optional()->buildingNumber(),
            'bairro' => $faker->optional()->citySuffix(),
            'cep' => $faker->optional()->postcode(),
            'cidade' => $faker->optional()->city(),
            'estado' => $faker->optional()->stateAbbr(),
            'tipo_usuario' => $faker->randomElement(['Estagiário', 'Secretário', 'Docente']),
        ];
    }
}
