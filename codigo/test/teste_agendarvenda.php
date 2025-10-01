<?php

require_once "../conexao.php";
require_once "../funcoes.php";

$id_cliente = 1;
$data = "2025-06-25";
$horario = "10:00";
$status = "Confirmado";

agendarvenda($conexao, $id_cliente, $data, $horario, $status);