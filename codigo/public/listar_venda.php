<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Vendas</title>

    <!-- Bootstrap e Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Seus arquivos CSS -->
    <link rel="stylesheet" href="../public/css/header.css">
    <link rel="stylesheet" href="../public/css/styles.css">
</head>

<body class="bg-light">

    <!-- Logo e cabeçalho -->
    <img src="../public/assets/logo.png" alt="logo do site" id="logo" class="d-block mx-auto my-3" style="max-height:80px;">
    <?php require_once './templates/header.html'; ?>

    <div class="container mt-5 mb-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="text-dark mb-0">Listar Vendas</h1>
            <a href="../public/cadastrar_vendas.php" class="btn btn-dark">
                <i class="fas fa-plus"></i> Nova Venda
            </a>
        </div>

        <?php
        require_once "../controle/conexao.php";
        require_once "../public/funcoes.php";

        // Busca todas as vendas com nome do cliente e do funcionário
        $sql_vendas = "
            SELECT 
                v.id_vendas,
                c.nome AS nome_cliente,
                f.nome AS nome_funcionario,
                v.horario,
                v.data,
                v.comissao
            FROM tb_vendas v
            INNER JOIN tb_cliente c ON v.id_cliente = c.id_cliente
            INNER JOIN tb_funcionario f ON v.id_funcionario = f.id_funcionario
            ORDER BY v.data ASC, v.horario ASC
        ";
        $result_vendas = $conexao->query($sql_vendas);

        if ($result_vendas->num_rows == 0) {
            echo "<div class='alert alert-secondary text-center'>Não existem vendas cadastradas.</div>";
        } else {
        ?>
            <div class="table-responsive shadow-sm rounded mb-5">
                <table class="table table-hover table-striped align-middle text-center">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID Venda</th>
                            <th>Cliente</th>
                            <th>Funcionário</th>
                            <th>Produtos e Quantidades</th>
                            <th>Horário</th>
                            <th>Data</th>
                            <th>Comissão</th>
                            <th colspan="2">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($vendas = $result_vendas->fetch_assoc()) {
                            $id_vendas = $vendas['id_vendas'];
                            $nome_cliente = htmlspecialchars($vendas['nome_cliente']);
                            $nome_funcionario = htmlspecialchars($vendas['nome_funcionario']);
                            $horario = htmlspecialchars($vendas['horario']);
                            $data = htmlspecialchars($vendas['data']);
                            $comissao = $vendas['comissao'];

                            // busca os produtos dessa venda
                            $sql_itens = "
                                SELECT p.nome AS nome_produto, iv.quantidade, p.preco
                                FROM tb_itens_vendas iv
                                INNER JOIN tb_produto p ON iv.id_produto = p.id_produto
                                WHERE iv.id_vendas = $id_vendas
                            ";
                            $result_itens = $conexao->query($sql_itens);

                            $itens_lista = [];
                            $total_venda = 0;

                            if ($result_itens && $result_itens->num_rows > 0) {
                                while ($item = $result_itens->fetch_assoc()) {
                                    $subtotal = $item['preco'] * $item['quantidade'];
                                    $total_venda += $subtotal;
                                    $itens_lista[] = "{$item['nome_produto']} (Qtd: {$item['quantidade']})";
                                }
                            }

                            if (empty($comissao) || $comissao == 0) {
                                $comissao = $total_venda * 0.10;
                            }

                            echo "
                            <tr>
                                <td>$id_vendas</td>
                                <td class='font-weight-bold text-dark'>$nome_cliente</td>
                                <td>$nome_funcionario</td>
                                <td>";
                            echo !empty($itens_lista) ? implode('<br>', $itens_lista) : "Nenhum produto vinculado.";
                            echo "</td>
                                <td>$horario</td>
                                <td>$data</td>
                                <td>R$ " . number_format($comissao, 2, ',', '.') . "</td>
                                <td>
                                    <a href='../public/cadastrar_vendas.php?id=$id_vendas' class='btn btn-outline-dark btn-sm'>
                                        <i class='fas fa-edit'></i> Editar
                                    </a>
                                </td>
                                <td>
                                    <a href='../controle/deletarvenda.php?id=$id_vendas' class='btn btn-dark btn-sm' onclick=\"return confirm('Tem certeza que deseja excluir esta venda?');\">
                                        <i class='fas fa-trash-alt'></i> Excluir
                                    </a>
                                </td>
                            </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        <?php
        }

        // --- VENDAS FEITAS PELO CARRINHO ---
        echo "<hr class='my-5'>
              <h2 class='text-center text-dark mb-4'>Vendas Feitas pelo Carrinho</h2>";

        $sql_carrinho = "
            SELECT v.id_vendas, v.data, v.comissao
            FROM tb_vendas v
            ORDER BY v.data ASC, v.horario ASC
        ";
        $result_carrinho = $conexao->query($sql_carrinho);

        if ($result_carrinho && $result_carrinho->num_rows > 0) {
        ?>
            <div class="table-responsive shadow-sm rounded">
                <table class="table table-hover table-striped align-middle text-center">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Data</th>
                            <th>Comissão</th>
                            <th>Produtos</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($venda = $result_carrinho->fetch_assoc()) {
                            $id_vendas = $venda['id_vendas'];
                            $data = htmlspecialchars($venda['data']);
                            $comissao = $venda['comissao'];

                            $sql_itens_carrinho = "
                                SELECT p.nome, iv.quantidade, p.preco
                                FROM tb_itens_vendas iv
                                JOIN tb_produto p ON iv.id_produto = p.id_produto
                                WHERE iv.id_vendas = $id_vendas
                            ";
                            $result_itens_carrinho = $conexao->query($sql_itens_carrinho);

                            $total_venda = 0;
                            if ($result_itens_carrinho && $result_itens_carrinho->num_rows > 0) {
                                while ($item = $result_itens_carrinho->fetch_assoc()) {
                                    $total_venda += $item['preco'] * $item['quantidade'];
                                }
                            }

                            if (empty($comissao) || $comissao == 0) {
                                $comissao = $total_venda * 0.10;
                            }

                            echo "
                            <tr>
                                <td>$id_vendas</td>
                                <td>$data</td>
                                <td>R$ " . number_format($comissao, 2, ',', '.') . "</td>
                                <td>";
                            $result_itens_carrinho = $conexao->query($sql_itens_carrinho);
                            if ($result_itens_carrinho && $result_itens_carrinho->num_rows > 0) {
                                while ($item = $result_itens_carrinho->fetch_assoc()) {
                                    echo "{$item['nome']} (Qtd: {$item['quantidade']})<br>";
                                }
                            } else {
                                echo "Sem itens.";
                            }
                            echo "</td>
                            </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        <?php
        } else {
            echo "<div class='alert alert-secondary text-center'>Nenhuma venda feita pelo carrinho ainda.</div>";
        }
        ?>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
