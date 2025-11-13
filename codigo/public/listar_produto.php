<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Produtos</title>

    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../public/css/header.css">
    <link rel="stylesheet" href="../public/css/styles.css">
</head>

<body>
    <img src="../public/assets/logo.png" alt="logo do site" id="logo">
    
    <?php require_once './templates/header.html'; ?>
    
<div>    
        <h1>Lista de Produtos</h1>

        <?php
        require_once "../controle/conexao.php";
        require_once "../public/funcoes.php";

        $lista_produtos = listarProdutos($conexao);

        if (count($lista_produtos) == 0) {
            echo "<p>Não existem produtos cadastrados.</p>";
        } else 
        {
            echo "<table border='1'>";
            echo "<tr>
                        <th>Id</th>
                        <th>Quantidade</th>
                        <th>Material</th>
                        <th>Preço</th>
                        <th>Modelo</th>
                        <th>Cor</th>
                        <th>Tamanho</th>
                        <th>Marca</th>
                        <th>Imagem</th>
                        <th colspan='2'>Ação</th>
                    </tr>";

            foreach ($lista_produtos as $produto) {
                $id_produto = $produto['id_produto'];
                $quantidade = $produto['quantidade'];
                $material = htmlspecialchars($produto['material']);
                $preco = number_format($produto['preco'], 2, ',', '.');
                $modelo = htmlspecialchars($produto['modelo']);
                $cor = htmlspecialchars($produto['cor']);
                $tamanho = htmlspecialchars($produto['tamanho']);
                $marca = htmlspecialchars($produto['marca']);
                $imagem = $produto['imagem'];

                echo "<tr>";
                echo "<td>$id_produto</td>";
                echo "<td>$quantidade</td>";
                echo "<td>$material</td>";
                echo "<td>R$ $preco</td>";
                echo "<td>$modelo</td>";
                echo "<td>$cor</td>";
                echo "<td>$tamanho</td>";
                echo "<td>$marca</td>";
                
                // Mostra a imagem se existir
                if (!empty($imagem) && file_exists(__DIR__ . "/imagens/" . $imagem)) {
                    echo "<td><img src='imagens/$imagem' alt='$modelo' width='80'></td>";
                } else {
                    echo "<td>Sem imagem</td>";
                }

                echo "<td><a href='cadastrar_produto.php?id=$id_produto'>Editar</a></td>";
                echo "<td><a href='../controle/deletarproduto.php?id=$id_produto'>Excluir</a></td>";
                echo "</tr>";
            }

            echo "</table>";
        }
        ?>
</div>
</body>
</html>
