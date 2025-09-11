<?php
 require_once '../controle/verificar_login.php'
?>

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

<?php require_once './templates/header.html'; ?>

<form action="../public/salvarusuario.php" method="post">
    <h1>Cadastro de Usuário</h1>
    <p class="message">Preencha os dados abaixo para se cadastrar</p>


    <div class="flex">
        <label>
            Nome: <br>
            <input type="text" class="input" name="nome" required title="Digite o nome do usuário">
        </label>
    </div>

    <div class="flex">
        <label>
            Email: <br>
            <input type="email" class="input" name="email" required title="Digite o email do usuário">
        </label>
    </div>


    <div class="flex">
        <label>
            Senha: <br>
            <input type="password" class="input" name="senha" required title="Escolha uma senha segura para o usuário">
        </label>
    </div>

    <div class="flex">
        <label>
            Endereço: <br>
            <input type="text" class="input" name="endereco" required title="Digite o endereço do usuário">
        </label>
    </div>

    <button type="submit" class="submit" title="Clique para cadastrar o usuário">Cadastrar Usuário</button>
</form>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>