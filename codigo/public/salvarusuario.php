<?php

require_once "../controle/conexao.php";

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$endereco = $_POST['endereco'];



$senha_hash = password_hash($senha, PASSWORD_DEFAULT);

$sql = "INSERT INTO tb_usuario (nome, email, senha, endereco, tipo) VALUES ('$nome', '$email', '$senha_hash', '$endereco', 'c')";

mysqli_query($conexao, $sql);

header("Location: ../public/index.php");
?>