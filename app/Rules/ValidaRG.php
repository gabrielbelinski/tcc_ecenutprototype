<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidaRG implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Remove todos os caracteres não numéricos, exceto X/x que pode ser o dígito verificador
        $rg = preg_replace('/[^0-9Xx]/', '', (string) $value);

        // Verifica o tamanho (considerando RG sem máscara, normalmente 8 ou 9 dígitos)
        if (strlen($rg) < 8 || strlen($rg) > 9) {
            $fail('O campo :attribute não possui um tamanho válido para RG.');
            return;
        }

        // Verifica se todos os dígitos são iguais (inválido)
        if (preg_match('/^(\d)\1*$/', $rg)) {
            $fail('O campo :attribute não é um RG válido.');
            return;
        }

        // Opcional: Validação do dígito verificador (depende do estado)
        // Este é um exemplo básico - a validação exata varia conforme a UF
        if (!$this->validarDigito($rg)) {
            $fail('O campo :attribute possui um dígito verificador inválido.');
        }
    }

    /**
     * Valida o dígito verificador do RG (exemplo para SP)
     * 
     * @param string $rg
     * @return bool
     */
    protected function validarDigito(string $rg): bool
    {
        // Remove o dígito verificador (último caractere)
        $numero = substr($rg, 0, -1);
        $digito = strtoupper(substr($rg, -1));

        // Calcula o dígito esperado (algoritmo básico para SP)
        $soma = 0;
        $pesos = [2, 3, 4, 5, 6, 7, 8, 9]; // pesos comuns em SP

        for ($i = 0; $i < strlen($numero); $i++) {
            $soma += $numero[$i] * $pesos[$i];
        }

        $resto = $soma % 11;
        $digitoCalculado = ($resto == 0) ? '0' : (($resto == 1) ? 'X' : (string) (11 - $resto));

        return $digito === $digitoCalculado;
    }
}