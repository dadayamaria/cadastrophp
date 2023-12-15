<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stile.css">
    <script src="funcionalidades.js"></script>
    <title>Cadastro de clientes</title> 
</head>
<body> 
     <h1 class="cads"> Cadastro de Clientes </h1> 

    <center><div class= "tabela">
        <form action="cadastramento.php" method="POST">
            <center>
            <p> <h3 class= "letra"> <label for="nome">Nome:</label> 
                <input type="text" id="nome" name="nome" class="form" required> </h3>
            <br>
            <p> <h3 class= "letra"> <label for="cpf">CPF:</label> 
                <input type="text" id="cpf" name="cpf" class="form"  required> </h3>
            <br>
            <p> <h3 class= "letra"> <label for="email">Email:</label> 
                <input type="email" id="email" name="email" class="form" required> </h3>
            <br>
            <p> <h3 class= "letra"> <label for="phone">Numero de telefone:</label>  
                <input type="tel" id="phone" name="phone" class="form2" required> </h3>
            <br>
            <p> <h3 class= "letra"> <label for="d_nasc">Data de nascimento:</label> 
                <input type="date" id="d_nasc" name="d_nasc" class="form2" required> </h3>
            <br>

            <input type="submit" formmethod="post" class="botao" value="cadastrar">
            </center>
        </form>
    </div> 
    </center>

</body>
</html>