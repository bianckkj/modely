<?php
if (isset($_GET['id'])) {
    // echo "editar";

    require_once "../controle/conexao.php";

    $id = $_GET['id'];

    $sql = "SELECT * FROM tb_produto WHERE id_produto = $id";

    $resultados = mysqli_query($conexao, $sql);

    $linha = mysqli_fetch_array($resultados);

    //porque não tem a variável do $id aqui?
    $nome = $linha['nome'];
    $senha = $linha['senha'];
    $email = $linha['email'];
    $endereco = $linha['endereco'];
    $tipo = $linha['tipo'];

    $botao = "Atualizar";
} else {
    // echo "novo";
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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Usuarios</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../public/css/header.css">
    <link rel="stylesheet" href="../public/css/styles.css">
</head>

<body>
    <img src="../public/assets/logo.png" alt="logo do site" id="logo">
    
    <?php require_once './templates/header.html'; ?>
    
    <h1>Listar Usuarios</h1>

    <?php
    require_once "../controle/conexao.php";
    require_once "../public/funcoes.php";

    $lista_usuarios = listarUsuarios($conexao);
    
    //verificar se encontrou clientes antes de imprimir.
    if (count($lista_usuarios) == 0) {
        echo "Não existem vendas cadastrados.";
    } else {
    ?>
        <table border="1">
            <tr>
                <td>Id</td>
                <td>Nome</td>

                <td>Email</td>
                <td>Endereço</td>
                <td colspan="2">Ação</td>
            </tr>

        <?php
        foreach ($lista_usuarios as $usuario) {
            $id_usuario = $usuario['id_usuario'];
            $nome = $usuario['nome'];

            $email = $usuario['email'];
            $endereco = $usuario['endereco'];

            echo "<tr>";
            echo "<td>$id_usuario</td>";
            echo "<td>$nome</td>";

            echo "<td>$email</td>";
            echo "<td>$endereco</td>";
            echo "<td><a href='cadastrar_usuario.php?id=$id_usuario'>Editar</a></td>";
            echo "<td><a href='../controle/deletarusuario.php?id=$id_usuario'>Excluir</a></td>";
            echo "</tr>";
        }
    }
        ?>
        </table>
</body>

</html>