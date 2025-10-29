<?php
require_once "../controle/conexao.php";
require_once "../public/funcoes.php";

// Recebe os dados da venda via GET
$id_cliente = $_GET['id_cliente'] ?? null;
$id_funcionario = $_GET['id_funcionario'] ?? null;
$horario = $_GET['horario'] ?? null;
$data = $_GET['data'] ?? null;
$comissao = $_GET['comissao'] ?? null;

// Recebe os produtos e quantidades
$idprodutos = $_GET['idproduto'] ?? [];
$quantidades = $_GET['quantidade'] ?? [];

// Se vierem valores únicos, transforma em arrays
if (!is_array($idprodutos)) $idprodutos = [$idprodutos];
if (!is_array($quantidades)) $quantidades = [$quantidades];

// Monta o array de produtos
$produtos = [];
foreach ($idprodutos as $i => $id) {
    $qtd = $quantidades[$i] ?? 1;
    $produtos[] = [$id, $qtd];
}

// --- Validação básica ---
if (!$id_cliente || !$id_funcionario || !$data || !$horario) {
    die("Erro: dados da venda incompletos!");
}

if (empty($produtos)) {
    die("Erro: nenhum produto informado!");
}

// --- Grava a venda ---
$id_vendas = salvaVenda($id_cliente, $id_funcionario, $horario, $data, $comissao);

if (!$id_vendas) {
    die("Erro ao salvar venda!");
}

// --- Grava os itens da venda ---
foreach ($produtos as $p) {
    salvarItemVenda($conexao, $id_vendas, $p[0], $p[1]);
}

echo "Venda registrada com sucesso! ID da venda: " . $id_vendas;
?>


header("Location: ../public/listar_venda.php");
?>
