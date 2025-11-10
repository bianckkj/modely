<?php
// Inicia o buffer de saída para evitar erro de header
ob_start();

require_once "conexao.php";
require_once "../public/funcoes.php";

// Verifica se o parâmetro 'id' foi passado e é válido
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id <= 0) {
    header("Location: ../public/listar_usuario.php");
    exit;
}

// Tenta deletar o usuário
if (deletarUsuario($conexao, $id)) {
    header("Location: ../public/listar_usuario.php");
    exit;
} else {
    header("Location: ../public/home.php");
    exit;
}

// Envia o buffer e encerra
ob_end_flush();
?>
