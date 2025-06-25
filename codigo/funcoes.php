<?php
function cadastrarProduto($conexao, $nome, $preco, $quantidade, $material, $modelo, $cor, $tamanho, $marca) {
    $sql = "INSERT INTO tb_produto (quantidade, material, preco, modelo, cor, tamanho, marca, imagem) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, "ssdsssss", $quantidade, $material, $preco, $modelo, $cor, $tamanho, $marca, $imagem);
    return mysqli_stmt_execute($comando);
}

function cadastrarCliente($conexao, $nome, $cpf, $telefone, $email, $endereco) {
    $sql = "INSERT INTO tb_cliente (nome, cpf, telefone, email, endereco) VALUES (?, ?, ?, ?, ?)";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($comando, "sssss", $nome, $cpf, $telefone, $email, $endereco);
    $resultado = mysqli_stmt_execute($comando);

    return $resultado;
}

function cadastrarFuncionario($conexao, $nome, $cpf, $email, $telefone, $data_nascimento, $salario) {
    $sql = "INSERT INTO tb_funcionario (cpf, email, telefone, data_nascimento, carga_horaria, salario, endereco) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, "ssssssd", $cpf, $email, $telefone, $data_nascimento, $carga_horaria, $salario, $endereco);
    return mysqli_stmt_execute($comando);
}

function cadastrarVenda($conexao, $idvenda, $idcliente, $idfuncionario, $idproduto) {
    $sql = "INSERT INTO tb_vendas (tb_cliente_id_cliente, tb_funcionario_id_funcionario, horario, data, comissao) VALUES (?, ?, ?, ?, ?)";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, "iissd", $idcliente, $idfuncionario, $horario, $data, $comissao);
    return mysqli_stmt_execute($comando);
}

function cadastrarUsuario($conexao, $nome, $usuario, $senha, $email) {
    $sql = "INSERT INTO tb_usuario (nome, senha, email, endereco) VALUES (?, ?, ?, ?)";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, "ssss", $nome, $senha, $email, $endereco);
    return mysqli_stmt_execute($comando);
}



function listarProdutos($conexao) {
    $sql = "SELECT * FROM tb_produto";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_execute($comando);
    $resultado = mysqli_stmt_get_result($comando);

    $lista_produtos = [];
    while ($produto = mysqli_fetch_assoc($resultado)) {
        $lista_produtos[] = $produto;
    }

    mysqli_stmt_close($comando);
    return $lista_produtos;
}

function listarVendas($conexao) {
    $sql = "SELECT * FROM tb_vendas";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_execute($comando);
    $resultado = mysqli_stmt_get_result($comando);

    $lista_vendas = [];
    while ($vendas = mysqli_fetch_assoc($resultado)) {
        $lista_vendas[] = $vendas;
    }

    mysqli_stmt_close($comando);
    return $lista_vendas;
}

function listarClientes($conexao, ) {
    $sql = "SELECT * FROM tb_cliente";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_execute($comando);
    $resultado = mysqli_stmt_get_result($comando);

    $lista_cliente = [];
    while ($cliente = mysqli_fetch_assoc($resultado)) {
        $lista_cliente[] = $cliente;
    }

    mysqli_stmt_close($comando);
    return $lista_cliente;
}

function listarFuncionarios($conexao) {
    $sql = "SELECT * FROM tb_funcionario";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_execute($comando);
    $resultado = mysqli_stmt_get_result($comando);

    $lista_funcionarios = [];
    while ($funcionario = mysqli_fetch_assoc($resultado)) {
        $lista_funcionarios[] = $funcionario;
    }

    mysqli_stmt_close($comando);
    return $lista_funcionarios;
}

function listarUsuarios($conexao) {
    $sql = "SELECT * FROM tb_usuario";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_execute($comando);
    $resultado = mysqli_stmt_get_result($comando);

    $lista_usuario = [];
    while ($usuario = mysqli_fetch_assoc($resultado)) {
        $lista_usuario[] = $usuario;
    }

    mysqli_stmt_close($comando);
    return $lista_usuario;
}



function deletarCliente($conexao, $id_cliente) {
    $sql = "DELETE FROM tb_cliente WHERE id_cliente = ?";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($comando, 'i', $id_cliente);
    $funcionou = mysqli_stmt_execute($comando);

    mysqli_stmt_close($comando);
    
    return $funcionou;
}

function deletarVenda($conexao, $id_vendas) {
    $sql = "DELETE FROM tb_vendas WHERE id_vendas = ?";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($comando, 'i', $id_vendas);
    $funcionou = mysqli_stmt_execute($comando);

    mysqli_stmt_close($comando);
    
    return $funcionou;
}

function deletarFuncionario($conexao, $id_funcionario) {
    $sql = "DELETE FROM tb_funcionario WHERE id_funcionario = ?";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($comando, 'i', $id_funcionario);
    $funcionou = mysqli_stmt_execute($comando);

    mysqli_stmt_close($comando);
    
    return $funcionou;
}

function deletarUsuario($conexao, $id_usuario) {
    $sql = "DELETE FROM tb_usuario WHERE id_usuario = ?";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($comando, 'i', $id_usuario);
    $funcionou = mysqli_stmt_execute($comando);

    mysqli_stmt_close($comando);
    
    return $funcionou;
}

function deletarProduto($conexao, $id_produto) {
    $sql = "DELETE FROM tb_produto WHERE id_produto = ?";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($comando, 'i', $id_produto);
    $funcionou = mysqli_stmt_execute($comando);

    mysqli_stmt_close($comando);
    
    return $funcionou;
}



function editarProduto($conexao, $quantidade, $material, $preco, $modelo, $cor, $tamanho, $marca, $imagem, $id_produto) {
    $sql = "UPDATE tb_produto SET quantidade=?, material=?, preco=? modelo=? cor=? tamanho=? marca=? imagem=? WHERE id_produto=?";
    $comando = mysqli_prepare($conexao, $sql);
    
    mysqli_stmt_bind_param($comando, 'sssssssbi', $quantidade, $material, $preco, $modelo, $cor, $tamanho, $marca, $imagem, $id_produto);
    

    $funcionou = mysqli_stmt_execute($comando);
    
    mysqli_stmt_close($comando);
    return $funcionou;
}

function editarvendas($conexao, $tb_cliente_id_cliente, $tb_funcionario_id_funcionario, $horario, $data, $comissao, $id_vendas) {
    $sql = "UPDATE tb_vendas SET tb_cliente_id_cliente=?, tb_funcionario_id_funcionario=?, horario=?, data=?, comissao=? WHERE id_vendas=?";
    $comando = mysqli_prepare($conexao, $sql);
    
    mysqli_stmt_bind_param($comando, 'iissdi', $tb_cliente_id_cliente, $tb_funcionario_id_funcionario, $horario, $data, $comissao, $id_vendas);
    

    $funcionou = mysqli_stmt_execute($comando);
    
    mysqli_stmt_close($comando);
    return $funcionou;
}

function editarFuncionarios($conexao, $cpf, $email, $telefone, $data_nascimento, $carga_horaria, $salario, $endereco, $id_funcionario) {
    $sql = "UPDATE tb_funcionario SET cpf=?, email=?, telefone=?, data_nascimento=?, carga_horaria=?, salario=?, endereco=? WHERE id_funcionario=?";

    $comando = mysqli_prepare($conexao, $sql);
    
    mysqli_stmt_bind_param($comando, 'sssssdsi', $cpf, $email, $telefone, $data_nascimento, $carga_horaria, $salario, $endereco, $id_funcionario);
    

    $funcionou = mysqli_stmt_execute($comando);
    
    mysqli_stmt_close($comando);
    return $funcionou;
}

function editarClientes($conexao, $nome, $cpf, $telefone, $email, $endereco, $id_cliente) {
    $sql = "UPDATE tb_cliente SET nome=?, cpf=?, telefone=?, email=?, endereco=? WHERE id_cliente=?";

    $comando = mysqli_prepare($conexao, $sql);
    
    mysqli_stmt_bind_param($comando, 'sssssi', $nome, $cpf, $telefone, $email, $endereco, $id_cliente);
    

    $funcionou = mysqli_stmt_execute($comando);
    
    mysqli_stmt_close($comando);
    return $funcionou;
}

function editarUsuario($conexao, $nome, $senha, $email, $endereco, $id_usuario) {
    $sql = "UPDATE tb_usuario SET nome=?, senha=?, email=?, endereco=? WHERE id_usuario=?";

    $comando = mysqli_prepare($conexao, $sql);
    
    mysqli_stmt_bind_param($comando, 'ssssi', $nome, $senha, $email, $endereco, $id_usuario);
    

    $funcionou = mysqli_stmt_execute($comando);
    
    mysqli_stmt_close($comando);
    return $funcionou;
}



function registrarVenda($conexao, $idcliente, $idfuncionario) {}

function baixanoEstoque($conexao, $idroduto, $quantidade) {}

function detalharVenda($conexao, $idvenda) {}

function totalvenda($conexao) {}

function registrarComissao($conexao, $idfuncionario) {}


function aprovarUsuario($conexao, $usuario, $senha) {}


function pesquisarProduto($conexao, $id_produto) {
     $sql = "SELECT * FROM tb_produto WHERE id_produto = ?";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($comando, 'i', $id_produto);

    mysqli_stmt_execute($comando);
    $resultado = mysqli_stmt_get_result($comando);

    $produto = mysqli_fetch_assoc($resultado);

    mysqli_stmt_close($comando);
    return $produto;
}

function pesquisarVenda($conexao, $id_vendas) {
    $sql = "SELECT * FROM tb_vendas WHERE id_vendas = ?";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($comando, 'i', $id_vendas);

    mysqli_stmt_execute($comando);
    $resultado = mysqli_stmt_get_result($comando);

    $vendas = mysqli_fetch_assoc($resultado);

    mysqli_stmt_close($comando);
    return $vendas;
}

function pesquisarCliente($conexao, $id_cliente) {
    $sql = "SELECT * FROM tb_cliente WHERE id_cliente = ?";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($comando, 'i', $id_cliente);

    mysqli_stmt_execute($comando);
    $resultado = mysqli_stmt_get_result($comando);

    $cliente = mysqli_fetch_assoc($resultado);

    mysqli_stmt_close($comando);
    return $cliente;
}

function pesquisarUsuario($conexao, $id_usuario ) {
    $sql = "SELECT * FROM tb_usuario WHERE id_usuario = ?";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($comando, 'i', $id_usuario);

    mysqli_stmt_execute($comando);
    $resultado = mysqli_stmt_get_result($comando);

    $usuario = mysqli_fetch_assoc($resultado);

    mysqli_stmt_close($comando);
    return $usuario;
}

function pesquisarFuncionario($conexao, $id_funcionario) {
    $sql = "SELECT * FROM tb_funcionario WHERE id_funcionario = ?";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($comando, 'i', $id_funcionario);

    mysqli_stmt_execute($comando);
    $resultado = mysqli_stmt_get_result($comando);

    $funcionario = mysqli_fetch_assoc($resultado);

    mysqli_stmt_close($comando);
    return $funcionario;
}


function agendarvenda($conexao, $idpliente, $idproduto, $idvenda) {}

function loginUsuario($conexao, $email, $senha) {}

?>