<?php 
//Conexão
include_once 'banco.php';

//Header
include_once 'header.php';
?>
    <!-- BOOTSTRAP -->
    <div class="m-5 ">
        <div class="fs-1 mb-5">
            <h1>Lista de Clientes</h1>
        </div>
        <div class="table-responsive">            
            <table class="table  table-hover ">
                <thead>
                    <tr>
                        <th scope="col">nome</th>
                        <th scope="col">cpf</th>
                        <th scope="col">email</th>
                        <th scope="col">numero_telefone</th>                   
                        <th scope="col">data_nascimento</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php
                        $sql="SELECT * FROM cadastro";
                        $resultado= mysqli_query($connect,$sql);
                        
                        if (mysqli_num_rows($resultado)>0):                            
                            //var_dump($resultado);                    
                            while($linha =mysqli_fetch_array($resultado)):
                    ?>                            
                        <tr>
                            <td> <?php echo $linha['nome']; ?> </td>
                            <td> <?php echo $linha['cpf']; ?> </td>
                            <td> <?php echo $linha['email']; ?> </td>
                            <td> <?php echo $linha['numero_telefone']; ?>  </td> 
                            <td> <?php echo $linha['data_nascimento']; ?>  </td>                           
                            <td>    
  
                                </div>
                            </div>
                        </div>
                endif;
                ?>                  
                </tbody> 
            </table>
        </div>
        <br>
        <a href="tela_cadastro.php" class="btn btn-info"> Adicionar cliente</a>
    </div>
<?php?>

     
 