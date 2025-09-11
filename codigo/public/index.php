
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina login</title>
    <link rel="stylesheet" href="../public/css/styles_form.css">
    <link rel="shortcut icon" href="./assets/download.png" type="image/png">
    <img src="../public/assets/logo.png" alt="logo do site" id="logo">


</head>

<body>

    
    <h2>Login</h2>
    <form action= "../controle/verificar_login.php" method="post">
        E-mail: <br>
        <input type="email" name="email"> <br><br>
        Senha: <br>
        <input type="password" name="senha"> <br><br>
        <div class="oxe">
            <input type="submit" value="Acessar">
            <a href="cadastrar_usuario.php" class="cadastrar">Cadastrar</a>
        </div>

    </form>
</body>

</html>