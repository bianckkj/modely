<?php
session_start();
require_once "../controle/conexao.php";
require_once "../public/funcoes.php";
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finalizar Compra - MODELY</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Ícones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Estilos -->
    <link rel="stylesheet" href="../public/css/header.css">
    <link rel="stylesheet" href="../public/css/styles.css">
</head>

<body class="bg-light">

    <!-- Header -->
    <?php require_once '../public/templates/header.html'; ?>

    <div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="card shadow-lg border-0" style="max-width: 600px; width: 100%;">
            <div class="card-header bg-dark text-white text-center">
                <h4 class="mb-0"><i class="fas fa-credit-card"></i> Finalizando Compra</h4>
            </div>
            <div class="card-body text-center bg-white">
                <?php
                // Verifica se o carrinho está vazio
                if (empty($_SESSION['carrinho'])) {
                    echo "<div class='alert alert-secondary'>O carrinho está vazio. Adicione produtos antes de finalizar a compra.</div>";
                } else {
                    $id_cliente = $_SESSION['id_cliente'] ?? 1;
                    $id_funcionario = $_SESSION['id_funcionario'] ?? 1;
                    $data = date('Y-m-d');
                    $horario = date('H:i:s');
                    $comissao = 0;

                    // Cria a venda
                    $stmt = $conexao->prepare("
                        INSERT INTO tb_vendas (id_cliente, id_funcionario, data, horario, comissao)
                        VALUES (?, ?, ?, ?, ?)
                    ");

                    if (!$stmt) {
                        echo "<div class='alert alert-danger'>Erro na preparação da venda: " . $conexao->error . "</div>";
                        exit;
                    }

                    $stmt->bind_param("iissd", $id_cliente, $id_funcionario, $data, $horario, $comissao);

                    if (!$stmt->execute()) {
                        echo "<div class='alert alert-danger'>Erro ao registrar venda: " . $stmt->error . "</div>";
                        exit;
                    }

                    $id_venda = $stmt->insert_id;
                    $stmt->close();

                    // Insere os itens
                    foreach ($_SESSION['carrinho'] as $id_produto => $quantidade) {
                        $stmt_item = $conexao->prepare("
                            INSERT INTO tb_itens_vendas (id_vendas, id_produto, quantidade)
                            VALUES (?, ?, ?)
                        ");

                        if (!$stmt_item) {
                            echo "<div class='alert alert-danger'>Erro na preparação dos itens: " . $conexao->error . "</div>";
                            exit;
                        }

                        $stmt_item->bind_param("iii", $id_venda, $id_produto, $quantidade);

                        if (!$stmt_item->execute()) {
                            echo "<div class='alert alert-danger'>Erro ao inserir item: " . $stmt_item->error . "</div>";
                            exit;
                        }

                        $stmt_item->close();
                    }

                    // Limpa o carrinho
                    unset($_SESSION['carrinho']);

                    echo "
                        <div class='alert alert-success'>
                            <h5 class='mb-3'><i class='fas fa-check-circle'></i> Compra realizada com sucesso!</h5>
                            <p>Seu pedido foi registrado no sistema.</p>
                        </div>

                        <a href='../public/home.php' class='btn btn-dark btn-lg mt-3'>
                            <i class='fas fa-arrow-left'></i> Voltar à Loja
                        </a>
                    ";
                }
                ?>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
