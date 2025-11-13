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
    <title>Carrinho</title>
    <script src="../jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="../public/css/header.css">
    <link rel="stylesheet" href="../public/css/styles.css">
</head>

<body>
        <?php

 

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
    // converte string no formato "1.234,56" -> número (1234.56)
    function parseBrNumber(str) {
        if (!str) return 0;
        // remove espaços, remove pontos de milhar e troca vírgula por ponto
        const cleaned = String(str).trim().replace(/\s/g, '').replace(/\./g, '').replace(',', '.');
        const n = parseFloat(cleaned);
        return isNaN(n) ? 0 : n;
    }

    // formata número 1234.56 -> "1.234,56" (sem milhares se < 1000)
    function formatBrNumber(num) {
        if (isNaN(num) || num === null) num = 0;
        // mantemos só duas casas e trocamos ponto por vírgula
        return num.toFixed(2).replace('.', ',');
    }

    // atualiza o total geral lendo todos os spans .total_unitario
    function atualizar_total() {
        let total = 0;
        document.querySelectorAll('span.total_unitario').forEach(function(el) {
            total += parseBrNumber(el.textContent);
        });
        const totalEl = document.getElementById('total');
        if (totalEl) totalEl.textContent = formatBrNumber(total);
    }

    // handler quando altera uma quantidade
    function somar() {
        const linha = this.closest('tr');
        const precoText = linha.querySelector('span.preco').textContent;
        const preco_unitario = parseBrNumber(precoText);

        let quantidade = parseInt(this.value, 10);
        if (isNaN(quantidade) || quantidade < 1) {
            quantidade = 1;
            this.value = 1;
        }

        const total_unitario = preco_unitario * quantidade;

        // atualiza o span do total unitário (formato BR)
        const spanTotalUnit = linha.querySelector('span.total_unitario');
        if (spanTotalUnit) spanTotalUnit.textContent = formatBrNumber(total_unitario);

        // atualiza o total geral
        atualizar_total();

        // Atualiza a sessão via POST
        const dados_enviados = new URLSearchParams();
        dados_enviados.append('id', this.dataset.id);
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

    // usa event delegation: funciona mesmo se inputs forem gerados dinamicamente
    document.addEventListener('change', function(e) {
        const target = e.target;
        if (target && target.matches('input.quantidade, input[type="number"].quantidade')) {
            somar.call(target, e);
        }
    });

    // monta binding também para inputs (caso prefira)
    document.querySelectorAll('input.quantidade').forEach(function(inp){
        inp.addEventListener('change', somar);
    });

    // garante que o total exibido no carregamento está consistente (caso spans tenham formatação diferente)
    document.addEventListener('DOMContentLoaded', function() {
        // normalizar os spans de total_unitario, caso server-side deixou com . ou , indevidamente
        document.querySelectorAll('span.total_unitario').forEach(function(el) {
            const n = parseBrNumber(el.textContent);
            el.textContent = formatBrNumber(n);
        });
        atualizar_total();
    });
</script>

</body>

</html>
