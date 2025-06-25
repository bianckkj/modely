<?php
require_once "../conexao.php";
require_once "../funcoes.php";

$id_funcionario = 2;
$valor = "12";
$data = "2025-06-25";


$id_funcionario = registrarComissao($conexao, $id_funcionario, $valor, $data,);

echo $id_funcionario;
?>
