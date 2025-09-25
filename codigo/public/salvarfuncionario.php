<?php
$nome = $_GET['nome'];
$cpf = $_GET['cpf'];
$email = $_GET['email'];
$telefone = $_GET['telefone'];
$data_nascimento = $_GET['data_nascimento'];
$cargo = $_GET['cargo'];
$carga_horaria = $_GET['carga_horaria'];
$salario = $_GET['salario'];
$endereco = $_GET['endereco'];
require_once "../controle/conexao.php";

$sql = "INSERT INTO tb_funcionario (nome, cpf, email, telefone, data_nascimento, cargo, carga_horaria, salario, endereco) VALUES ('$nome','$cpf','$email','$telefone','$data_nascimento','$cargo','$carga_horaria','$salario','$endereco')";

mysqli_query($conexao, $sql);

header("Location: home.php");
?>