<!DOCTYPE html>
<html lang="en">

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
    
    <h1>Lista Produtos</h1>

    <?php
    require_once "../controle/conexao.php";
    require_once "../public/funcoes.php";

    $lista_produtos = listarProdutos($conexao);
    
    //verificar se encontrou clientes antes de imprimir.
    if (count($lista_produtos) == 0) {
        echo "Não existem produtos cadastrados.";
    } else {
    ?>
        <table border="1">
            <tr>
                <td>Id</td>
                <td>Quantidade</td>
                <td>Material</td>
                <td>Preço</td>
                <td>Modelo</td>
                <td>Cor</td>
                <td>Tamanho</td>
                <td>Marca</td>
                <td>Imagem</td>
                <td colspan="2">Ação</td>
            </tr>

        <?php
        foreach ($lista_produtos as $produto) {
            $id_produto = $produto['id_produto'];
            $quantidade = $produto['quantidade'];
            $material = $produto['material'];
            $preco = $produto['preco'];
            $modelo = $produto['modelo'];
            $cor = $produto['cor'];
            $tamanho = $produto['tamanho'];
            $marca = $produto['marca'];
            $imagem = $produto['imagem'];

            echo "<tr>";
            echo "<td>$id_produto</td>";
            echo "<td>$quantidade</td>";
            echo "<td>$material</td>";
            echo "<td>$preco</td>";
            echo "<td>$modelo</td>";
            echo "<td>$cor</td>";
            echo "<td>$tamanho</td>";
            echo "<td>$marca</td>";
            echo "<td>$imagem</td>";
            echo "<td><a href='formCliente.php?id=$id_produto'>Editar</a></td>";
            echo "<td><a href='../controle/deletar/deletar_cliente.php?id=$id_produto'>Excluir</a></td>";
            echo "</tr>";
        }
    }
        ?>
        </table>
</body>

</html>