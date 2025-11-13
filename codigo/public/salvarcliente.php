<?php
require_once "../controle/conexao.php";
require_once "funcoes.php";

$id = $_GET['id'];
$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];
$endereco = $_POST['endereco'];



if ($id == 0) {
    // echo "novo";
    $sql = "INSERT INTO tb_cliente (nome, cpf, telefone, email, endereco) VALUES ('$nome','$cpf','$telefone','$email','$endereco')";
} else {
    // echo "atualizar";
    $sql = "UPDATE tb_cliente SET nome = '$nome', cpf = '$cpf', telefone = '$telefone', email = '$email', endereco = '$endereco' WHERE id_cliente = $id";
}

mysqli_query($conexao, $sql);

header("Location: ../public/listar_cliente.php");
?>