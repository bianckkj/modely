
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Cadastro de funcionario</h1>
    <form action="salvarfuncionario.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
         Nome: <br>
        <input type="text" name="nome" value="<?php echo $nome; ?>"> <br><br>
        CPF: <br>
        <input type="text" name="cpf" value="<?php echo $cpf; ?>"> <br><br>
        Email <br>
        <input type="text" name="email" value="<?php echo $email; ?>"> <br><br>
        Telefone: <br>
        <input type="text" name="telefone" value="<?php echo $telefone; ?>"> <br><br>
        Data de nascimento: <br>
        <input type="date" name="data_nascimento" value="<?php echo $data_nascimento; ?>"> <br><br>
         Cargo: <br>
        <input type="text" name="cargo" value="<?php echo $cargo; ?>"> <br><br>
        Carga horaria: <br>
        <input type="decimal" name="carga_horaria" value="<?php echo $carga_horaria; ?>"> <br><br>
        Salario: <br>
        <input type="decimal" name="salario" value="<?php echo $salario; ?>"> <br><br>
        Endereço: <br>
        <input type="text" name="endereco" value="<?php echo $endereco; ?>"> <br><br>

        <input type="submit" value="<?php echo $botao; ?>">
    </form>
</body>
</html>