<?php 
    include_once "conexao.php";
    include_once "funcoes.php";

 if(isset($_GET['acao']) && $_GET['acao'] == 'del'){
      $id = $_GET['id'];

       $conexaoComBanco = abrirBanco();
       $sql = "DELETE FROM vale WHERE id =$id";

       if ($conexaoComBanco->query($sql) === TRUE){
            //echo "Contato excluido com sucesso";
      }else{
          echo "Erro ao excluir contato: ".$conexaoComBanco->error;
       }
       fecharBanco($conexaoComBanco);
   }

   if($_SERVER['REQUEST_METHOD'] == "POST") {
    
    $descricao = $_POST['descricao'];
    $data_do_vale = $_POST['data_do_vale'];
    $valor = $_POST['valor'];
    // $atualizado = $_POST['atualizado'];
    // $criado = $_POST['criado'];
 

    $conexaoComBanco = abrirBanco();
    $sql = "insert into vale (descricao, data_do_vale, valor)
      values('$descricao', '$data_do_vale', '$valor')";

      if ($conexaoComBanco ->query($sql) === TRUE){
        echo "<script>alert ('Cadastrado com sucesso')</script>";
      }else{
        echo ":(Erro ao salvar n banco de dados" . $conexaoComBanco ->error;
      }

      fecharBanco($conexaoComBanco);
}

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedro CRUD</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <header>
        <h1>Gerenciador de Vales</h1>

    </header>
    <section>
        
    
  
    <section>
        <h2>Gerenciar vales</h2>
        <form action="" method="POST">
            <label for="descricao">Descrição</label>
            <input type="text" name="descricao" required>

            <label for="data_do_vale">Data do vale</label>
            <input type="date" name="data_do_vale" required>

            <label for="valor">Valor</label>
            <input type="float" name="valor" required>

            <!-- <label for="atualizado">Atualizado em:</label>
            <input type="date" name="atualizado" required>

            <label for="criado">Criado em</label>
            <input type="date" name="criado" required> -->

            <button type="submit">Salvar</button>
        </form>
    </section>
        <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Descrição</th>
                <th>Data do vale</th>
                <th>Valor</th>
            
            </tr>
        </thead>
        <tbody>
            <?php 
             $conexaoComBanco = abrirBanco();
             $sql = "SELECT *FROM vale";

             $result =  $conexaoComBanco->query($sql);
//total = tota+valor
                if($result-> num_rows >0){
                    while ($registro = $result->fetch_assoc()){
                ?>
                    <tr>
                        <td><?= $registro['id']?></td>
                        <td><?= $registro['descricao']?></td>
                        <td><?= $registro['data_do_vale']?></td>
                        <td><?= $registro['valor']?></td>
                       
                   
                        <td>
                        <a href="editar.php?id=<?= $registro['id'] ?>"><button>Editar</button></a>
                            <a href="?acao=del&id=<?= $registro['id']?>"
                            onclick="return confirm('Tem certeza? seus dados serão exluidos')">
                            <button>Excluir</button></a>
                        </td>
                    </tr>
                    
                    <?php
                    }
                }else{
                    echo ("<tr><td>Nenhum registro para exibir</td></tr>");
                }
            ?>
      
        </tbody>
        </table>
    </section>


</body>
</html>