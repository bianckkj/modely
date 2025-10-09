<?php
require_once "../controle/conexao.php";

$id = $_GET['id'];
$nome = $_POST['nome'];
$quantidade = $_POST['quantidade'];
$material = $_POST['material'];
$preco = $_POST['preco'];
$modelo = $_POST['modelo'];
$cor = $_POST['cor'];
$tamanho = $_POST['tamanho'];
$marca = $_POST['marca'];
$imagem = $_POST['imagem'];


if ($id == 0) {
    // echo "novo";
    $sql = "INSERT INTO tb_produto (nome, quantidade, material, preco, modelo, cor, tamanho, marca, imagem) VALUES ('$nome', '$quantidade', $material, $preco, $modelo, $cor, $tamanho, $marca, $imagem)";
} else {
    // echo "atualizar";
    $sql = "UPDATE tb_produto SET nome = '$nome', quantidade = '$quantidade', material = $material, preco = $preco, modelo = $modelo, cor = $cor, tamanho = $tamanho, marca = $marca, imagem = $imagem WHERE id_produto = $id";
}


header("Location: ../public/listar_produtos.php");
?>

