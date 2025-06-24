<?php

require_once "../conexao.php";
require_once "../funcoes.php";

$id_funcionario = 1;
$cpf = "123.456.789-00";
$email = "teste@teste.com";
$telefone = "11999990000";
$data_nascimento = "2000-01-01"; // YYYY-MM-DD
$carga_horaria = "08:00:00"; // HH:MM:SS
$salario = 2500.00; // sem aspas, é número
$endereco = "Rua Exemplo, 100";

editarFuncionarios($conexao,  $cpf, $email, $telefone, $data_nascimento, $carga_horaria, $salario, $endereco, $id_funcionario);
?>
