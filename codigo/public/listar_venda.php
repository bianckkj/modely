<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Vendas</title>

    <!-- Bootstrap e Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Seus arquivos CSS -->
    <link rel="stylesheet" href="../public/css/header.css">
    <link rel="stylesheet" href="../public/css/styles.css">
</head>

<body>

    <!-- Logo e cabeçalho -->
    <img src="../public/assets/logo.png" alt="logo do site" id="logo" class="mb-4">
    <?php require_once './templates/header.html'; ?>

    <h1>Listar Vendas</h1>

    <?php
    require_once "../controle/conexao.php";
    require_once "../public/funcoes.php";

    // Busca todas as vendas já com nome do cliente e do funcionário
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
        echo "<p>Não existem vendas cadastradas.</p>";
    } else {
        echo "<table border='1' cellpadding='5' cellspacing='0'>";
        echo "<tr>
                <th>ID Venda</th>
                <th>Cliente</th>
                <th>Funcionário</th>
                <th>Produtos e Quantidades</th>
                <th>Horário</th>
                <th>Data</th>
                <th>Comissão</th>
                <th colspan='2'>Ação</th>
              </tr>";

        while ($vendas = $result_vendas->fetch_assoc()) {
            $id_vendas = $vendas['id_vendas'];
            $nome_cliente = $vendas['nome_cliente'];
            $nome_funcionario = $vendas['nome_funcionario'];
            $horario = $vendas['horario'];
            $data = $vendas['data'];
            $comissao = $vendas['comissao'];

            // busca os produtos dessa venda com o nome
            $sql_itens = "
                SELECT p.nome AS nome_produto, iv.quantidade, p.preco
                FROM tb_itens_vendas iv
                INNER JOIN tb_produto p ON iv.id_produto = p.id_produto
                WHERE iv.id_vendas = $id_vendas
            ";
            $result_itens = $conexao->query($sql_itens);

            // calcula o total da venda para estimar comissão, caso não tenha sido gravada
            $total_venda = 0;
            if ($result_itens && $result_itens->num_rows > 0) {
                while ($item = $result_itens->fetch_assoc()) {
                    $subtotal = $item['preco'] * $item['quantidade'];
                    $total_venda += $subtotal;
                    $itens_lista[] = "Produto: {$item['nome_produto']} (Qtd: {$item['quantidade']})";
                }
            }

            // Se comissão estiver vazia ou zero, calcula 10% do total
            if (empty($comissao) || $comissao == 0) {
                $comissao = $total_venda * 0.10;
            }

            echo "<tr>";
            echo "<td>$id_vendas</td>";
            echo "<td>$nome_cliente</td>";
            echo "<td>$nome_funcionario</td>";

            echo "<td>";
            if (!empty($itens_lista)) {
                echo implode('<br>', $itens_lista);
            } else {
                echo "Nenhum produto vinculado.";
            }
            echo "</td>";

            echo "<td>$horario</td>";
            echo "<td>$data</td>";
            echo "<td>R$ " . number_format($comissao, 2, ',', '.') . "</td>";
            echo "<td><a href='../public/cadastrar_vendas.php?id=$id_vendas'>Editar</a></td>";
            echo "<td><a href='../controle/deletarvenda.php?id=$id_vendas'>Excluir</a></td>";
            echo "</tr>";

            // limpa array de itens antes da próxima venda
            unset($itens_lista);
        }

        echo "</table>";
    }

  
    // MOSTRA AS VENDAS FEITAS PELO CARRINHO // 
    echo "<br><hr><h2>Vendas Feitas pelo Carrinho</h2>";

    $sql_carrinho = "
        SELECT v.id_vendas, v.data, v.comissao
        FROM tb_vendas v
        ORDER BY v.data ASC, v.horario ASC
    ";
    $result_carrinho = $conexao->query($sql_carrinho);

    if ($result_carrinho && $result_carrinho->num_rows > 0) {
        echo "<table border='1' cellpadding='5'>";
        echo "<tr><th>ID</th><th>Data</th><th>Comissão</th><th>Produtos</th></tr>";

        while ($venda = $result_carrinho->fetch_assoc()) {
            $id_vendas = $venda['id_vendas'];
            $comissao = $venda['comissao'];

            // lista itens dessa venda
            $sql_itens_carrinho = "
                SELECT p.nome, iv.quantidade, p.preco
                FROM tb_itens_vendas iv
                JOIN tb_produto p ON iv.id_produto = p.id_produto
                WHERE iv.id_vendas = $id_vendas
            ";
            $result_itens_carrinho = $conexao->query($sql_itens_carrinho);

            // calcula total
            $total_venda = 0;
            echo "<tr>";
            echo "<td>$id_vendas</td>";
            echo "<td>{$venda['data']}</td>";

            echo "<td>";
            if ($result_itens_carrinho && $result_itens_carrinho->num_rows > 0) {
                while ($item = $result_itens_carrinho->fetch_assoc()) {
                    $subtotal = $item['preco'] * $item['quantidade'];
                    $total_venda += $subtotal;
                }
            }

            // Se não tiver comissão gravada, calcula 10% do total
            if (empty($comissao) || $comissao == 0) {
                $comissao = $total_venda * 0.10;
            }

            echo "R$ " . number_format($comissao, 2, ',', '.');
            echo "</td>";

            // lista produtos
            echo "<td>";
            $result_itens_carrinho = $conexao->query($sql_itens_carrinho);
            if ($result_itens_carrinho && $result_itens_carrinho->num_rows > 0) {
                while ($item = $result_itens_carrinho->fetch_assoc()) {
                    echo "{$item['nome']} (Qtd: {$item['quantidade']})<br>";
                }
            } else {
                echo "Sem itens.";
            }
            echo "</td>";

            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "<p>Nenhuma venda feita pelo carrinho ainda.</p>";
    }
    ?>
</body>
</html>
