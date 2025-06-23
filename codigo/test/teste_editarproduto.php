<?php

require_once "../conexao.php";
require_once "../funcoes.php";

$id_produto = 1;
$quantidade = "1";
$material = "Rua";
$preco = "1000";
$modelo = "tal";
$cor = "azul";
$tamanho = "aaaa";
$marca = "tal";
$imagem = "12";

editarProduto($conexao, $quantidade, $material, $preco, $modelo, $cor, $tamanho, $marca, $imagem, $id_produto);