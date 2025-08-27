<?php
// require_once "../controle/conexao.php";
require_once "../conexao.php";
require_once "../funcoes.php";

$id = $_GET['id'];

if (deletarCliente($conexao, $id)) {
    header("Location: listar_cliente.php");
} else {
    header("Location: erro.php");
}
?>