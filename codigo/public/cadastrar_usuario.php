<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../public/css/header.css">
    <link rel="stylesheet" href="../public/css/styles.css">
</head>
<body>
<img src="../public/assets/logo.png" alt="logo do site" id="logo">



<form action="../public/salvarusuario.php" method="post">
    <h1>Cadastro de Usuário</h1>

        Nome: <br>
        <input type="text" id="nome" name="nome" > <br><br>

        Email: <br>
        <input type="email" id="email" name="email" ><br><br>

        Senha: <br>
        <input type="password" id="senha" name="senha" ><br><br>

        Endereço: <br>
        <input type="text" id="endereco" name="endereco" ><br><br>

    <input type="submit" value="Cadastrar usuario">
</form>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>