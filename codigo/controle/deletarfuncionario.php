<?php
ob_start(); // inicia buffer

require_once "conexao.php";
require_once "../public/funcoes.php";

$id = $_GET['id'];

if (deletarFuncionario($conexao, $id)) {
    header("Location: ../public/listar_funcionario.php");
} else {
    header("Location: ../public/home.php");
}

ob_end_flush(); // envia o buffer
?>
