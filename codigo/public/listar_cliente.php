<?php
    require_once '../controle/verificar_login.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar clientes</title>
</head>

<body>
    <h1>Listar clientes</h1>

    <?php
    require_once "../controle/conexao.php";
    require_once "../public/funcoes.php";

    $lista_clientes = listarClientes($conexao);
    
    //verificar se encontrou clientes antes de imprimir.
    if (count($lista_clientes) == 0) {
        echo "Não existem clientes cadastrados.";
    } else {
    ?>
        <table border="1">
            <tr>
                <td>Id</td>
                <td>Nome</td>
                <td>CPF</td>
                <td>Telefone</td>
                <td>Email</td>
                <td>Endereço</td>
                <td colspan="2">Ação</td>
            </tr>

        <?php
        foreach ($lista_clientes as $cliente) {
            $id_cliente = $cliente['id_cliente'];
            $nome = $cliente['nome'];
            $cpf = $cliente['cpf'];
            $telefone = $cliente['telefone'];
            $email = $cliente['email'];
            $endereco = $cliente['endereco'];

            echo "<tr>";
            echo "<td>$id_cliente</td>";
            echo "<td>$nome</td>";
            echo "<td>$cpf</td>";
            echo "<td>$telefone</td>";
            echo "<td>$email</td>";
            echo "<td>$endereco</td>";
            echo "<td><a href='formCliente.php?id=$id_cliente'>Editar</a></td>";
            echo "<td><a href='../controle/deletar/deletar_cliente.php?id=$id_cliente'>Excluir</a></td>";
            echo "</tr>";
        }
    }
        ?>
        </table>
</body>

</html>