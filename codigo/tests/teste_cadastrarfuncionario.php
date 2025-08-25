<?php
require_once "../conexao.php";
require_once "../funcoes.php";

mysqli_report(MYSQLI_REPORT_STRICT);


$cpf = "222.333.444-55";
$email = "funcionario@email.com";
$telefone = "(11)99887-6655";
$data_nascimento = "1990-05-10";
$carga_horaria = "08:00:00";
$salario = 2500.00;
$endereco = "Av. Central, 123";

cadastrarFuncionario($conexao, $cpf, $email, $telefone, $data_nascimento, $carga_horaria, $salario, $endereco);