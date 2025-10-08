<?php
<<<<<<< Updated upstream
    require_once "../controle/conexao.php";
=======
    require_once "conexao.php";
>>>>>>> Stashed changes
    require_once "../public/funcoes.php";

    $id = $_GET['id'];

    if (deletarCliente($conexao, $id)) {
        header("Location: ../public/listar_cliente.php");
    }
    else {
        header("Location: erro.php");
    }

?>