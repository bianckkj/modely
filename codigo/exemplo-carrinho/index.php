<?php
require_once "../public/funcoes.php";
require_once "../controle/conexao.php";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MODELY</title>
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" href="../public/css/header.css">
    <link rel="stylesheet" href="../public/css/carrinho.css">
    
    
    <!-- Link Animate.css e AOS.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    
   
</head>

<body>


    <?php
        require_once '../public/templates/header.html'
    ?>



    <br><br><br><br><br>
    <!-- ver produtos que podem ser adicionados -->
    <form action="adicionar.php" method="POST">
        <h2>Listagem de Produtos</h2>

        <ul>
            <?php
            $produtos = listarProdutos($conexao);

            foreach ($produtos as $produto):
            ?>
                <li>
                    <input type="checkbox" name="id_produto[]" value="<?php echo $produto['id_produto'] ?>"> R$ <span><?php echo $produto['preco']; ?></span> -- <?php echo $produto['nome']; ?>

                    <input type="number" name="quantidade[<?php echo $produto['id_produto']; ?>]" value="1" min="1">
                </li>
            <?php endforeach; ?>
        </ul>

        <input type="submit" value="Adicionar selecionados ao carrinho">

    </form>
    
    <!-- link para destrui o carrinho e simular um novo início -->
     
    <a href="destruir_carrinho.php">destruir carrinho</a>

</body>

</html>