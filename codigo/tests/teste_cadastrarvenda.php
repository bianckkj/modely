<?php
require_once "../conexao.php";
require_once "../funcoes.php";

mysqli_report(MYSQLI_REPORT_STRICT);

$idcliente = 1;
$idfuncionario = 1;
$horario = "14:30:00";
$data = "2025-06-25";
$comissao = 150.50;

cadastrarVenda($conexao, $idcliente, $idfuncionario, $horario, $data, $comissao);
