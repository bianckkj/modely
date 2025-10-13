<?php

if (isset($_GET['id'])) {
    // echo "editar...";

    $id = $_GET['id'];

    require_once "../controle/conexao.php";
    $sql = "SELECT * FROM tb_funcionario WHERE id_funcionario = ?";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($comando, "i", $id);
    mysqli_stmt_execute($comando);

    $resultados = mysqli_stmt_get_result($comando);

    $funcionario = mysqli_fetch_assoc($resultados);

    $nome = $funcionario['nome'];
    $cpf = $funcionario['cpf'];
    $email = $funcionario['email'];
    $telefone = $funcionario['telefone'];
    $data_nascimento = $funcionario['data_nascimento'];
    $carga_horaria = $funcionario['carga_horaria'];
    $salario = $funcionario['salario'];
    $endereco = $funcionario['endereco'];



    mysqli_stmt_close($comando);
}
else {
    // echo "novo...";

    $id = 0;
    $nome = "";
    $cpf = "";
    $email = "";
    $telefone = "";
    $data_nascimento = "";
    $carga_horaria = "";
    $salario = "";
    $endereco = "";
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Funcionario</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../public/css/header.css">
    <link rel="stylesheet" href="../public/css/styles.css">

</head>
<body>
    <img src="../public/assets/logo.png" alt="logo do site" id="logo">

    <?php require_once './templates/header.html'; ?>

    <h2>Cadastro de Funcionário</h2>

    <div class="container-form">
        <form class="form" action="salvarfuncionario.php?id=<?php echo $id; ?>" method="GET">
            
            Nome:<br>
            <input type="text" id="nome" name="nome" value="<?php echo $nome; ?>"> <br><br>
            
            CPF:<br>
            <input type="text" id="cpf" name="cpf" value="<?php echo $cpf; ?>"> <br><br>
            
            Email:<br>
            <input type="text" id="email" name="email" value="<?php echo $email; ?>"> <br><br>
            
            Telefone:<br>
            <input type="text" id="telefone" name="telefone" value="<?php echo $telefone ?>"> ><br><br>
            
            Data de Nascimento:<br>
            <input type="date" id="data_nascimento" name="data_nascimento" value="<?php echo $data_nascimento; ?>"><br><br>

            Carga Horária:<br>
            <input type="time" id="carga_horaria" name="carga_horaria" value="<?php echo $carga_horaria; ?>"><br><br>

            Salário:<br>
            <input type="decimal" id="salario" name="salario" value="<?php echo $salario; ?>"><br><br>

            Endereço:<br>
            <input type="text" id="endereco" name="endereco" value="<?php echo $endereco; ?>"><br><br>

            
            <input type="submit" value="Cadastrar Funcionario">
        </form>
    </div>

</body>
</html>