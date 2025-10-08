<?php
require_once "../controle/conexao.php";
require_once "../public/funcoes.php";

$id_cliente = $_GET['id_cliente'];
$id_funcionario = $_GET['id_funcionario'];
$horario = $_GET['horario'];
$data = $_GET['data'];
$comissao = $_GET['comissao'];

$idprodutos = $_GET['idproduto'];
$quantidades = $_GET['quantidade'];

foreach ($idprodutos as $id) {
    $produtos[] = [$id, $quantidades[$id]];
}

//gravar a venda
/*$id_vendas = salvarVenda($id_cliente, $id_funcionario, $horario, $data, $comissao);*/

//gravar os itens da venda
foreach ($produtos as $p) {
    salvarItemVenda($conexao, $id_vendas, $p[0], $p[1]);
}
?>