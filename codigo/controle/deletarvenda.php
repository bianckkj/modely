<?php
require_once "conexao.php";
require_once "../public/funcoes.php";

// Verifica se o parâmetro id foi passado
if (!isset($_GET['id'])) {
    // Redireciona de volta se não tiver id
    header("Location: ../public/listar_venda.php");
    exit;
}

// Força inteiro (prevenção básica)
$id = (int) $_GET['id'];

if ($id <= 0) {
    header("Location: ../public/listar_venda.php");
    exit;
}

// Chama a função de deletar (assumindo que deletarVenda espera $conexao e o id)
if (deletarVenda($conexao, $id)) {
    header("Location: ../public/listar_venda.php");
    exit;
} else {
    // Você pode criar uma página de erro ou voltar pra listar com uma flag
    header("Location: ../public/home.php");
    exit;
}
