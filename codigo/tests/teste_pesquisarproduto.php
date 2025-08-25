<?php

require_once "../conexao.php";
require_once "../funcoes.php";

$id_produto = 1;

echo "<pre>";
print_r(pesquisarProduto($conexao, $id_produto));
echo "</pre>";
?>
