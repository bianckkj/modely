<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes</title>
</head>

<body>
    <h2>Lista de Clientes</h2>

    <table>
        <tr>
            <td>Id Cliente</td>
            <td>nome</td>
            <td>CPF</td>
            <td>Telefone</td>
            <td>email</td>
            <td>Endereço</td>
        </tr>
        <?php
        require_once "conexao.php";

        $sql = "SELECT * FROM tb_cliente";

        $resultados = mysqli_query($conexao, $sql);

        while ($linha = mysqli_fetch_array($resultados)) {
            $id = $linha['id_cliente'];
            $nome = $linha['nome'];
            $cpf = $linha['cpf'];
            $telefone = $linha['telefone'];
            $email = $linha['email'];
            $endereco = $linha['endereco'];
            echo "<tr>";
            echo "<td>$id</td>";
            echo "<td>$nome</td>";
            echo "<td>$cpf</td>";
            echo "<td>$telefone</td>";
            echo "<td>$email</td>";
             echo "<td>$endereco</td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>

</html>