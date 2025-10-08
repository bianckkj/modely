<?php
require_once "../controle/conexao.php";

$nome = $_GET['nome'];
$quantidade = $_GET['quantidade'];
$material = $_GET['material'];
$preco = $_GET['preco'];
$modelo = $_GET['modelo'];
$cor = $_GET['cor'];
$tamanho = $_GET['tamanho'];
$marca = $_GET['marca'];
$imagem = $_GET['imagem'];


if ($id == 0) {
    // echo "novo";
    $sql = "INSERT INTO tb_produto (nome, quantidade, material, preco, modelo, cor, tamanho, marca, imagem) VALUES ('$nome', '$quantidade', $material, $preco, $modelo, $cor, $tamanho, $marca, $imagem)";
} else {
    // echo "atualizar";
    $sql = "UPDATE tb_produto SET nome = '$nome', quantidade = '$quantidade', material = $material, preco = $preco, modelo = $modelo, cor = $cor, tamanho = $tamanho, marca = $marca, imagem = $imagem WHERE id_produto = $id";
}


mysqli_query($conexao, $sql);


header("Location: home.html");
?>