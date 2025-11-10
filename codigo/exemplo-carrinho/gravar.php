<?php
session_start();
require_once "../controle/conexao.php";
require_once "../public/funcoes.php";

// Verifica se o carrinho está vazio
if (empty($_SESSION['carrinho'])) {
    echo "❌ O carrinho está vazio. Adicione produtos antes de finalizar a compra.";
    exit;
}

// --- Cria uma venda ---
$id_cliente = $_SESSION['id_cliente'] ?? 1; // usa cliente 1 por padrão se não tiver login
$id_funcionario = $_SESSION['id_funcionario'] ?? 1; // opcional, se houver login de funcionário
$data = date('Y-m-d');
$horario = date('H:i:s');
$comissao = 0;

// Cria a venda na tabela tb_vendas
$stmt = $conexao->prepare("
    INSERT INTO tb_vendas (id_cliente, id_funcionario, data, horario, comissao)
    VALUES (?, ?, ?, ?, ?)
");

if (!$stmt) {
    die("Erro na preparação do INSERT em tb_vendas: " . $conexao->error);
}

$stmt->bind_param("iissd", $id_cliente, $id_funcionario, $data, $horario, $comissao);

if (!$stmt->execute()) {
    die("Erro ao inserir venda: " . $stmt->error);
}

$id_venda = $stmt->insert_id; // ID da venda recém-criada
$stmt->close();

// --- Insere os itens da venda ---
foreach ($_SESSION['carrinho'] as $id_produto => $quantidade) {

    $stmt_item = $conexao->prepare("
        INSERT INTO tb_itens_vendas (id_vendas, id_produto, quantidade)
        VALUES (?, ?, ?)
    ");

    if (!$stmt_item) {
        die("Erro na preparação do INSERT em tb_itens_vendas: " . $conexao->error);
    }

    $stmt_item->bind_param("iii", $id_venda, $id_produto, $quantidade);

    if (!$stmt_item->execute()) {
        die("Erro ao inserir item da venda: " . $stmt_item->error);
    }

    $stmt_item->close();
}

// Limpa o carrinho após gravar a venda
unset($_SESSION['carrinho']);

echo "✅ Venda gravada com sucesso!<br>";
echo "<a href='index.php'>Voltar à loja</a>";
?>
