<?php
require_once 'conexao.php';

session_start(); // Inicia a sessão no início do arquivo

$login = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

if (empty($login) || empty($senha)) {
    header("Location: ../public/index.php");
    exit;
}

$sql = "SELECT * FROM tb_usuario WHERE email = '$login'";
$resultados = mysqli_query($conexao, $sql);

if (mysqli_num_rows($resultados) == 0) {
    // Usuário não cadastrado
    header("Location: ../public/index.php");
    exit;
}

$linha = mysqli_fetch_array($resultados);
$senhaHash = $linha['senha'];

if (password_verify($senha, $senhaHash)) {
    $_SESSION['logado'] = 1;
    $_SESSION['email'] = $login; // salva email para perfil
    header("Location: ../public/home.php");
    exit;
} else {
    header("Location: ../public/index.php");
    exit;
}
?>
