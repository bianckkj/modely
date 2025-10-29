<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Vendas</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../public/css/header.css">
    <link rel="stylesheet" href="../public/css/styles.css">
</head>
<body>
    <img src="../public/assets/logo.png" alt="logo do site" id="logo">

    <?php require_once './templates/header.html'; ?>

    <h2>Cadastro de Vendas</h2>

    <?php

    require_once '../controle/conexao.php'; 


    $clientes = $conexao->query("SELECT id_cliente, nome FROM tb_cliente ORDER BY nome ASC");
    $funcionarios = $conexao->query("SELECT id_funcionario, nome FROM tb_funcionario ORDER BY nome ASC");
    ?>

    <form action="salvarvenda.php" method="GET">
        
        <label for="id_cliente">Cliente:</label><br>
        <select id="id_cliente" name="id_cliente" required>
            <option value="">Selecione o cliente</option>
            <?php
            while ($c = $clientes->fetch_assoc()) {
                echo "<option value='{$c['id_cliente']}'>{$c['nome']} (ID: {$c['id_cliente']})</option>";
            }
            ?>
        </select>
        <br><br>
        
        <label for="id_funcionario">Funcionário:</label><br>
        <select id="id_funcionario" name="id_funcionario" required>
            <option value="">Selecione o funcionário</option>
            <?php
            while ($f = $funcionarios->fetch_assoc()) {
                echo "<option value='{$f['id_funcionario']}'>{$f['nome']} (ID: {$f['id_funcionario']})</option>";
            }
            ?>
        </select>
        <br><br>

        <label for="horario">Horario</label><br>
        <input type="time" id="horario" name="horario" required> <br><br>
        
        <label for="data">Data:</label><br>
        <input type="date" id="data" name="data" required><br><br> 

        <label for="comissao">Comissão:</label><br>
        <input type="text" id="comissao" name="comissao" required><br><br>
                
        <input type="submit" value="Cadastrar">
    </form>

</body>
</html>
