<?php
    require_once "conexao.php";
    require_once "../public/funcoes.php";

    $id = $_GET['id'];

    if (deletarCliente($conexao, $id)) {
        header("Location: ../public/listar_Clientes.php");
    }
    else {
        header("Location: home.php");
    }

?>