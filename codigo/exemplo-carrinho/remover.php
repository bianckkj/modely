<?php
session_start();

$id = $_GET['id'] ?? null;

if ($id && isset($_SESSION['carrinho'][$id])) {
    unset($_SESSION['carrinho'][$id]);
}

header("Location: carrinho2.php");
exit;

