<?php
session_start(); // Inicia a sessão

require_once '../controle/conexao.php'; // ajuste o caminho conforme sua estrutura

if (!isset($_SESSION['email'])) {
    echo "Erro: usuário não encontrado na sessão.";
    exit;
}

$email = $_SESSION['email'];

$sql = "SELECT * FROM tb_usuario WHERE email = '$email'";
$resultado = mysqli_query($conexao, $sql);

if (mysqli_num_rows($resultado) == 0) {
    echo "Usuário não encontrado no banco de dados.";
    exit;
}

$usuario = mysqli_fetch_assoc($resultado);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Perfil do Usuário</title>
</head>
<body>
    <h1>Perfil do Usuário</h1>
    <p><strong>ID:</strong> <?php echo $usuario['id_usuario']; ?></p>
    <p><strong>Nome:</strong> <?php echo $usuario['nome']; ?></p>
    <p><strong>Email:</strong> <?php echo $usuario['email']; ?></p>
    <p><strong>Endereço:</strong> <?php echo $usuario['endereco']; ?></p>
    <p><strong>Tipo:</strong> <?php echo $usuario['tipo']; ?></p>
</body>
</html>
