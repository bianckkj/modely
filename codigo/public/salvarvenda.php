<?php
require_once "../controle/conexao.php";
require_once "../public/funcoes.php";

// Recebe os dados do formulário via POST
$id_cliente     = $_POST['id_cliente']     ?? null;
$id_funcionario = $_POST['id_funcionario'] ?? null;
$id_produto     = $_POST['id_produto']     ?? null;
$quantidade     = $_POST['quantidade']     ?? null;
$horario        = $_POST['horario']        ?? null;
$data           = $_POST['data']           ?? null;
$comissao       = $_POST['comissao']       ?? 0;

// --- Validação básica ---
if (!$id_cliente || !$id_funcionario || !$id_produto || !$quantidade || !$data || !$horario) {
    echo "<script>alert('Erro: dados da venda incompletos!'); history.back();</script>";
    exit;
}

// --- Grava a venda ---
$sql_venda = "INSERT INTO tb_vendas (id_cliente, id_funcionario, data, horario, comissao)
              VALUES ('$id_cliente', '$id_funcionario', '$data', '$horario', '$comissao')";

if (!$conexao->query($sql_venda)) {
    echo "<script>alert('Erro ao registrar venda: " . addslashes($conexao->error) . "'); history.back();</script>";
    exit;
}

$id_vendas = $conexao->insert_id;

// --- Grava o item da venda ---
$sql_item = "INSERT INTO tb_itens_vendas (id_vendas, id_produto, quantidade)
             VALUES ('$id_vendas', '$id_produto', '$quantidade')";



// --- Atualiza estoque ---
$sql_estoque = "UPDATE tb_produto SET quantidade = quantidade - $quantidade WHERE id_produto = $id_produto";
$conexao->query($sql_estoque);

header("Location: ../public/listar_venda.php");


?>
