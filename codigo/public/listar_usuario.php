<?php
require_once "../controle/conexao.php";
require_once "../public/funcoes.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM tb_usuario WHERE id_usuario = $id";
    $resultados = mysqli_query($conexao, $sql);
    $linha = mysqli_fetch_array($resultados);

    $nome = $linha['nome'];
    $senha = $linha['senha'];
    $email = $linha['email'];
    $endereco = $linha['endereco'];
    $tipo = $linha['tipo'];

    $botao = "Atualizar";
} else {
    $id = 0;
    $nome = "";
    $senha = "";
    $email = "";
    $endereco = "";
    $tipo = "";

    $botao = "Cadastrar";
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Usuários</title>

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
            <h1 class="text-center text-dark mb-0">Listar Usuários</h1>
            <a href="cadastrar_usuario.php" class="btn btn-dark">
                <i class="fas fa-user-plus"></i> Novo Usuário
            </a>
        </div>

        <?php
        $lista_usuarios = listarUsuarios($conexao);

        if (count($lista_usuarios) == 0) {
            echo "<div class='alert alert-secondary text-center'>Não existem usuários cadastrados.</div>";
        } else {
        ?>
            <div class="table-responsive shadow-sm rounded">
                <table class="table table-hover table-striped align-middle text-center">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Endereço</th>
                            <th colspan="2">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($lista_usuarios as $usuario) {
                            $id_usuario = $usuario['id_usuario'];
                            $nome = htmlspecialchars($usuario['nome']);
                            $email = htmlspecialchars($usuario['email']);
                            $endereco = htmlspecialchars($usuario['endereco']);

                            echo "
                            <tr>
                                <td>$id_usuario</td>
                                <td class='text-dark font-weight-bold'>$nome</td>
                                <td>$email</td>
                                <td>$endereco</td>
                                <td>
                                    <a href='cadastrar_usuario.php?id=$id_usuario' class='btn btn-outline-dark btn-sm'>
                                        <i class='fas fa-edit'></i> Editar
                                    </a>
                                </td>
                                <td>
                                    <a href='../controle/deletarusuario.php?id=$id_usuario' class='btn btn-dark btn-sm' onclick=\"return confirm('Tem certeza que deseja excluir este usuário?');\">
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
