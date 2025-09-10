
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../public/css/header.css">
    <link rel="stylesheet" href="../public/css/styles.css">
</head>
<body>
    <img src="../public/assets/logo.png" alt="logo do site" id="logo">

    <?php require_once './templates/header.html'; ?>
    
    <h1>Cadastro de funcionario</h1>
    <form action="salvarfuncionario.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
         Nome: <br>
        <input type="text" name="nome" > <br><br>
        CPF: <br>
        <input type="text" name="cpf" > <br><br>
        Email <br>
        <input type="text" name="email"> <br><br>
        Telefone: <br>
        <input type="text" name="telefone" > <br><br>
        Data de nascimento: <br>
        <input type="date" name="data_nascimento" > <br><br>
         Cargo: <br>
        <input type="text" name="cargo" > <br><br>
        Carga horaria: <br>
        <input type="decimal" name="carga_horaria" > <br><br>
        Salario: <br>
        <input type="decimal" name="salario" > <br><br>
        Endereço: <br>
        <input type="text" name="endereco" > <br><br>

        <input type="submit">
    </form>
</body>
</html>