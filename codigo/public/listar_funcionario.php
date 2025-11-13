<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Funcionários</title>

    <!-- Bootstrap e Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- CSS customizado -->
    <link rel="stylesheet" href="../public/css/header.css">
    <link rel="stylesheet" href="../public/css/styles.css">
</head>

<body class="bg-light">

    <!-- Logo -->
    <img src="../public/assets/logo.png" alt="logo do site" id="logo" class="d-block mx-auto my-3" style="max-height:80px;">
    <?php require_once './templates/header.html'; ?>

    <div class="container mt-5 mb-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="text-dark mb-0">Lista de Funcionários</h1>
            <a href="../public/cadastrar_funcionario.php" class="btn btn-dark">
                <i class="fas fa-plus"></i> Novo Funcionário
            </a>
        </div>

        <?php
        require_once "../controle/conexao.php";
        require_once "../public/funcoes.php";

        $lista_funcionarios = listarFuncionarios($conexao);

        if (count($lista_funcionarios) == 0) {
            echo "<div class='alert alert-secondary text-center'>Não existem funcionários cadastrados.</div>";
        } else {
        ?>
            <div class="table-responsive shadow-sm rounded">
                <table class="table table-hover table-striped align-middle text-center">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>CPF</th>
                            <th>Email</th>
                            <th>Telefone</th>
                            <th>Data de Nascimento</th>
                            <th>Carga Horária</th>
                            <th>Salário</th>
                            <th>Endereço</th>
                            <th colspan="2">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($lista_funcionarios as $funcionario) {
                            $id_funcionario = $funcionario['id_funcionario'];
                            $nome = htmlspecialchars($funcionario['nome']);
                            $cpf = htmlspecialchars($funcionario['cpf']);
                            $email = htmlspecialchars($funcionario['email']);
                            $telefone = htmlspecialchars($funcionario['telefone']);
                            $data_nascimento = htmlspecialchars($funcionario['data_nascimento']);
                            $carga_horaria = htmlspecialchars($funcionario['carga_horaria']);
                            $salario = number_format($funcionario['salario'], 2, ',', '.');
                            $endereco = htmlspecialchars($funcionario['endereco']);

                            echo "
                            <tr>
                                <td>$id_funcionario</td>
                                <td class='font-weight-bold text-dark'>$nome</td>
                                <td>$cpf</td>
                                <td>$email</td>
                                <td>$telefone</td>
                                <td>$data_nascimento</td>
                                <td>$carga_horaria</td>
                                <td>R$ $salario</td>
                                <td>$endereco</td>
                                <td>
                                    <a href='../public/cadastrar_funcionario.php?id=$id_funcionario' class='btn btn-outline-dark btn-sm'>
                                        <i class='fas fa-edit'></i> Editar
                                    </a>
                                </td>
                                <td>
                                    <a href='../controle/deletarfuncionario.php?id=$id_funcionario' class='btn btn-dark btn-sm' onclick=\"return confirm('Tem certeza que deseja excluir este funcionário?');\">
                                        <i class='fas fa-trash-alt'></i> Excluir
                                    </a>
                                </td>
                            </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        <?php } ?>
    </div>

    <!-- Scripts Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
