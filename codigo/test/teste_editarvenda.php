<?php

require_once "../conexao.php";
require_once "../funcoes.php";

$tb_cliente_id_cliente = 1;
$tb_funcionario_id_funcionario = 1;
$horario = "10:20";
$data = "01.02.07";
$comissao = "10000";
$id_vendas = 1;

editarvendas($conexao, $tb_cliente_id_cliente, $tb_funcionario_id_funcionario, $horario, $data, $comissao, $id_vendas);