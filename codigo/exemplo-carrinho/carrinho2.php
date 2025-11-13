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
    <title>Carrinho - MODELY</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Ícones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Estilos -->
    <link rel="stylesheet" href="../public/css/header.css">
    <link rel="stylesheet" href="../public/css/styles.css">

    <script src="../jquery-3.7.1.min.js"></script>
</head>

<body class="bg-light">
    <!-- Header -->
    <?php require_once '../public/templates/header.html'; ?>

    <div class="container mt-5">
        <br><br><br>

        <div class="card shadow-lg border-0">
            <div class="card-header bg-dark text-white text-center">
                <h3 class="mb-0"><i class="fas fa-shopping-cart"></i> Seu Carrinho</h3>
            </div>

            <div class="card-body bg-white">
                <?php
                if (empty($_SESSION['carrinho'])) {
                    echo "<div class='alert alert-secondary text-center'>Seu carrinho está vazio.</div>";
                } else {
                    $total = 0;
                    echo "<div class='table-responsive'>";
                    echo "<table class='table table-hover table-striped text-center align-middle'>";
                    echo "<thead class='thead-dark'>
                            <tr>
                                <th>Produto</th>
                                <th>Preço</th>
                                <th>Quantidade</th>
                                <th>Total Unitário</th>
                                <th>Ação</th>
                            </tr>
                          </thead>
                          <tbody>";

                    foreach ($_SESSION['carrinho'] as $id => $quantidade) {
                        $produto = pesquisarProdutoId($conexao, $id);
                        $total_unitario = $produto['preco'] * $quantidade;
                        $total += $total_unitario;

                        echo "<tr>
                                <td class='text-left font-weight-bold'>" . htmlspecialchars($produto['nome']) . "</td>
                                <td>R$ <span class='preco'>" . number_format($produto['preco'], 2, ',', '.') . "</span></td>
                                <td>
                                    <input type='number' 
                                           name='quantidade[$id]' 
                                           class='form-control form-control-sm quantidade text-center mx-auto' 
                                           style='width:80px;' 
                                           value='$quantidade' 
                                           data-id='$id' 
                                           min='1'>
                                </td>
                                <td>R$ <span class='total_unitario'>" . number_format($total_unitario, 2, ',', '.') . "</span></td>
                                <td>
                                    <a href='remover.php?id=$id' class='btn btn-outline-danger btn-sm'>
                                        <i class='fas fa-trash-alt'></i> Remover
                                    </a>
                                </td>
                              </tr>";
                    }

                    echo "</tbody></table></div>";
                    echo "<h4 class='text-right mt-3 font-weight-bold'>
                            Total da compra: 
                            <span class='text-success'>
                                R$ <span id='total'>" . number_format($total, 2, ',', '.') . "</span>
                            </span>
                          </h4>";

                    echo "<div class='text-center mt-4'>
                            <a href='index.php' class='btn btn-outline-dark btn-lg mx-2'>
                                <i class='fas fa-plus'></i> Adicionar mais produtos
                            </a>
                            <a href='gravar.php' class='btn btn-dark btn-lg mx-2'>
                                <i class='fas fa-check'></i> Finalizar Compra
                            </a>
                          </div>";
                }
                ?>
            </div>
        </div>
    </div>

    <script>
        // converte string no formato "1.234,56" -> número (1234.56)
        function parseBrNumber(str) {
            if (!str) return 0;
            const cleaned = String(str).trim().replace(/\s/g, '').replace(/\./g, '').replace(',', '.');
            const n = parseFloat(cleaned);
            return isNaN(n) ? 0 : n;
        }

        // formata número 1234.56 -> "1.234,56"
        function formatBrNumber(num) {
            if (isNaN(num) || num === null) num = 0;
            return num.toFixed(2).replace('.', ',');
        }

        // atualiza o total geral
        function atualizar_total() {
            let total = 0;
            document.querySelectorAll('span.total_unitario').forEach(function(el) {
                total += parseBrNumber(el.textContent);
            });
            const totalEl = document.getElementById('total');
            if (totalEl) totalEl.textContent = formatBrNumber(total);
        }

        // quando altera a quantidade
        function somar() {
            const linha = this.closest('tr');
            const precoText = linha.querySelector('span.preco').textContent;
            const preco_unitario = parseBrNumber(precoText);
            let quantidade = parseInt(this.value, 10);
            if (isNaN(quantidade) || quantidade < 1) quantidade = 1;

            const total_unitario = preco_unitario * quantidade;
            linha.querySelector('span.total_unitario').textContent = formatBrNumber(total_unitario);
            atualizar_total();

            const dados = new URLSearchParams();
            dados.append('id', this.dataset.id);
            dados.append('quantidade', quantidade);

            fetch('atualiza_carrinho.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                body: dados.toString()
            }).then(r => r.text()).then(console.log).catch(console.error);
        }

        document.addEventListener('change', e => {
            if (e.target && e.target.matches('input.quantidade')) somar.call(e.target, e);
        });

        document.addEventListener('DOMContentLoaded', atualizar_total);
    </script>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
