<?php
session_start();
if (isset($_SESSION['logado'])) {
    header("Location: home.php");
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina login</title>
    <link rel="stylesheet" href="../public/css/styles_form.css">
    <link rel="shortcut icon" href="./assets/download.png" type="image/png">


</head>

<body>
    <h2>Login do Usuario</h2>
    <form action="../controle/login.php" method="post">
        E-mail: <br>
        <input type="email" name="login"> <br><br>
        Senha: <br>
        <input type="password" name="senha"> <br><br>
        <div class="oxe">
            <input type="submit" value="Acessar">
            <a href="cadastro_usuario.php" class="cadastrar">Cadastrar</a>
        </div>

    </form>
</body>

</html>