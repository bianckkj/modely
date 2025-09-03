<?php
    require_once "conexao.php";
    require_once "../public/funcoes.php";

    $id = $_GET['id'];

    if (editarClientes($conexao, $nome, $cpf, $telefone, $email, $endereco, $id)) {
        header("Location: ../public/listarClientes.php");
    }
    else {
        header("Location: home.php");
    }

?>