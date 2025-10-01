<?php
require_once "../conexao.php";
require_once "../funcoes.php";

mysqli_report(MYSQLI_REPORT_STRICT); 

$quantidade = "10";
$material = "Algodão";
$preco = 120.00;
$modelo = "Camisa Polo";
$cor = "Azul";
$tamanho = "M";
$marca = "MarcaX";
$imagem = 0;
$resultado = cadastrarProduto($conexao, $quantidade, $material, $preco, $modelo, $cor, $tamanho, $marca, $imagem);