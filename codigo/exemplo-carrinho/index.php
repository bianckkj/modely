<?php
require_once "../public/funcoes.php";
require_once "../controle/conexao.php";
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Produtos - MODELY</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Ícones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Estilos -->
    <link rel="stylesheet" href="../public/css/header.css">
    <link rel="stylesheet" href="../public/css/styles.css">
</head>

<body class="bg-light">

    <!-- Logo -->
    <img src="../public/assets/logo.png" alt="logo do site" id="logo" class="d-block mx-auto my-3" style="max-height:80px;">

    <!-- Header -->
    <?php require_once '../public/templates/header.html'; ?>

    <div class="container mt-5">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-dark text-white text-center">
                <h4 class="mb-0"><i class="fas fa-list"></i> Listagem de Produtos</h4>
            </div>

            <div class="card-body bg-white">
                <form action="adicionar.php" method="POST">
                    <?php
                    $produtos = listarProdutos($conexao);

                    if (count($produtos) == 0) {
                        echo "<div class='alert alert-secondary text-center'>Não há produtos cadastrados no momento.</div>";
                    } else {
                        echo "<div class='table-responsive'>";
                        echo "<table class='table table-hover align-middle text-center'>";
                        echo "<thead class='thead-dark'>
                                <tr>
                                    <th>Selecionar</th>
                                    <th>Produto</th>
                                    <th>Preço</th>
                                    <th>Quantidade</th>
                                </tr>
                              </thead>
                              <tbody>";

                        foreach ($produtos as $produto) {
                            $id = $produto['id_produto'];
                            $nome = htmlspecialchars($produto['nome']);
                            $preco = number_format($produto['preco'], 2, ',', '.');

                            echo "<tr>
                                    <td>
                                        <input type='checkbox' name='id_produto[]' value='$id'>
                                    </td>
                                    <td class='text-left font-weight-bold'>$nome</td>
                                    <td>R$ $preco</td>
                                    <td>
                                        <input type='number' name='quantidade[$id]' value='1' min='1' class='form-control form-control-sm text-center' style='width:80px;'>
                                    </td>
                                  </tr>";
                        }

                        echo "</tbody></table></div>";
                        echo "<div class='text-center mt-4'>
                                <button type='submit' class='btn btn-dark btn-lg px-5'>
                                    <i class='fas fa-cart-plus'></i> Adicionar ao Carrinho
                                </button>
                              </div>";
                    }
                    ?>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
