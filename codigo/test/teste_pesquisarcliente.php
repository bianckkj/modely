<?php

require_once "../conexao.php";
require_once "../funcoes.php";

$id_cliente = 2;

echo "<pre>";
print_r(pesquisarCliente($conexao, $id_cliente));
echo "</pre>";
?>
