<?php 
    include_once "conexao.php";
    	
    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";
    // exit;
    
    if($_SERVER['REQUEST_METHOD'] == "POST") {
    
        $descricao = $_POST['descricao'];
        $data_do_vale = $_POST['data_do_vale'];
        $valor = $_POST['valor'];
        // $atualizado = $_POST['atualizado'];
        // $criado = $_POST['criado'];
    }

?>