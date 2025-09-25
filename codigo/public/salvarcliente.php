<?php
$nome = $_GET['nome'];
$cpf = $_GET['cpf'];
$telefone = $_GET['telefone'];
$email = $_GET['email'];
$endereco = $_GET['endereco'];
require_once "../controle/conexao.php";

$sql = "INSERT INTO tb_cliente (nome, cpf, telefone, email, endereco) VALUES ('$nome','$cpf','$telefone','$email','$endereco')";

mysqli_query($conexao, $sql);

header("Location: home.php");
?>