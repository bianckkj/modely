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
        
        ID Cliente:<br>
        <input type="text" id="id_cliente" name="id_cliente" ><br><br>
        
        ID Funcionario:<br>
        <input type="text" id="id_funcionario" name="id_funcionario"><br><br>
        
        Data:<br>
        <input type="date" id="data" name="data"><br><br> 

        Comissao:<br>
        <input type="text" id="comissao" name="comissao"><br><br>
                
        <input type="submit" value="Cadastrar">
    </form>
</body>
</html>
