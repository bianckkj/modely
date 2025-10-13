<?php
if (isset($_GET['id'])) {
    // echo "editar";

    require_once "../controle/conexao.php";

    $id = $_GET['id'];

    $sql = "SELECT * FROM tb_produto WHERE id_produto = $id";

    $resultados = mysqli_query($conexao, $sql);

    $linha = mysqli_fetch_array($resultados);

    //porque não tem a variável do $id aqui?
    $nome = $linha['nome'];
    $quantidade = $linha['quantidade'];
    $material = $linha['material'];
    $preco = $linha['preco'];
    $modelo = $linha['modelo'];
    $cor = $linha['cor'];
    $tamanho = $linha['tamanho'];
    $marca = $linha['marca'];
    $imagem = $linha['imagem'];

    $botao = "Atualizar";
} else {
    // echo "novo";
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

    <form action="salvarproduto.php" method="post" enctype="multipart/form-data">
        Quantidade: <br>
        <input type="text" name="quantidade" value="<?php echo $quantidade; ?>"> <br><br>
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
        <input type="file" name="imagem" value="<?php echo $imagemn; ?>"> <br><br>

        <input type="submit" value="Cadastrar Produto">
    </form>
</body>
</html>
