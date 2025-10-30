<?php
require_once "../controle/conexao.php";
require_once "funcoes.php";

// Dados do formulário
$id = $_POST['id'] ?? 0;
$nome = $_POST['nome'] ?? '';
$quantidade = $_POST['quantidade'] ?? 0;
$material = $_POST['material'] ?? '';
$preco = $_POST['preco'] ?? 0;
$modelo = $_POST['modelo'] ?? '';
$cor = $_POST['cor'] ?? '';
$tamanho = $_POST['tamanho'] ?? '';
$marca = $_POST['marca'] ?? '';
$novo_nome = null;

// Verifica se uma imagem foi enviada
if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === 0) {
    $nome_arquivo = $_FILES['imagem']['name'];
    $caminho_temporario = $_FILES['imagem']['tmp_name'];

    // Gera nome único
    $extensao = strtolower(pathinfo($nome_arquivo, PATHINFO_EXTENSION));
    $novo_nome = uniqid() . "." . $extensao;

    // Caminho completo da pasta
    $pasta = __DIR__ . "/fotos/";

    // Cria a pasta se não existir
    if (!is_dir($pasta)) {
        mkdir($pasta, 0777, true);
    }

    // Move o arquivo
    if (!move_uploaded_file($caminho_temporario, $pasta . $novo_nome)) {
        echo "❌ Erro ao mover o arquivo. Verifique as permissões da pasta 'fotos/'.";
        exit;
    }
}

// Salva ou edita
if ($id == 0) {
    salvarProduto($conexao, $nome, $quantidade, $material, $preco, $modelo, $cor, $tamanho, $marca, $novo_nome);
} else {
    editarProduto($conexao, $nome, $quantidade, $material, $preco, $modelo, $cor, $tamanho, $marca, $novo_nome, $id);
}

// Redireciona
header("Location: listar_produto.php");
exit;
?>
