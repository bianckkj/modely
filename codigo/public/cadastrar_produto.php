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

    <form action="salvarproduto.php" method="post" enctype="multipart/form-data">
        Quantidade: <br>
        <input type="text" name="quantidade"> <br><br>
        Material: <br>
        <input type="text" name="material"> <br><br>
        Preço: <br>
        <input type="decimal" name="preco"> <br><br>
        Modelo: <br>
        <input type="text" name="modelo"> <br><br>
        Cor: <br>
        <input type="text" name="cor"> <br><br>
        Tamanho: <br>
        <input type="text" name="tamanho"> <br><br>
        Marca: <br>
        <input type="text" name="marca"> <br><br>
        Imagem: <br>
        <input type="file" name="imagem"> <br><br>

        <input type="submit" value="Cadastrar Produto">
    </form>
</body>
</html>
