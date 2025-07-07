<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Paciente>
 */
class PacienteFactory extends Factory
{
    public function definition(): array
    {
        $faker = \Faker\Factory::create('pt_BR');

        $grupoEtario = $faker->randomElement([
            'Recém nascido',
            'Criança',
            'Adolescente',
            'Adulto',
            'Idoso',
        ]);

        $genero = $faker->randomElement([
            'Masculino',
            'Feminino',
            'Outro',
            'Prefere não informar',
        ]);

        $encaminhamento = $faker->randomElement([
            'Particular',
            'Médico',
            'SUS',
            'UBS',
            'Escola',
            'CEFISIO',
            'CAEEF',
            'Personal Trainer',
            'Outro',
        ]);

        $rendaIBGE = $faker->randomElement([
            'Não sabe',
            'E',
            'D',
            'C',
            'B',
            'A'
        ]);

        $dadosResponsavel = in_array($grupoEtario, ['Recém nascido', 'Criança', 'Adolescente']) ? [
            'motivo_procura' => $faker->randomElement([
                'Perda de peso',
                'Ganho de peso',
                'Alergias ou intolerâncias alimentares',
                'Doenças',
                'Reeducação alimentar',
                'Hipertrofia',
                'Outro',
            ]),
            'turno_escolar' => $faker->randomElement(['Matutino', 'Vespertino', 'Noturno']),
            'nome_responsavel' => $faker->name(),
            'parentesco_responsavel' => $faker->randomElement([
                'Pai/Mãe',
                'Avó/Avô',
                'Tio/Tia',
                'Irmão/Irmã',
                'Outro',
            ]),
            'profissao_responsavel' => $faker->jobTitle(),
            'escolaridade_responsavel' => $faker->randomElement([
                'Ensino Fundamental',
                'Ensino Médio',
                'Ensino Superior',
                'Pós-graduação',
                'Não alfabetizado',
            ]),
        ] : [
            'motivo_procura' => null,
            'turno_escolar' => null,
            'nome_responsavel' => null,
            'parentesco_responsavel' => null,
            'profissao_responsavel' => null,
            'escolaridade_responsavel' => null,
        ];

        return array_merge([
            'nome' => $faker->name(),
            'data_nascimento' => $faker->date(),
            'cpf' => $faker->unique()->cpf(false),
            'rg' => $faker->unique()->numerify('##.###.###-#'),
            'encaminhamento' => $encaminhamento,
            'telefone' => $faker->cellphoneNumber(),
            'email' => $faker->safeEmail(),
            'aluno_unicentro' => $faker->boolean(20),
            'gestante' => $faker->boolean(10),
            'neuropata' => $faker->boolean(10),
            'atleta' => $faker->boolean(15),
            'genero' => $genero,
            'grupo_etario' => $grupoEtario,
            'rua' => $faker->streetName(),
            'numero' => $faker->buildingNumber(),
            'bairro' => $faker->optional()->citySuffix(),
            'cep' => $faker->postcode(),
            'cidade' => $faker->city(),
            'estado' => $faker->stateAbbr(),
            'escolaridade' => $faker->randomElement([
                'Ensino Fundamental',
                'Ensino Médio',
                'Ensino Superior',
                'Pós-graduação',
                'Não alfabetizado',
            ]),
            'profissao' => $faker->jobTitle(),
            'renda_familiar_ibge' => $rendaIBGE,
            'num_pessoas_nucleo_familiar' => $faker->numberBetween(1, 8),
        ], $dadosResponsavel);
    }
}
