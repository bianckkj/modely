<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Produtos</title>

</head>
<body>

    <div class="topo"></div>

    <h2>Cadastro de Cliente</h2>
    <form action="salvarcliente.php" method="GET">
        
        <label for="nome">Nome:</label><br>
        <input type="text" id="nome" name="nome" maxlength="45" required><br><br>
        
        <label for="cpf">CPF:</label><br>
        <input type="text" id="cpf" name="cpf" maxlength="45" required><br><br>
        
        <label for="telefone">Telefone:</label><br>
        <input type="text" id="telefone" name="telefone" maxlength="45" required><br><br>
        
        <label for="email">Email:</label><br>
        <input type="text" id="email" name="email" maxlength="45" required><br><br>
        
        <label for="endereco">Endereço:</label><br>
        <input type="text" id="endereco" name="endereco" maxlength="45" required><br><br>

        
        <input type="submit" value="Cadastrar">
    </form>
</body>
</html>
