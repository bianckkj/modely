<?php

    if (isset($_GET['id'])) {
        // echo "editar";
        
        require_once "../controle/conexao.php";
        require_once "../public/funcoes.php";

        $id = $_GET['id'];
        
        $cliente = pesquisarCliente($conexao, $id);
        $nome = $cliente['nome'];
        $cpf = $cliente['cpf'];
        $endereco = $cliente['endereco'];

        $botao = "Atualizar";
    }
    else {
        // echo "novo";
        $id = 0;
        $nome = "";
        $cpf = "";
        $endereco = "";

        $botao = "Cadastrar";
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Produtos</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../public/css/header.css">
    <link rel="stylesheet" href="../public/css/styles.css">

</head>
<body>
    <img src="../public/assets/logo.png" alt="logo do site" id="logo">

    <?php require_once './templates/header.html'; ?>

    <h2>Cadastro de Cliente</h2>

    <div class="container-form">
        <form class="form" action="salvarcliente.php" method="GET">
            
            Nome:<br>
            <input type="text" id="nome" name="nome" ><br><br>
            
            CPF:<br>
            <input type="text" id="cpf" name="cpf" ><br><br>
            
            Telefone:<br>
            <input type="text" id="telefone" name="telefone" ><br><br>
            
            Email:<br>
            <input type="text" id="email" name="email" ><br><br>
            
            Endereço:<br>
            <input type="text" id="endereco" name="endereco"><br><br>

            
            <input type="submit" value="Cadastrar">
        </form>
    </div>

</body>
</html>
