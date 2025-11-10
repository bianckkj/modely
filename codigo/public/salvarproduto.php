<?php
require_once "../controle/conexao.php";
require_once "funcoes.php";

// --- Captura e valida dados do formulário ---
$id = $_POST['id'] ?? 0;
$nome = $_POST['nome'] ?? '';
$quantidade = $_POST['quantidade'] ?? 0;
$material = $_POST['material'] ?? '';
$preco = str_replace(',', '.', $_POST['preco'] ?? 0); // troca vírgula por ponto

// Validação do preço
if (!is_numeric($preco)) {
    echo "❌ Erro: o preço deve ser um número válido.";
    exit;
}

$modelo = $_POST['modelo'] ?? '';
$cor = $_POST['cor'] ?? '';
$tamanho = $_POST['tamanho'] ?? '';
$marca = $_POST['marca'] ?? '';

// --- Upload da imagem ---
$imagem = '';
if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {

    // Caminho absoluto da pasta
    $diretorio = __DIR__ . "/imagens/";

    // Cria a pasta se não existir
    if (!is_dir($diretorio)) {
        mkdir($diretorio, 0777, true);
    }

    // Gera nome único para a imagem
    $extensao = strtolower(pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION));
    $nomeArquivo = uniqid() . "." . $extensao;
    $caminhoDestino = $diretorio . $nomeArquivo;

    // Move o arquivo
    if (!move_uploaded_file($_FILES['imagem']['tmp_name'], $caminhoDestino)) {
        echo "❌ Erro ao mover o arquivo. Verifique se a pasta 'imagens/' existe e tem permissão de escrita.";
        exit;
    }

    $imagem = $nomeArquivo;
}

// --- Salva ou edita produto ---
if ($id > 0) {
    editarProduto($conexao, $nome, $quantidade, $material, $preco, $modelo, $cor, $tamanho, $marca, $imagem, $id);
} else {
    salvarProduto($conexao, $nome, $quantidade, $material, $preco, $modelo, $cor, $tamanho, $marca, $imagem);
}
