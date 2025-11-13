<?php
require_once '../controle/conexao.php';

// Valores padrão
$id_vendas = null;
$id_cliente = null;
$id_funcionario = null;
$id_produto = null;
$quantidade = 1;
$data = date('Y-m-d');
$horario = date('H:i');
$comissao = 0.00;

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

$clientes = $conexao->query("SELECT id_cliente, nome FROM tb_cliente ORDER BY nome ASC");
$funcionarios = $conexao->query("SELECT id_funcionario, nome FROM tb_funcionario ORDER BY nome ASC");
$produtos = $conexao->query("SELECT id_produto, nome, preco FROM tb_produto ORDER BY nome ASC");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Vendas</title>

    <!-- Bootstrap e Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- CSS personalizado -->
    <link rel="stylesheet" href="../public/css/header.css">
    <link rel="stylesheet" href="../public/css/styles.css">
</head>

<body class="bg-light">
    <img src="../public/assets/logo.png" alt="logo do site" id="logo" class="d-block mx-auto my-3" style="max-height:80px;">
    <?php require_once './templates/header.html'; ?>

    <div class="container mt-5 mb-5">
        <div class="card shadow-lg rounded-lg">
            <div class="card-header bg-dark text-white text-center">
                <h3 class="mb-0">
                    <i class="fas fa-shopping-cart"></i>
                    <?php echo $id_vendas ? "Editar Venda" : "Cadastrar Venda"; ?>
                </h3>
            </div>

            <div class="card-body p-4">
                <form action="salvarvenda.php" method="POST">
                    <?php if ($id_vendas): ?>
                        <input type="hidden" name="id_vendas" value="<?php echo htmlspecialchars($id_vendas); ?>">
                    <?php endif; ?>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="id_cliente"><i class="fas fa-user"></i> Cliente</label>
                            <select class="form-control" id="id_cliente" name="id_cliente" required>
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
                        </div>

                        <div class="form-group col-md-6">
                            <label for="id_funcionario"><i class="fas fa-user-tie"></i> Funcionário</label>
                            <select class="form-control" id="id_funcionario" name="id_funcionario" required>
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
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <label for="id_produto"><i class="fas fa-box"></i> Produto</label>
                            <select class="form-control" id="id_produto" name="id_produto" required>
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
                        </div>

                        <div class="form-group col-md-4">
                            <label for="quantidade"><i class="fas fa-sort-numeric-up"></i> Quantidade</label>
                            <input type="number" class="form-control" id="quantidade" name="quantidade" min="1" value="<?php echo htmlspecialchars($quantidade); ?>" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="comissao"><i class="fas fa-money-check-alt"></i> Comissão (R$)</label>
                            <input type="number" step="0.01" class="form-control" id="comissao" name="comissao" value="<?php echo htmlspecialchars($comissao); ?>" required>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="data"><i class="fas fa-calendar-alt"></i> Data</label>
                            <input type="date" class="form-control" id="data" name="data" value="<?php echo htmlspecialchars($data); ?>" required>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="horario"><i class="fas fa-clock"></i> Horário</label>
                            <input type="time" class="form-control" id="horario" name="horario" value="<?php echo htmlspecialchars($horario); ?>" required>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-dark px-4">
                            <i class="fas fa-save"></i>
                            <?php echo $id_vendas ? "Salvar Alterações" : "Cadastrar Venda"; ?>
                        </button>
                        <a href="listarvendas.php" class="btn btn-outline-dark px-4 ml-2">
                            <i class="fas fa-arrow-left"></i> Voltar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JS Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
