<?php
    require_once '../controle/verificar_login.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar funcionarios</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../public/css/header.css">
    <link rel="stylesheet" href="../public/css/styles.css">
</head>

<body>
    <img src="../public/assets/logo.png" alt="logo do site" id="logo">
    
    <?php require_once './templates/header.html'; ?>
    
    <h1>Lista Funcionarios</h1>

    <?php
    require_once "../controle/conexao.php";
    require_once "../public/funcoes.php";

    $lista_funcionarios = listarFuncionarios($conexao);
    
    //verificar se encontrou clientes antes de imprimir.
    if (count($lista_funcionarios) == 0) {
        echo "Não existem produtos cadastrados.";
    } else {
    ?>
        <table border="1">
            <tr>
                <td>Id</td>
                <td>Cpf</td>
                <td>email</td>
                <td>Telefone</td>
                <td>Data de nascimento</td>
                <td>Carga Horaria</td>
                <td>Salario</td>
                <td>Endereço</td>
                <td colspan="2">Ação</td>
            </tr>

        <?php
        foreach ($lista_funcionarios as $funcionario) {
            $id_funcionario = $funcionario['id_funcionario'];
            $cpf = $funcionario['cpf'];
            $email = $funcionario['email'];
            $telefone = $funcionario['telefone'];
            $data_nascimento = $funcionario['data_nascimento'];
            $carga_horaria = $funcionario['carga_horaria'];
            $salario = $funcionario['salario'];
            $endereco = $funcionario['endereco'];

            echo "<tr>";
            echo "<td>$id_funcionario</td>";
            echo "<td>$cpf</td>";
            echo "<td>$email</td>";
            echo "<td>$telefone</td>";
            echo "<td>$data_nascimento</td>";
            echo "<td>$carga_horaria</td>";
            echo "<td>$salario</td>";
            echo "<td>$endereco</td>";
            echo "<td><a href='formCliente.php?id=$id_funcionario'>Editar</a></td>";
            echo "<td><a href='../controle/deletar_cliente.php?id=$id_funcionario'>Excluir</a></td>";
            echo "</tr>";
        }
    }
        ?>
        </table>
</body>

</html>