<?php
session_start();

// Se a sessão do carrinho ainda não existir, cria uma vazia
if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}

// Corrigido: o nome do campo é "id_produto" (com underline)
if (!empty($_POST['id_produto'])) {
    $selecionados = $_POST['id_produto'];

    foreach ($selecionados as $id) {
        // Garante que a quantidade exista e seja válida
        $quantidade = isset($_POST['quantidade'][$id]) ? (int)$_POST['quantidade'][$id] : 1;

        if ($quantidade < 1) {
            $quantidade = 1;
        }

        // Se já tiver no carrinho, soma. Senão, adiciona.
        if (isset($_SESSION['carrinho'][$id])) {
            $_SESSION['carrinho'][$id] += $quantidade;
        } else {
            $_SESSION['carrinho'][$id] = $quantidade;
        }
    }
}

// Redireciona para o carrinho
header("Location: carrinho2.php");
exit;
