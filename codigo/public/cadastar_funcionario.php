<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    require_once "../controle/conexao.php";
    $sql = "SELECT * FROM tb_funcionario WHERE id_funcionario = ?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, "i", $id);
    mysqli_stmt_execute($comando);
    $resultados = mysqli_stmt_get_result($comando);
    $funcionario = mysqli_fetch_assoc($resultados);

    $nome = $funcionario['nome'];
    $cpf = $funcionario['cpf'];
    $email = $funcionario['email'];
    $telefone = $funcionario['telefone'];
    $data_nascimento = $funcionario['data_nascimento'];
    $carga_horaria = $funcionario['carga_horaria'];
    $salario = $funcionario['salario'];
    $endereco = $funcionario['endereco'];

    mysqli_stmt_close($comando);
} else {
    $id = 0;
    $nome = "";
    $cpf = "";
    $email = "";
    $telefone = "";
    $data_nascimento = "";
    $carga_horaria = "";
    $salario = "";
    $endereco = "";
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Funcionário</title>

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
                    <i class="fas fa-user-tie"></i> 
                    <?php echo $id ? "Editar Funcionário" : "Cadastrar Funcionário"; ?>
                </h3>
            </div>

            <div class="card-body p-4">
                <form action="salvarfuncionario.php" method="GET">
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
                            <label for="email"><i class="fas fa-envelope"></i> E-mail</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="telefone"><i class="fas fa-phone"></i> Telefone</label>
                            <input type="text" class="form-control" id="telefone" name="telefone" value="<?php echo $telefone; ?>">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="data_nascimento"><i class="fas fa-calendar-alt"></i> Data de Nascimento</label>
                            <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" value="<?php echo $data_nascimento; ?>">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="carga_horaria"><i class="fas fa-clock"></i> Carga Horária</label>
                            <input type="time" class="form-control" id="carga_horaria" name="carga_horaria" value="<?php echo $carga_horaria; ?>">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="salario"><i class="fas fa-money-bill-wave"></i> Salário</label>
                            <input type="number" step="0.01" class="form-control" id="salario" name="salario" value="<?php echo $salario; ?>">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="endereco"><i class="fas fa-map-marker-alt"></i> Endereço</label>
                            <input type="text" class="form-control" id="endereco" name="endereco" value="<?php echo $endereco; ?>">
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-dark px-4">
                            <i class="fas fa-save"></i>
                            <?php echo $id ? "Salvar Alterações" : "Cadastrar Funcionário"; ?>
                        </button>
                        <a href="listar_funcionarios.php" class="btn btn-outline-dark px-4 ml-2">
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
