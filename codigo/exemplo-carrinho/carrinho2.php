<?php
session_start();

require_once "../controle/conexao.php";
require_once "../public/funcoes.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="../jquery-3.7.1.min.js"></script>
</head>

<body>
        <?php

        require_once '../public/templates/header.html'

    if (empty($_SESSION['carrinho'])) {
        echo "Carrinho vazio";
    } else {
        $total = 0;
        echo "<table border='1'>";
        echo "<tr>";
        echo "<th>Nome</th>";
        echo "<th>Preço</th>";
        echo "<th>Quantidade</th>";
        echo "<th>Total unitário</th>";
        echo "<th>Remover</th>";
        echo "</tr>";

        foreach ($_SESSION['carrinho'] as $id => $quantidade) {
            $produto = pesquisarProdutoId($conexao, $id);

            echo "<tr>";
            echo "<td>" . htmlspecialchars($produto['nome']) . "</td>";
            echo "<td>R$ <span class='preco'>" . number_format($produto['preco'], 2, ',', '.') . "</span></td>";

            // ✅ Corrigido: tag input estava sem fechamento
            echo "<td><input type='number' name='quantidade[$id]' class='quantidade' value='$quantidade' data-id='$id' min='1' size='2'></td>";

            $total_unitario = $produto['preco'] * $quantidade;
            $total += $total_unitario;

            echo "<td>R$ <span class='total_unitario'>" . number_format($total_unitario, 2, ',', '.') . "</span></td>";
            echo "<td><a href='remover.php?id=$id'>[remover]</a></td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "<h3>Total da compra: R$ <span id='total'>" . number_format($total, 2, ',', '.') . "</span></h3>";
    }
    ?>

    <p>
        <a href="index.php">Adicionar produtos</a> <br>
        <a href="gravar.php">Gravar compra</a>
    </p>

    <script>
        // Função para atualizar o total geral
        function atualizar_total() {
            let total = 0;

            $('span.total_unitario').each(function() {
                const valor = parseFloat($(this).text().replace(',', '.'));
                total += valor;
            });

            $('#total').text(total.toFixed(2).replace('.', ','));
        }

        // Função que roda ao alterar a quantidade
        function somar() {
            const linha = $(this).closest('tr');
            const preco_unitario = parseFloat(linha.find('span.preco').text().replace(',', '.'));
            const quantidade = parseInt($(this).val());
            const id = $(this).data('id');

            const total_unitario = preco_unitario * quantidade;
            linha.find('span.total_unitario').text(total_unitario.toFixed(2).replace('.', ','));

            atualizar_total();

            // Atualiza a sessão via fetch
            const dados_enviados = new URLSearchParams();
            dados_enviados.append('id', id);
            dados_enviados.append('quantidade', quantidade);

            fetch('atualiza_carrinho.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: dados_enviados.toString()
                })
                .then(response => response.text())
                .then(data => console.log("Carrinho atualizado:", data))
                .catch(error => console.error('Erro ao atualizar:', error));
        }

        $("input[type='number']").on('change', somar);
    </script>
</body>

</html>
