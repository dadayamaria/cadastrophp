<?php

function validarCPF($cpf) {
 
    // Extrai somente os números
    $cpf = preg_replace( '/[^0-9]/is', '', $cpf );
     
    // Verifica se foi informado todos os digitos corretamente
    if (strlen($cpf) != 11) {
        return false;
    }

    // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
    if (preg_match('/(\d)\1{10}/', $cpf)) {
        return false;
    }

    // Faz o calculo para validar o CPF
    for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpf[$c] * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf[$c] != $d) {
            return false;
        }
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


