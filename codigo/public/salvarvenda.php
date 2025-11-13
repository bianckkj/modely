<?php
require_once "../controle/conexao.php";
require_once "../public/funcoes.php";

// aceita apenas POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    // Se quiser ver uma mensagem amigável em tela, comente a linha abaixo e descomente o echo.
    // echo "Método inválido. Envie o formulário corretamente.";
    http_response_code(405);
    exit;
}

// pegar dados do formulário (compatível com duas possibilidades)
$id_cliente    = $_POST['id_cliente']    ?? null;
$id_funcionario= $_POST['id_funcionario']?? null;
$data          = $_POST['data']          ?? date('Y-m-d');
$horario       = $_POST['horario']       ?? date('H:i:s');

// suporte a dois formatos:
// 1) Arrays: produtos[] e quantidades[] (carrinho)
// 2) Simples: id_produto e quantidade (formulário único)
$produtos_arr   = $_POST['produtos']   ?? null; // espera array
$quantidades_arr= $_POST['quantidades']?? null; // espera array

// caso formulário simples:
$id_produto_simples = $_POST['id_produto'] ?? null;
$quantidade_simples = $_POST['quantidade'] ?? null;

// validações básicas
if (empty($id_cliente) || empty($id_funcionario)) {
    // não dá output antes do header/redirect; aqui apenas interrompe com mensagem curta
    http_response_code(400);
    echo "Erro: cliente ou funcionário não informado.";
    exit;
}

// normaliza arrays de produtos/quantidades para uso posterior
$produtos = [];
$quantidades = [];

// se vierem arrays (carrinho)
if (is_array($produtos_arr) && count($produtos_arr) > 0) {
    $produtos = $produtos_arr;
    $quantidades = is_array($quantidades_arr) ? $quantidades_arr : [];
} elseif (!empty($id_produto_simples)) {
    // se veio um produto simples
    $produtos = [$id_produto_simples];
    $quantidades = [$quantidade_simples ?? 1];
}

// Calcula total da venda (para comissão)
$total_venda = 0.0;
if (!empty($produtos)) {
    foreach ($produtos as $idx => $id_prod) {
        $id_prod = (int) $id_prod;
        $q = isset($quantidades[$idx]) ? (int)$quantidades[$idx] : 1;

        // pega o preço do produto
        $sql_preco = "SELECT preco FROM tb_produto WHERE id_produto = ?";
        if ($stmt_preco = $conexao->prepare($sql_preco)) {
            $stmt_preco->bind_param("i", $id_prod);
            $stmt_preco->execute();
            $res_preco = $stmt_preco->get_result();
            if ($row = $res_preco->fetch_assoc()) {
                $preco = (float) $row['preco'];
                $total_venda += $preco * $q;
            }
            $stmt_preco->close();
        }
    }
}

// calcula comissão como 10% do total (ajuste se quiser outro cálculo)
$comissao = $total_venda * 0.10;

// Inserir venda
$sql_venda = "INSERT INTO tb_vendas (id_cliente, id_funcionario, data, horario, comissao) VALUES (?, ?, ?, ?, ?)";
if ($stmt_venda = $conexao->prepare($sql_venda)) {
    $stmt_venda->bind_param("iissd", $id_cliente, $id_funcionario, $data, $horario, $comissao);
    $stmt_venda->execute();
    $id_venda = $conexao->insert_id;
    $stmt_venda->close();
} else {
    // erro ao preparar
    http_response_code(500);
    echo "Erro ao processar venda.";
    exit;
}

// Inserir itens (se houver)
if (!empty($produtos)) {
    foreach ($produtos as $idx => $id_prod) {
        $id_prod = (int) $id_prod;
        $q = isset($quantidades[$idx]) ? (int)$quantidades[$idx] : 1;

        $sql_item = "INSERT INTO tb_itens_vendas (id_vendas, id_produto, quantidade) VALUES (?, ?, ?)";
        if ($stmt_item = $conexao->prepare($sql_item)) {
            $stmt_item->bind_param("iii", $id_venda, $id_prod, $q);
            $stmt_item->execute();
            $stmt_item->close();

            // atualizar estoque (opcional, se quiser)
            $sql_estoque = "UPDATE tb_produto SET quantidade = quantidade - ? WHERE id_produto = ?";
            if ($stmt_estoque = $conexao->prepare($sql_estoque)) {
                $stmt_estoque->bind_param("ii", $q, $id_prod);
                $stmt_estoque->execute();
                $stmt_estoque->close();
            }
        }
    }
}

// tudo OK — redireciona sem ter enviado nada antes
$conexao->close();
header("Location: ../public/listar_venda.php?msg=Venda+cadastada+com+sucesso");
exit;
