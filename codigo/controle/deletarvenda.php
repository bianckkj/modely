<?php
    require_once "conexao.php";
    require_once "../public/funcoes.php";

    $id = $_GET['id'];

    if (deletarVenda($conexao, $id_vendas)) {
        header("Location: ../public/listar_venda.php");
    }
    else {
        header("Location: home.php");
    }

?>