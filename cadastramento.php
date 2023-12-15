<?php

function validarCPF($cpf) {
    // Remover caracteres não numéricos
    $cpf = preg_replace('/[^0-9]/', '', $cpf);

    // Verificar se o CPF tem 11 dígitos
    if (strlen($cpf) != 11) {
        return false;
    }

    // Verificar se todos os dígitos são iguais
    if (preg_match('/(\d)\1{10}/', $cpf)) {
        return false;
    }

    // Calcular os dígitos verificadores
    for ($i = 9, $j = 10, $soma1 = $soma2 = 0; $i > 0; $i--, $j--) {
        $soma1 += $cpf[$i - 1] * $i;
        $soma2 += $cpf[$i - 1] * $j;
    }

    $resto1 = $soma1 % 11;
    $dv1 = ($resto1 < 2) ? 0 : 11 - $resto1;

    $resto2 = $soma2 % 11;
    $dv2 = ($resto2 < 2) ? 0 : 11 - $resto2;

    // Verificar se os dígitos verificadores estão corretos
    if ($cpf[9] != $dv1 || $cpf[10] != $dv2) {
        return false;
    }

    return true;
}

function validarEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

function validarTelefone($telefone) {
    // Remover caracteres não numéricos
    $telefone = preg_replace('/[^0-9]/', '', $telefone);

    // Verificar se o telefone tem 11 dígitos
    if (strlen($telefone) != 11) {
        return false;
    }

    return true;
}

// Verificar se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST["nome"];
    $cpf = $_POST["cpf"];
    $email = $_POST["email"];
    $telefone = $_POST["phone"];
    $dataNasc = $_POST["d_nasc"];


    // Validar CPF, email e telefone
    if (validarCPF($cpf) && validarEmail($email) && validarTelefone($telefone)) {
        // TODO: Conectar ao banco de dados e inserir os dados
        echo "Cadastro bem-sucedido!";
    } else {
        if(!validarCPF($cpf)) {
            echo "Falha na validação do cpf. Por favor, verifique os dados e tente novamente.";
        }
        if(!validarEmail($email)) {
            echo "Falha na validação do email. Por favor, verifique os dados e tente novamente.";
        }
        if(!validarTelefone($telefone)) {
            echo "Falha na validação do telefone. Por favor, verifique os dados e tente novamente.";
        }
            
    }
}

?>


