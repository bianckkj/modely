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

    <h2>Cadastro de produtos</h2>
    <form action="salvarproduto.php" class="form" method="GET">
        
        Quantidade:<br>
        <input type="text" id="quantidade" name="quantidade"><br><br>
        
        Material:<br>
        <input type="text" id="material" name="material" ><br><br>
        
        Preço:<br>
        <input type="decimal" id="preco" name="preco" ><br><br>
        
        Modelo:<br>
        <input type="text" id="modelo" name="modelo" ><br><br>
        
        Cor:<br>
        <input type="text" id="cor" name="cor" ><br><br>

        Tamanho:<br>
        <input type="text" id="tamanho" name="tamanho" ><br><br>

        Marca:<br>
        <input type="text" id="marca" name="marca" ><br><br>

        Imagem:<br>
        <input type="file" id="foto" name="foto"> <br><br>

        
        <input type="submit" value="Cadastrar">
    </form>
</body>
</html>
