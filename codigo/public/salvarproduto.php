<?php
$quantidade = $_GET['quantidade'];
$material = $_GET['material'];
$preco = $_GET['preco'];
$modelo = $_GET['modelo'];
$cor = $_GET['cor'];
$tamanho = $_GET['tamanho'];
$marca = $_GET['marca'];
$imagem = $_GET['imagem'];
require_once "../controle/conexao.php";

$sql = "INSERT INTO tb_produto (quantidade, material, preco, modelo, cor, tamanho, marca, imagem) VALUES ('$quantidade','$tamanho','$preco','$modelo','$cor','$tamanho','$marca','$imagem')";

mysqli_query($conexao, $sql);

header("Location: home.html");
?>