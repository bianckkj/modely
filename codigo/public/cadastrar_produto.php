<?php


if (isset($_GET['id'])) {
    // --- Edição de produto existente ---
    $id = $_GET['id'];

    require_once "../controle/conexao.php";
    $sql = "SELECT * FROM tb_produto WHERE id_produto = ?";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($comando, "i", $id);
    mysqli_stmt_execute($comando);

    $resultados = mysqli_stmt_get_result($comando);

    $produto = mysqli_fetch_array($resultados);

    // Preenche os campos
    $nome = $produto['nome'];
    $quantidade = $produto['quantidade'];
    $material = $produto['material'];
    $preco = $produto['preco'];
    $modelo = $produto['modelo'];
    $cor = $produto['cor'];
    $tamanho = $produto['tamanho'];
    $marca = $produto['marca'];
    $imagem = $produto['imagem'];

    mysqli_stmt_close($comando);
} else {
    // --- Novo produto ---
    $id = 0;
    $nome = "";
    $quantidade = "";
    $material = "";
    $preco = "";
    $modelo = "";
    $cor = "";
    $tamanho = "";
    $marca = "";
    $imagem = "";

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

    <form action="salvarproduto.php" method="post" enctype="multipart/form-data">
        Nome: <br>
        <input type="text" name="nome" value="<?php echo $nome; ?>"> <br><br>
        Quantidade: <br>
        <input type="number" name="quantidade" value="<?php echo $quantidade; ?>"> <br><br>
        Material: <br>
        <input type="text" name="material" value="<?php echo $material; ?>"> <br><br>
        Preço: <br>
        <input type="decimal" name="preco" value="<?php echo $preco; ?>"> <br><br>
        Modelo: <br>
        <input type="text" name="modelo" value="<?php echo $modelo; ?>"> <br><br>
        Cor: <br>
        <input type="text" name="cor" value="<?php echo $cor; ?>"> <br><br>
        Tamanho: <br>
        <input type="text" name="tamanho" value="<?php echo $tamanho; ?>"> <br><br>
        Marca: <br>
        <input type="text" name="marca" value="<?php echo $marca; ?>"> <br><br>
        Imagem: <br>
        <input type="file" name="imagem" value="<?php echo $imagem; ?>"> <br><br>

        <input type="submit" value="Cadastrar Produto">
    </form>
</body>
</html>
