<?php

require_once "../conexao.php";
require_once "../funcoes.php";

$id_cliente = 1;
$nome = "joao";
$cpf = "234.123.443-33";
$telefone = "62999348761";
$email = "fulano@gmail.com"; 
$endereco = "Rua Exemplo, 100";

editarClientes($conexao, $nome, $cpf, $telefone, $email, $endereco, $id_cliente);
?>
