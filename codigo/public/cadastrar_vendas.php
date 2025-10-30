<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Vendas</title>

    <!-- Bootstrap e Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Seus arquivos CSS -->
    <link rel="stylesheet" href="../public/css/header.css">
    <link rel="stylesheet" href="../public/css/styles.css">
</head>

<body class="p-4">

    <!-- Logo e cabeçalho -->
    <img src="../public/assets/logo.png" alt="logo do site" id="logo" class="mb-4">
    <?php require_once './templates/header.html'; ?>

    <div>
        <h2>Cadastro de Vendas</h2>

        <?php
        // Conexão com o banco
        require_once '../controle/conexao.php';

        // Busca clientes, funcionários e produtos
        $clientes = $conexao->query("SELECT id_cliente, nome FROM tb_cliente ORDER BY nome ASC");
        $funcionarios = $conexao->query("SELECT id_funcionario, nome FROM tb_funcionario ORDER BY nome ASC");
        $produtos = $conexao->query("SELECT id_produto, nome, preco FROM tb_produto ORDER BY nome ASC");
        ?>

        <form action="salvarvenda.php" method="POST">

            <!-- Cliente -->
            <label for="id_cliente">Cliente:</label><br>
            <select id="id_cliente" name="id_cliente" value="<?php echo $id_cliente; ?>" required>
                <option value="">Selecione o cliente</option>
                <?php
                while ($c = $clientes->fetch_assoc()) {
                    echo "<option value='{$c['id_cliente']}'>{$c['nome']}</option>";
                }
                ?>
            </select>
            <br><br>

            <!-- Funcionário -->
            <label for="id_funcionario">Funcionário:</label><br>
            <select id="id_funcionario" name="id_funcionario" value="<?php echo $id_funcionario; ?>" required>
                <option value="">Selecione o funcionário</option>
                <?php
                while ($f = $funcionarios->fetch_assoc()) {
                    echo "<option value='{$f['id_funcionario']}'>{$f['nome']}</option>";
                }
                ?>
            </select>
            <br><br>

            <!-- Produto -->
            <label for="id_produto">Produto:</label><br>
            <select id="id_produto" name="id_produto" value="<?php echo $id_produto; ?>" required>
                <option value="">Selecione o produto</option>
                <?php
                while ($p = $produtos->fetch_assoc()) {
                    echo "<option value='{$p['id_produto']}'>{$p['nome']} - R$ {$p['preco']}</option>";
                }
                ?>
            </select>
            <br><br>

            <!-- Quantidade -->
            <label for="quantidade">Quantidade:</label><br>
            <input type="number" id="quantidade" name="quantidade" value="<?php echo $quantidade; ?>" min="1" required>
            <br><br><

            <!-- Data -->
            <label for="data">Data:</label><br>
            <input type="date" id="data" name="data" value="<?php echo $data; ?>" required>
            <br><br>

            <!-- Horário -->
            <label for="horario">Horário:</label><br>
            <input type="time" id="horario" name="horario" value="<?php echo $harario; ?>" required>
            <br><br>

            <!-- Comissão -->
            <label for="comissao">Comissão (em R$):</label><br>
            <input type="number" step="0.01" id="comissao" name="comissao" value="<?php echo $comissao; ?>" required>
            <br><br>

            <!-- Botão -->
            <button type="submit">Cadastrar Venda</button>
        </form>


</body>

</html>