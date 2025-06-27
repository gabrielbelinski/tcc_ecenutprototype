<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidaCPF implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
        $cpf = preg_replace('/[^0-9]/', '', (string) $value);

        if (strlen($cpf) != 11) {
            $fail('O número de :attribute deve conter 11 dígitos numéricos.');
            return;
        }
        if (preg_match('/^(\d)\1{10}$/', $cpf)) {
            $fail('O campo :attribute não é um CPF válido.');
            return;
        }
        if (!$this->validarDigitos($cpf)) {
            $fail('O campo :attribute não é um CPF válido.');
        }
    }

    /**
     * Valida os dígitos verificadores do CPF
     * 
     * @param string $cpf
     * @return bool
     */
    protected function validarDigitos(string $cpf): bool
    {
        // Extrai os dígitos verificadores
        $digitos = substr($cpf, 0, 9);
        $digitoVerificador1 = (int) substr($cpf, 9, 1);
        $digitoVerificador2 = (int) substr($cpf, 10, 1);

        // Calcula o primeiro dígito verificador
        $soma = 0;
        for ($i = 0; $i < 9; $i++) {
            $soma += (int) $digitos[$i] * (10 - $i);
        }
        $resto = $soma % 11;
        $calcDigito1 = ($resto < 2) ? 0 : 11 - $resto;

        // Verifica o primeiro dígito
        if ($calcDigito1 != $digitoVerificador1) {
            return false;
        }

        // Calcula o segundo dígito verificador
        $digitos .= $digitoVerificador1;
        $soma = 0;
        for ($i = 0; $i < 10; $i++) {
            $soma += (int) $digitos[$i] * (11 - $i);
        }
        $resto = $soma % 11;
        $calcDigito2 = ($resto < 2) ? 0 : 11 - $resto;

        // Verifica o segundo dígito
        return $calcDigito2 == $digitoVerificador2;
    }
}
