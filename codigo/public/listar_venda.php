<?php
    require_once '../controle/verificar_login.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Vendas</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../public/css/header.css">
    <link rel="stylesheet" href="../public/css/styles.css">
</head>

<body>
    <img src="../public/assets/logo.png" alt="logo do site" id="logo">
    
    <?php require_once './templates/header.html'; ?>

    <h1>Listar Vendas</h1>

    <?php
    require_once "../controle/conexao.php";
    require_once "../public/funcoes.php";

    $lista_vendas = listarVendas($conexao);
    
    //verificar se encontrou clientes antes de imprimir.
    if (count($lista_vendas) == 0) {
        echo "Não existem vendas cadastrados.";
    } else {
    ?>
        <table border="1">
            <tr>
                <td>Id</td>
                <td>Id cliente</td>
                <td>Id funcionario</td>
                <td>Horario</td>
                <td>Data</td>
                <td>Comissão</td>
                <td colspan="2">Ação</td>
            </tr>

        <?php
        foreach ($lista_vendas as $vendas) {
            $id_vendas = $vendas['id_vendas'];
            $id_cliente = $vendas['id_cliente'];
            $id_funcionario = $vendas['id_funcionario'];
            $horario = $vendas['horario'];
            $data = $vendas['data'];
            $comissao = $vendas['comissao'];

            echo "<tr>";
            echo "<td>$id_vendas</td>";
            echo "<td>$id_cliente</td>";
            echo "<td>$id_funcionario</td>";
            echo "<td>$horario</td>";
            echo "<td>$data</td>";
            echo "<td>$comissao</td>";
            echo "<td><a href='formCliente.php?id=$id_vendas'>Editar</a></td>";
            echo "<td><a href='../controle/deletar/deletar_cliente.php?id=$id_vendas'>Excluir</a></td>";
            echo "</tr>";
        }
    }
        ?>
        </table>
</body>

</html>