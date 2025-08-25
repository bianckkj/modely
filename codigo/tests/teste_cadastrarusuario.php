<?php
require_once "../conexao.php";
require_once "../funcoes.php";

mysqli_report(MYSQLI_REPORT_STRICT);

$nome_usuario = "Joao da Silva";
$senha = password_hash("123456");
$email_usuario = "joao@email.com";
$endereco_usuario = "Rua Nova, 456";

cadastrarUsuario($conexao, $nome_usuario, $senha, $email_usuario, $endereco_usuario);