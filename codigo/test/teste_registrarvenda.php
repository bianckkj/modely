<?php
require_once "../conexao.php";
require_once "../funcoes.php";

$tb_cliente_id_cliente = 1;
$tb_funcionario_id_funcionario = 2;
$horario = "12:00";
$data = "2025-06-25";
$comissao = "20";


$id_vendas = registrarVenda($conexao, $tb_cliente_id_cliente, $tb_funcionario_id_funcionario, $horario, $data, $comissao);

echo $id_vendas;
?>
