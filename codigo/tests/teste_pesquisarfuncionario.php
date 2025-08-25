<?php

require_once "../conexao.php";
require_once "../funcoes.php";

$id_funcionario = 1;

echo "<pre>";
print_r(pesquisarFuncionario($conexao, $id_funcionario));
echo "</pre>";
?>
