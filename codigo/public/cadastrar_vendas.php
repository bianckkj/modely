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
    require_once '../controle/conexao.php';

    // valores padrão (caso seja cadastro novo)
    $id_vendas = null;
    $id_cliente = null;
    $id_funcionario = null;
    $id_produto = null;
    $quantidade = 1;
    $data = date('Y-m-d');
    $horario = date('H:i');
    $comissao = 0.00;

    // Se veio id via GET, carrega os dados da venda para edição
    if (isset($_GET['id'])) {
        $id_vendas = (int) $_GET['id'];
        if ($id_vendas > 0) {
            $sql = "
                SELECT 
                    v.id_vendas,
                    v.id_cliente,
                    v.id_funcionario,
                    v.data,
                    v.horario,
                    v.comissao,
                    iv.id_produto,
                    iv.quantidade
                FROM tb_vendas v
                LEFT JOIN tb_itens_vendas iv ON v.id_vendas = iv.id_vendas
                WHERE v.id_vendas = ?
                LIMIT 1
            ";
            if ($stmt = $conexao->prepare($sql)) {
                $stmt->bind_param("i", $id_vendas);
                $stmt->execute();
                $res = $stmt->get_result();
                if ($row = $res->fetch_assoc()) {
                    $id_cliente = $row['id_cliente'];
                    $id_funcionario = $row['id_funcionario'];
                    // se houver vários itens, esse SELECT pega apenas o primeiro item.
                    $id_produto = $row['id_produto'];
                    $quantidade = $row['quantidade'] ?? 1;
                    $data = $row['data'] ?? $data;
                    $horario = $row['horario'] ?? $horario;
                    $comissao = $row['comissao'] ?? $comissao;
                }
                $stmt->close();
            }
        }
    }

    // Busca listas (clientes, funcionarios, produtos)
    $clientes = $conexao->query("SELECT id_cliente, nome FROM tb_cliente ORDER BY nome ASC");
    $funcionarios = $conexao->query("SELECT id_funcionario, nome FROM tb_funcionario ORDER BY nome ASC");
    $produtos = $conexao->query("SELECT id_produto, nome, preco FROM tb_produto ORDER BY nome ASC");
    ?>

    <!-- Ao submeter, o salvarvenda.php deve detectar se id_vendas foi enviado para atualizar -->
    <form action="salvarvenda.php" method="POST">

        <?php if ($id_vendas): ?>
            <input type="hidden" name="id_vendas" value="<?php echo htmlspecialchars($id_vendas); ?>">
        <?php endif; ?>

        <!-- Cliente -->
        <label for="id_cliente">Cliente:</label><br>
        <select id="id_cliente" name="id_cliente" required>
            <option value="">Selecione o cliente</option>
            <?php
            if ($clientes) {
                while ($c = $clientes->fetch_assoc()) {
                    $sel = ($c['id_cliente'] == $id_cliente) ? "selected" : "";
                    echo "<option value='{$c['id_cliente']}' $sel>" . htmlspecialchars($c['nome']) . "</option>";
                }
            }
            ?>
        </select>
        <br><br>

        <!-- Funcionário -->
        <label for="id_funcionario">Funcionário:</label><br>
        <select id="id_funcionario" name="id_funcionario" required>
            <option value="">Selecione o funcionário</option>
            <?php
            if ($funcionarios) {
                while ($f = $funcionarios->fetch_assoc()) {
                    $sel = ($f['id_funcionario'] == $id_funcionario) ? "selected" : "";
                    echo "<option value='{$f['id_funcionario']}' $sel>" . htmlspecialchars($f['nome']) . "</option>";
                }
            }
            ?>
        </select>
        <br><br>

        <!-- Produto -->
        <label for="id_produto">Produto:</label><br>
        <select id="id_produto" name="id_produto" required>
            <option value="">Selecione o produto</option>
            <?php
            if ($produtos) {
                while ($p = $produtos->fetch_assoc()) {
                    $sel = ($p['id_produto'] == $id_produto) ? "selected" : "";
                    $preco = number_format($p['preco'], 2, ',', '.');
                    echo "<option value='{$p['id_produto']}' $sel>" . htmlspecialchars($p['nome']) . " - R$ {$preco}</option>";
                }
            }
            ?>
        </select>
        <br><br>

        <!-- Quantidade -->
        <label for="quantidade">Quantidade:</label><br>
        <input type="number" id="quantidade" name="quantidade" value="<?php echo htmlspecialchars($quantidade); ?>" min="1" required>
        <br><br>

        <!-- Data -->
        <label for="data">Data:</label><br>
        <input type="date" id="data" name="data" value="<?php echo htmlspecialchars($data); ?>" required>
        <br><br>

        <!-- Horário -->
        <label for="horario">Horário:</label><br>
        <input type="time" id="horario" name="horario" value="<?php echo htmlspecialchars($horario); ?>" required>
        <br><br>

        <!-- Comissão -->
        <label for="comissao">Comissão (em R$):</label><br>
        <input type="number" step="0.01" id="comissao" name="comissao" value="<?php echo htmlspecialchars($comissao); ?>" required>
        <br><br>

        <button type="submit"><?php echo $id_vendas ? 'Atualizar Venda' : 'Cadastrar Venda'; ?></button>
    </form>

</body>

</html>