<?php

require_once "../conexao.php";
require_once "../funcoes.php";

$id_usuario = 1;

echo "<pre>";
print_r(pesquisarUsuario($conexao, $id_usuario));
echo "</pre>";
?>
