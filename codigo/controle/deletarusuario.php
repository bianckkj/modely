<?php
    require_once "conexao.php";
    require_once "../public/funcoes.php";

    $id = $_GET['id'];

    if (deletarUsuario($conexao, $id)) {
        header("Location: ../public/listar_usuario.php");
    }
    else {
        header("Location: ../public/home.php");
    }

?>