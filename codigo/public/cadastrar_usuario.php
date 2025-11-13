<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>

    <!-- Bootstrap e Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- CSS personalizado -->
    <link rel="stylesheet" href="../public/css/header.css">
    <link rel="stylesheet" href="../public/css/styles.css">
</head>

<body class="bg-light">
    <img src="../public/assets/logo.png" alt="logo do site" id="logo" class="d-block mx-auto my-3" style="max-height:80px;">

    <div class="container mt-5 mb-5">
        <div class="card shadow-lg rounded-lg">
            <div class="card-header bg-dark text-white text-center">
                <h3 class="mb-0">
                    <i class="fas fa-user-plus"></i> Cadastro de Usuário
                </h3>
            </div>

            <div class="card-body p-4">
                <form action="../public/salvarusuario.php" method="post">

                    <div class="form-group">
                        <label for="nome"><i class="fas fa-user"></i> Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome" required>
                    </div>

                    <div class="form-group">
                        <label for="email"><i class="fas fa-envelope"></i> E-mail</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>

                    <div class="form-group">
                        <label for="senha"><i class="fas fa-lock"></i> Senha</label>
                        <input type="password" class="form-control" id="senha" name="senha" required>
                    </div>

                    <div class="form-group">
                        <label for="endereco"><i class="fas fa-map-marker-alt"></i> Endereço</label>
                        <input type="text" class="form-control" id="endereco" name="endereco">
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-dark px-4">
                            <i class="fas fa-save"></i> Cadastrar Usuário
                        </button>
                        <a href="listarusuarios.php" class="btn btn-outline-dark px-4 ml-2">
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
