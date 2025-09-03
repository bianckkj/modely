<?php
$id_cliente = $_GET['id_cliente'];
$id_funcionario = $_GET['id_funcionario'];
$data_hora = $_GET['data'];
$comissao = $_GET['comissao'];
require_once "../controle/conexao.php";

$sql = "INSERT INTO tb_vendas (id_cliente, id_funcionario, data_hora, comissao) VALUES ('$id_cliente','$id_funcionario','$data_hora','$comissao')";

mysqli_query($conexao, $sql);

header("Location: home.html");
?>