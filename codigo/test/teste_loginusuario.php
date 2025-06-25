<?php

require_once "../conexao.php";
require_once "../funcoes.php";

$id_usuario = 1;
$email = "fulado@gmail.com";
$senha = "123";

loginUsuario($conexao, $email, $senha);