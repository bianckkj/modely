<?php
// Inicia o buffer de saída
ob_start();

require_once "../controle/conexao.php";
require_once "../public/funcoes.php";

$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: ../public/listar_cliente.php");
    exit;
}

if (deletarCliente($conexao, $id)) {
    header("Location: ../public/listar_cliente.php");
    exit;
} else {
    header("Location: home.php");
    exit;
}

// Libera o buffer e envia a saída
ob_end_flush();
?>
