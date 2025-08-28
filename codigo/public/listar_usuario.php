<?php
    require_once '../controle/verificar_login.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Usuarios</title>
</head>

<body>
    <h1>Listar Uruarios</h1>

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
                <td>Senha</td>
                <td>Email</td>
                <td>Endereço</td>
                <td colspan="2">Ação</td>
            </tr>

        <?php
        foreach ($lista_usuarios as $usuario) {
            $id_usuario = $usuario['id_usuario'];
            $nome = $usuario['nome'];
            $senha = $usuario['senha'];
            $email = $usuario['email'];
            $endereco = $usuario['endereco'];

            echo "<tr>";
            echo "<td>$id_usuario</td>";
            echo "<td>$nome</td>";
            echo "<td>$senha</td>";
            echo "<td>$email</td>";
            echo "<td>$endereco</td>";
            echo "<td><a href='formCliente.php?id=$id_usuario'>Editar</a></td>";
            echo "<td><a href='../controle/deletar/deletar_cliente.php?id=$id_usuario'>Excluir</a></td>";
            echo "</tr>";
        }
    }
        ?>
        </table>
</body>

</html>