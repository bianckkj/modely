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
    <form action="salvarvenda.php" method="GET">
        
        <label for="id_cliente">ID Cliente:</label><br>
        <input type="int" id="id_cliente" name="id_cliente" maxlength="45" required><br><br>
        
        <label for="id_funcionario">ID Funcionario:</label><br>
        <input type="int" id="id_funcionario" name="id_funcionario" maxlength="45" required><br><br>
        
        <label for="data_hora">Data:</label><br>
        <input type="datetime" id="data" name="data" maxlength="45" required><br><br> 

        <label for="comissao">Comissao:</label><br>
        <input type="decimal" id="comissao" name="comissao" maxlength="45" required><br><br>
                
        <input type="submit" value="Cadastrar">
    </form>
</body>
</html>
