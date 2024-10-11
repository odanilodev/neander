<?php
defined('BASEPATH') or exit('No direct script access allowed');

// Função para validar CPF.
// Recebe um parâmetro string|null numérico ($value = CPF a ser validado).
// Retorna um booleano. True se o CPF for válido, caso contrário, retorna False.
if (!function_exists('validarCpf')) {

    function validarCpf($value = null)
    {
        if (empty($value)) {

            return true;
        }

        // Remove caracteres não numéricos do CPF
        $c = preg_replace('/\D/', '', $value);

        // Verifica se o CPF tem 11 dígitos ou se são todos iguais
        if (strlen($c) != 11 || preg_match("/^{$c[0]}{11}$/", $c)) {
            return false;
        }

        // Calcula o primeiro dígito verificador do CPF
        for ($s = 10, $n = 0, $i = 0; $s >= 2; $n += $c[$i++] * $s--) {
        }
        if ($c[9] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
            return false;
        }

        // Calcula o segundo dígito verificador do CPF
        for ($s = 11, $n = 0, $i = 0; $s >= 2; $n += $c[$i++] * $s--) {
        }
        if ($c[10] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
            return false;
        }

        // Se todas as verificações passaram, considera o CPF como válido
        return true;
    }

    // Função para validar CNPJ.
    // Recebe um parâmetro string|null numérico ($value = CNPJ a ser validado).
    // Retorna um booleano. True se o CNPJ for válido, caso contrário, retorna False.
    if (!function_exists('validarCnpj')) {

        function validarCnpj($value = null)
        {

            if (empty($value)) {
                return true;
            }

            // Remove caracteres não numéricos do CNPJ
            $c = preg_replace('/\D/', '', $value);

            // Verifica se o CNPJ tem 14 dígitos ou se são todos iguais
            if (strlen($c) != 14 || preg_match("/^{$c[0]}{14}$/", $c)) {
                return false;
            }

            // Validação do primeiro dígito verificador do CNPJ
            $tamanho = 12;
            $soma = 0;
            $multiplicadores = [5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];

            for ($i = 0; $i < $tamanho; $i++) {
                $soma += $c[$i] * $multiplicadores[$i];
            }

            $resto = $soma % 11;
            $digito1 = ($resto < 2) ? 0 : 11 - $resto;

            if ($c[12] != $digito1) {
                return false;
            }

            // Validação do segundo dígito verificador do CNPJ
            $tamanho = 13;
            $soma = 0;
            $multiplicadores = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];

            for ($i = 0; $i < $tamanho; $i++) {
                $soma += $c[$i] * $multiplicadores[$i];
            }

            $resto = $soma % 11;
            $digito2 = ($resto < 2) ? 0 : 11 - $resto;

            if ($c[13] != $digito2) {
                return false;
            }

            // Se todas as verificações passaram, considera o CNPJ como válido
            return true;
        }
    }

    // Função para validar e-mail.
    // Recebe um parâmetro string|null ($value = e-mail a ser validado).
    // Retorna um booleano. True se o e-mail for válido, caso contrário, retorna False.
    if (!function_exists('validarEmail')) {

        function validarEmail($value = null): bool
        {
            if (empty($value)) {
                return false;  // E-mail vazio é inválido
            }

            // Valida o e-mail usando o filtro nativo do PHP
            return filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
        }
    }

    // Função para validar telefone brasileiro.
    // Recebe um parâmetro string|null numérico ($value = telefone a ser validado).
    // Retorna um booleano. True se o telefone for válido, caso contrário, retorna False.
    if (!function_exists('validarTelefone')) {

        function validarTelefone($value = null): bool
        {
            if (empty($value)) {
                return false;  // Telefone vazio é inválido
            }

            // Remove caracteres não numéricos do telefone
            $telefone = preg_replace('/\D/', '', $value);

            // Verifica se o telefone tem 10 ou 11 dígitos
            return preg_match('/^[1-9]{2}[0-9]{8,9}$/', $telefone) === 1;
        }
    }
}
