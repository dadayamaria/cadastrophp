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

require_once('bd.php');

// array de resposta
$resposta = array();

// Verificar se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST["nome"];
    $cpf = $_POST["cpf"];
    $email = $_POST["email"];
    $telefone = $_POST["phone"];
    $dataNasc = $_POST["d_nasc"];


    // Validar CPF, email e telefone
    if (validarCPF($cpf) && validarEmail($email) && validarTelefone($telefone)) {
       // antes de registrar o novo usuário, verificamos se ele já
	    // não existe.
	    $consulta_usuario_existe = $db_con->prepare("SELECT email FROM cadastro WHERE email='$email'");
	    $consulta_usuario_existe->execute();
	    if ($consulta_usuario_existe->rowCount() > 0) { 
		    // se já existe um usuario para login
		    // indicamos que a operação não teve sucesso e o motivo
		    // no campo de erro.
		    $resposta["sucesso"] = 0;
		    $resposta["erro"] = "usuario ja cadastrado";
	    }
	    else {
		    // se o usuário ainda não existe, inserimos ele no bd.
		    $consulta = $db_con->prepare("INSERT INTO cadastro(nome,telefone,cpf,data_nasc,email) VALUES('$nome', '$telefone', '$cpf', ' $dataNasc', '$email')");
	 
		    if ($consulta->execute()) {
			    // se a consulta deu certo, indicamos sucesso na operação.
			    $resposta["sucesso"] = 1;
		    }
		    else {
			    // se houve erro na consulta, indicamos que não houve sucesso
			    // na operação e o motivo no campo de erro.
			    $resposta["sucesso"] = 0;
			    $resposta["erro"] = "erro BD: " . $consulta->error;
		    }
	    }
    } 
    else {
        if(!validarCPF($cpf)) {
            $resposta["sucesso"] = 0;
		    $resposta["erro"] = "Falha na validação do cpf. Por favor, verifique os dados e tente novamente.";
        }
        else {
            if(!validarEmail($email)) {
                $resposta["sucesso"] = 0;
                $resposta["erro"] = "Falha na validação do email. Por favor, verifique os dados e tente novamente.";
            }
            else {
                $resposta["sucesso"] = 0;
                $resposta["erro"] = "Falha na validação do telefone. Por favor, verifique os dados e tente novamente.";
            }
            
        }   
    }
}
else {
    $resposta["sucesso"] = 0;
	$resposta["erro"] = "Método não é POST";
}


// A conexão com o bd sempre tem que ser fechada
$db_con = null;

// converte o array de resposta em uma string no formato JSON e 
// imprime na tela.
echo json_encode($resposta);

?>


