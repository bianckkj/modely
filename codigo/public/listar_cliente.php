<?php
require_once "../controle/conexao.php";
require_once "../public/funcoes.php";
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Clientes</title>

    <!-- Bootstrap e Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../public/css/header.css">
    <link rel="stylesheet" href="../public/css/styles.css">
</head>

<body class="bg-light">

    <img src="../public/assets/logo.png" alt="Logo do site" id="logo" class="d-block mx-auto my-3" style="max-height:80px;">

    <?php require_once './templates/header.html'; ?>

    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="text-center text-dark mb-0">Listar Clientes</h1>
            <a href="cadastrar_cliente.php" class="btn btn-dark">
                <i class="fas fa-user-plus"></i> Novo Cliente
            </a>
        </div>

        <?php
        $lista_clientes = listarClientes($conexao);

        if (count($lista_clientes) == 0) {
            echo "<div class='alert alert-secondary text-center'>Não existem clientes cadastrados.</div>";
        } else {
        ?>
            <div class="table-responsive shadow-sm rounded">
                <table class="table table-hover table-striped align-middle text-center">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>CPF</th>
                            <th>Telefone</th>
                            <th>Email</th>
                            <th>Endereço</th>
                            <th colspan="2">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($lista_clientes as $cliente) {
                            $id_cliente = $cliente['id_cliente'];
                            $nome = htmlspecialchars($cliente['nome']);
                            $cpf = htmlspecialchars($cliente['cpf']);
                            $telefone = htmlspecialchars($cliente['telefone']);
                            $email = htmlspecialchars($cliente['email']);
                            $endereco = htmlspecialchars($cliente['endereco']);

                            echo "
                            <tr>
                                <td>$id_cliente</td>
                                <td class='text-dark font-weight-bold'>$nome</td>
                                <td>$cpf</td>
                                <td>$telefone</td>
                                <td>$email</td>
                                <td>$endereco</td>
                                <td>
                                    <a href='cadastrar_cliente.php?id=$id_cliente' class='btn btn-outline-dark btn-sm'>
                                        <i class='fas fa-edit'></i> Editar
                                    </a>
                                </td>
                                <td>
                                    <a href='../controle/deletarcliente.php?id=$id_cliente' class='btn btn-dark btn-sm' onclick=\"return confirm('Tem certeza que deseja excluir este cliente?');\">
                                        <i class='fas fa-trash-alt'></i> Excluir
                                    </a>
                                </td>
                            </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        <?php
        }
        ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
