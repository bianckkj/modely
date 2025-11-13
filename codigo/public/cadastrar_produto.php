<?php
if (isset($_GET['id'])) {
    // --- Edição de produto existente ---
    $id = $_GET['id'];

    require_once "../controle/conexao.php";
    $sql = "SELECT * FROM tb_produto WHERE id_produto = ?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, "i", $id);
    mysqli_stmt_execute($comando);

    $resultados = mysqli_stmt_get_result($comando);
    $produto = mysqli_fetch_array($resultados);

    // Preenche os campos
    $nome = $produto['nome'];
    $quantidade = $produto['quantidade'];
    $material = $produto['material'];
    $preco = $produto['preco'];
    $modelo = $produto['modelo'];
    $cor = $produto['cor'];
    $tamanho = $produto['tamanho'];
    $marca = $produto['marca'];
    $imagem = $produto['imagem'];

    mysqli_stmt_close($comando);
} else {
    // --- Novo produto ---
    $id = 0;
    $nome = "";
    $quantidade = "";
    $material = "";
    $preco = "";
    $modelo = "";
    $cor = "";
    $tamanho = "";
    $marca = "";
    $imagem = "";
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Produtos</title>

    <!-- Bootstrap e Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- CSS personalizado -->
    <link rel="stylesheet" href="../public/css/header.css">
    <link rel="stylesheet" href="../public/css/styles.css">
</head>

<body class="bg-light">
    <img src="../public/assets/logo.png" alt="logo do site" id="logo" class="d-block mx-auto my-3" style="max-height:80px;">
    <?php require_once './templates/header.html'; ?>

    <div class="container mt-5 mb-5">
        <div class="card shadow-lg rounded-lg">
            <div class="card-header bg-dark text-white text-center">
                <h3 class="mb-0">
                    <i class="fas fa-box-open"></i>
                    <?php echo $id ? "Editar Produto" : "Cadastrar Produto"; ?>
                </h3>
            </div>

            <div class="card-body p-4">
                <form action="salvarproduto.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nome"><i class="fas fa-tag"></i> Nome</label>
                            <input type="text" class="form-control" id="nome" name="nome" required value="<?php echo $nome; ?>">
                        </div>

                        <div class="form-group col-md-3">
                            <label for="quantidade"><i class="fas fa-cubes"></i> Quantidade</label>
                            <input type="number" class="form-control" id="quantidade" name="quantidade" value="<?php echo $quantidade; ?>">
                        </div>

                        <div class="form-group col-md-3">
                            <label for="preco"><i class="fas fa-money-bill-wave"></i> Preço</label>
                            <input type="number" step="0.01" class="form-control" id="preco" name="preco" value="<?php echo $preco; ?>">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="material"><i class="fas fa-tshirt"></i> Material</label>
                            <input type="text" class="form-control" id="material" name="material" value="<?php echo $material; ?>">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="modelo"><i class="fas fa-shapes"></i> Modelo</label>
                            <input type="text" class="form-control" id="modelo" name="modelo" value="<?php echo $modelo; ?>">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="marca"><i class="fas fa-copyright"></i> Marca</label>
                            <input type="text" class="form-control" id="marca" name="marca" value="<?php echo $marca; ?>">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="cor"><i class="fas fa-palette"></i> Cor</label>
                            <input type="text" class="form-control" id="cor" name="cor" value="<?php echo $cor; ?>">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="tamanho"><i class="fas fa-ruler"></i> Tamanho</label>
                            <input type="text" class="form-control" id="tamanho" name="tamanho" value="<?php echo $tamanho; ?>">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="imagem"><i class="fas fa-image"></i> Imagem</label>
                            <input type="file" class="form-control-file" id="imagem" name="imagem">
                            <?php if (!empty($imagem)) { ?>
                                <small class="text-muted">Imagem atual: <?php echo htmlspecialchars($imagem); ?></small>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-dark px-4">
                            <i class="fas fa-save"></i>
                            <?php echo $id ? "Salvar Alterações" : "Cadastrar Produto"; ?>
                        </button>
                        <a href="home.php" class="btn btn-outline-dark px-4 ml-2">
                            <i class="fas fa-arrow-left"></i> Voltar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
