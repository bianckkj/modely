<?php
    require_once "conexao.php";
    require_once "../public/funcoes.php";

    $id = $_GET['id'];

    if (deletarProduto($conexao, $id)) {
        header("Location: ../public/listar_produto.php");
    }
    else {
        header("Location: ../public/home.php");
    }

?>