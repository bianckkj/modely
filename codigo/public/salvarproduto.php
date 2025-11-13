<?php
require_once "../controle/conexao.php";
require_once "funcoes.php";

$id = $_POST['id'] ?? 0;
$nome = $_POST['nome'] ?? '';
$quantidade = $_POST['quantidade'] ?? 0;
$material = $_POST['material'] ?? '';
$preco = str_replace(',', '.', $_POST['preco'] ?? 0);
$modelo = $_POST['modelo'] ?? '';
$cor = $_POST['cor'] ?? '';
$tamanho = $_POST['tamanho'] ?? '';
$marca = $_POST['marca'] ?? '';

// --- Upload da imagem ---
$imagem = '';
if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {

    $diretorio = __DIR__ . "/imagens/";

    if (!is_dir($diretorio)) {
        mkdir($diretorio, 0777, true);
    }

    $extensao = strtolower(pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION));
    $nomeArquivo = uniqid() . "." . $extensao;
    $caminhoDestino = $diretorio . $nomeArquivo;

    if (move_uploaded_file($_FILES['imagem']['tmp_name'], $caminhoDestino)) {
        $imagem = $nomeArquivo;
    }
}

// --- INSERIR ou EDITAR ---
if ($id == 0) {
    // Novo produto
    $sql = "INSERT INTO tb_produto 
            (nome, quantidade, material, preco, modelo, cor, tamanho, marca, imagem) 
            VALUES 
            ('$nome', '$quantidade', '$material', '$preco', '$modelo', '$cor', '$tamanho', '$marca', '$imagem')";
} else {
    // Editar produto
    if ($imagem != '') {
        $sql = "UPDATE tb_produto SET 
                    nome = '$nome',
                    quantidade = '$quantidade',
                    material = '$material',
                    preco = '$preco',
                    modelo = '$modelo',
                    cor = '$cor',
                    tamanho = '$tamanho',
                    marca = '$marca',
                    imagem = '$imagem'
                WHERE id_produto = $id";
    } else {
        // Se não enviou nova imagem, não muda o campo imagem
        $sql = "UPDATE tb_produto SET 
                    nome = '$nome',
                    quantidade = '$quantidade',
                    material = '$material',
                    preco = '$preco',
                    modelo = '$modelo',
                    cor = '$cor',
                    tamanho = '$tamanho',
                    marca = '$marca'
                WHERE id_produto = $id";
    }
}

mysqli_query($conexao, $sql);

header("Location: listar_produto.php");
exit;
?>
