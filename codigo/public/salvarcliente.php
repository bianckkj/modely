<?php
ob_start(); // Evita erro de header

require_once "../controle/conexao.php";
require_once "funcoes.php";

// Garante que todas as variáveis existam mesmo se não vierem do formulário
$id = $_GET['id'] ?? 0;
$nome = $_POST['nome'] ?? '';
$cpf = $_POST['cpf'] ?? '';
$telefone = $_POST['telefone'] ?? '';
$email = $_POST['email'] ?? '';
$endereco = $_POST['endereco'] ?? '';

// Verifica se é inserção ou atualização
if ($id == 0) {
    $sql = "INSERT INTO tb_cliente (nome, cpf, telefone, email, endereco)
            VALUES ('$nome', '$cpf', '$telefone', '$email', '$endereco')";
} else {
    $sql = "UPDATE tb_cliente 
            SET nome = '$nome', 
                cpf = '$cpf', 
                telefone = '$telefone', 
                email = '$email', 
                endereco = '$endereco'
            WHERE id_cliente = $id";
}

// Executa a query
mysqli_query($conexao, $sql);

// Redireciona após salvar
header("Location: ../public/listar_cliente.php");
ob_end_flush();
?>
