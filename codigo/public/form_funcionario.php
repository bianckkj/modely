<?php
    if (isset($_GET['id'])) {
        // echo "editar";
        
    require_once "../controle/conexao.php";
    require_once "../public/funcoes.php";

        $id = $_GET['id'];
        
        $funcionario = pesquisarFuncionario ($conexao, $id);
        $cpf = $funcionario['cpf'];
        $email = $funcionario['email'];
        $telefone = $funcionario['telefone'];
        $data_nascimento = $funcionario['data_nascimento'];
        $carga_horaria = $funcionario['carga_horaria'];
        $salario = $funcionario['salario'];
        $endereco = $funcionario['endereco'];

        $botao = "Atualizar";
    }
    else {
        // echo "novo";
        $id = 0;
        $cpf = "";
        $email = "";
        $telefone = "";
        $data_nascimento = "";
        $carga_horaria = "";
        $salario = "";
        $endereco = "";

        $botao = "Cadastrar";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Cadastro de funcionario</h1>
    <form action="salvarCliente.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">

        CPF: <br>
        <input type="text" name="cpf" value="<?php echo $cpf; ?>"> <br><br>
        Email <br>
        <input type="text" name="email" value="<?php echo $email; ?>"> <br><br>
        Telefone: <br>
        <input type="text" name="telefone" value="<?php echo $telefone; ?>"> <br><br>
        Data de nascimento: <br>
        <input type="date" name="data_nascimento" value="<?php echo $data_nascimento; ?>"> <br><br>
        Carga horaria: <br>
        <input type="text" name="carga_horaria" value="<?php echo $carga_horaria; ?>"> <br><br>
        Salario: <br>
        <input type="text" name="salario" value="<?php echo $salario; ?>"> <br><br>
        Endereço: <br>
        <input type="text" name="endereco" value="<?php echo $endereco; ?>"> <br><br>

        <input type="submit" value="<?php echo $botao; ?>">
    </form>
</body>
</html>