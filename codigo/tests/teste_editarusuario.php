<?php

require_once "../conexao.php";
require_once "../funcoes.php";

$id_usuario = 1;
$nome = "joao";
$senha = "123";
$email = "fulano@gmail.com"; 
$endereco = "Rua Exemplo, 100";

editarUsuario($conexao, $nome, $senha, $email, $endereco, $id_usuario);
?>
