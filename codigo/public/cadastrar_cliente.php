<?php
require_once "../controle/conexao.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM tb_cliente WHERE id_cliente = ?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, "i", $id);
    mysqli_stmt_execute($comando);

    $resultados = mysqli_stmt_get_result($comando);
    $cliente = mysqli_fetch_assoc($resultados);

    $nome = $cliente['nome'];
    $cpf = $cliente['cpf'];
    $telefone = $cliente['telefone'];
    $email = $cliente['email'];
    $endereco = $cliente['endereco'];

    mysqli_stmt_close($comando);
} else {
    $id = 0;
    $nome = "";
    $cpf = "";
    $telefone = "";
    $email = "";
    $endereco = "";
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Cliente</title>

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
                    <i class="fas fa-user"></i>
                    <?php echo $id ? "Editar Cliente" : "Cadastrar Cliente"; ?>
                </h3>
            </div>

            <div class="card-body p-4">
                <!-- 🔧 Aqui foi mudado apenas o method e o action -->
                <form action="salvarcliente.php?id=<?php echo $id; ?>" method="POST">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nome"><i class="fas fa-user"></i> Nome</label>
                            <input type="text" class="form-control" id="nome" name="nome" required value="<?php echo $nome; ?>">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="cpf"><i class="fas fa-id-card"></i> CPF</label>
                            <input type="text" class="form-control" id="cpf" name="cpf" required value="<?php echo $cpf; ?>">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="telefone"><i class="fas fa-phone"></i> Telefone</label>
                            <input type="text" class="form-control" id="telefone" name="telefone" required value="<?php echo $telefone; ?>">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="email"><i class="fas fa-envelope"></i> E-mail</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="endereco"><i class="fas fa-map-marker-alt"></i> Endereço</label>
                        <input type="text" class="form-control" id="endereco" name="endereco" value="<?php echo $endereco; ?>">
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-dark px-4">
                            <i class="fas fa-save"></i>
                            <?php echo $id ? "Salvar Alterações" : "Cadastrar Cliente"; ?>
                        </button>
                        <a href="listarclientes.php" class="btn btn-outline-dark px-4 ml-2">
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
