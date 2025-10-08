<?php
require_once "../controle/conexao.php";

$quantidade = $_GET['quantidade'];
$material = $_GET['material'];
$preco = $_GET['preco'];
$modelo = $_GET['modelo'];
$cor = $_GET['cor'];
$tamanho = $_GET['tamanho'];
$marca = $_GET['marca'];
$imagem = $_GET['imagem'];
require_once "../controle/conexao.php";

if ($id == 0) {
    // echo "novo";
    $sql = "INSERT INTO tb_produto (quantidade, material, preco, modelo, cor, tamanho, marca) VALUES ('$nome', '$tipo', $preco_compra, $preco_venda, $margem_lucro, $quantidade)";
} else {
    // echo "atualizar";
    $sql = "UPDATE tb_produto SET nome = '$nome', tipo = '$tipo', preco_compra = $preco_compra, preco_venda = $preco_venda, margem_lucro = $margem_lucro, quantidade = $quantidade WHERE idproduto = $id";
}


mysqli_query($conexao, $sql);


header("Location: home.html");
?>