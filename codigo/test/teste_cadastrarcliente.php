<?php
require_once "../conexao.php";
require_once "../funcoes.php"; 

mysqli_report(MYSQLI_REPORT_STRICT);

$id_cliente = 1;
$nome = "Carlos Silva";
$cpf = "111.122.333-54";
$telefone = "(11)91234-5678";
$email = "carlos@email.com";
$endereco = "Rua das Palmeiras, 150";

$resultado = cadastrarCliente($conexao, $nome, $cpf, $telefone, $email, $endereco);