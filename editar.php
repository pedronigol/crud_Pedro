<?php
    include_once "conexao.php";
    include_once "funcoes.php";

    if(isset($_GET['id']) && $_GET['id'] > 0){
        $id = $_GET['id'];

        $conexaoComBanco = abrirBanco();

        $pegarDados = $conexaoComBanco->prepare("SELECT * FROM vale WHERE id = ?");
        $pegarDados->bind_param("i", $id);
        $pegarDados->execute();
        $result = $pegarDados->get_result();

        if($result->num_rows == 1) {
            $registro = $result->fetch_assoc();
        }
        fecharBanco($conexaoComBanco);
    }

    if($_SERVER['REQUEST_METHOD'] == "POST") {


        //echo "Tem algo que foi enviado pelo formulario";
        $id = $_POST['id'];
        $descricao = $_POST['descricao'];
        $valor = $_POST['valor'];
        $data_do_vale = $_POST['data_do_vale'];
        $atualizado_em = $_POST['atualizado_em'];
        $criado_em = $_POST['criado_em'];

        $conexaoComBanco = abrirBanco();

        $sql = "UPDATE vale SET descricao = '$descricao', valor = '$valor', 
        data_do_vale = '$data_do_vale', atualizado_em = '$atualizado_em', criado_em = '$criado_em', 
        WHERE id = $id";

        if( $conexaoComBanco->query($sql) === TRUE) {
            echo "Contato salvo com sucesso no banco de dados";
        }else {
            echo "Erro ao salvar no banco de dados: " .  $conexaoComBanco->error;
        }

        fecharBanco($conexaoComBanco);
    }

    
?>




<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de pessoas</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <header>
        <h1>Agenda de contatos</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="cadastrar.php">Cadastrar</a></li>
            </ul>
        </nav>
    </header>
    <section>
        <h2>Atualizar de contatos</h2>

        <form action="" method="POST">
            <label for="descricao">Descrição</label>
            <input type="text" name="descricao" value="<?= $registro['descricao'] ?>" require >

            <label for="valor">Valor</label>
            <input type="text" name="valor" value="<?= $registro['valor'] ?>" require >

            <label for="data_do_vale">Data do vale</label>
            <input type="date" name="data_do_vale" value="<?= $registro['data_do_vale'] ?>" require >
            
            <label for="atualizado_em">Atualizado em</label>
            <input type="date" name="atualizado_em" value="<?= $registro['atualizado_em'] ?>" require >

            <label for="criado_em">Criado em</label>
            <input type="date" name="criado_em" value="<?= $registro['criado_em'] ?>" require >

            <button type="submit">Atualizar</button>
        </form>

    </section>

</body>
</html>
