<?php
require_once "../conexao.php";
require_once "../funcoes.php"; 

$id_usuario = 1;
$nome = "João Silva";
$email = "joao@email.com";
$senha = "minhasenha123";

aprovarUsuario($conexao, $nome, $usuario, $senha);