<?php

require_once "../conexao.php";
require_once "../funcoes.php";

$id_vendas = 3;

echo "<pre>";
print_r(pesquisarVenda($conexao, $id_vendas));
echo "</pre>";
?>
