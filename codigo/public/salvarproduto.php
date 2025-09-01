<?php
$quantidade = $_GET['estilo'];
$material = $_GET['tamanho'];
$preco = $_GET['modelo'];
$modelo = $_GET['marca'];
$cor = $_GET['cor'];
$tamanho = $_GET['tamanho'];
$marca = $_GET['marca'];
$imagem = $_GET['imagem'];
require_once "conexao.php";

$sql = "INSERT INTO Roupas (quantidade, material, preco, modelo, cor, tamanho, marca, imagem) VALUES ('$quantidade','$tamanho','$preco','$modelo','$cor','$tamanho','$marca','$imagem')";

mysqli_query($conexao, $sql);

header("Location: home.html");
?>