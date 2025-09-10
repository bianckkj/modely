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
    <form action="salvarproduto.php" method="GET">
        
        <label for="quantidade">Quantidade:</label><br>
        <input type="text" id="quantidade" name="quantidade" maxlength="45" required><br><br>
        
        <label for="material">Material:</label><br>
        <input type="text" id="material" name="material" maxlength="45" required><br><br>
        
        <label for="preco">Preço:</label><br>
        <input type="decimal" id="preco" name="preco" maxlength="45" required><br><br>
        
        <label for="modelo">Modelo:</label><br>
        <input type="text" id="modelo" name="modelo" maxlength="45" required><br><br>
        
        <label for="cor">Cor:</label><br>
        <input type="text" id="cor" name="cor" maxlength="45" required><br><br>

        <label for="tamanho">Tamanho:</label><br>
        <input type="text" id="tamanho" name="tamanho" maxlength="45" required><br><br>

        <label for="marca">Marca:</label><br>
        <input type="text" id="marca" name="marca" maxlength="45" required><br><br>

        <label for="imagem">Imagem:</label><br>
        <input type="text" id="imagem" name="imagem" maxlength="45" required><br><br>
        
        <input type="submit" value="Cadastrar">
    </form>
</body>
</html>
