<?php
require_once "../controle/conexao.php";
<<<<<<< Updated upstream

$nome = $_GET['nome'];
$quantidade = $_GET['quantidade'];
$material = $_GET['material'];
$preco = $_GET['preco'];
$modelo = $_GET['modelo'];
$cor = $_GET['cor'];
$tamanho = $_GET['tamanho'];
$marca = $_GET['marca'];
$imagem = $_GET['imagem'];


if ($id == 0) {
    // echo "novo";
    $sql = "INSERT INTO tb_produto (nome, quantidade, material, preco, modelo, cor, tamanho, marca, imagem) VALUES ('$nome', '$quantidade', $material, $preco, $modelo, $cor, $tamanho, $marca, $imagem)";
} else {
    // echo "atualizar";
    $sql = "UPDATE tb_produto SET nome = '$nome', quantidade = '$quantidade', material = $material, preco = $preco, modelo = $modelo, cor = $cor, tamanho = $tamanho, marca = $marca, imagem = $imagem WHERE id_produto = $id";
}

=======

// Função para validar extensões permitidas
function extensaoPermitida($extensao) {
    $permitidas = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    return in_array(strtolower($extensao), $permitidas);
}
>>>>>>> Stashed changes

// Coleta os dados do formulário
$quantidade = $_POST['quantidade'];
$material = $_POST['material'];
$preco = $_POST['preco'];
$modelo = $_POST['modelo'];
$cor = $_POST['cor'];
$tamanho = $_POST['tamanho'];
$marca = $_POST['marca'];

<<<<<<< Updated upstream

header("Location: home.html");
?>
=======
// Verifica se foi feito o upload da imagem
if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
    $nome_arquivo = $_FILES['imagem']['name'];
    $caminho_temporario = $_FILES['imagem']['tmp_name'];
    $extensao = pathinfo($nome_arquivo, PATHINFO_EXTENSION);

    // Valida a extensão
    if (!extensaoPermitida($extensao)) {
        die("Erro: Tipo de imagem não permitido. Apenas JPG, PNG, GIF, WEBP.");
    }

    // Gera nome único
    $novo_nome = uniqid() . "." . $extensao;

    // Cria a pasta se não existir
    $pasta_fotos = __DIR__ . "/fotos";
    if (!is_dir($pasta_fotos)) {
        mkdir($pasta_fotos, 0777, true); // cria com permissão total
    }

    // Caminho final
    $caminho_destino = $pasta_fotos . "/" . $novo_nome;

    // Move o arquivo
    if (!move_uploaded_file($caminho_temporario, $caminho_destino)) {
        die("Erro ao salvar a imagem no servidor.");
    }
} else {
    die("Erro: Nenhuma imagem foi enviada ou ocorreu um erro no upload.");
}

// Prepara e executa o INSERT
$sql = "INSERT INTO tb_produto (quantidade, material, preco, modelo, cor, tamanho, marca, imagem) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$comando = mysqli_prepare($conexao, $sql);

if (!$comando) {
    die("Erro ao preparar SQL: " . mysqli_error($conexao));
}

// Liga os parâmetros
mysqli_stmt_bind_param($comando, "isdsssss",
    $quantidade, $material, $preco, $modelo, $cor, $tamanho, $marca, $novo_nome
);

mysqli_stmt_execute($comando);
mysqli_stmt_close($comando);

// Redireciona após sucesso
header("Location: index.php");
exit;
?>
>>>>>>> Stashed changes
