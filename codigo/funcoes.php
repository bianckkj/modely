<?php
function cadastrarProduto($conexao, $nome, $preco, $quantidade, $material, $modelo, $cor, $tamanho, $marca) {}

function cadastrarCliente($conexao, $nome, $cpf, $telefone, $email) {}

function cadastrarFuncionario($conexao, $nome, $cpf, $email, $telefone, $data_nascimento, $salario) {}

function cadastrarVenda($conexao, $idvenda, $idcliente, $idfuncionario, $idproduto) {}

function cadastrarUsuario($conexao, $nome, $usuario, $senha, $email) {}



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

function deletarFuncionario($conexao, $idfuncionario) {}

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



function editarProduto($conexao, $idproduto) {}

function ediatarvendas($conexao) {}

function ediatarFuncionarios($conexao) {}

function ediatarClientes($conexao) {}

function editarUsuario($conexao) {}



function registrarVenda($conexao, $idcliente, $idfuncionario) {}

function baixanoEstoque($conexao, $idroduto, $quantidade) {}

function detalharVenda($conexao, $idvenda) {}

function totalvenda($conexao) {}

function registrarComissao($conexao, $idfuncionario) {}


function aprovarUsuario($conexao, $usuario, $senha) {}


function pesquisarProduto($conexao) {}

function pesquisarVenda($conexao) {}

function pesquisarCliente($conexao) {}

function pesquisarUsuario($conexao) {}

function pesquisarFuncionario($conexao) {}


function agendarvenda($conexao, $idpliente, $idproduto, $idvenda) {}

function loginUsuario($conexao, $email, $senha) {}

?>