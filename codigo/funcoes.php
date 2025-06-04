<?php
function cadastrarProduto($conexao, $nome, $preco, $quantidade, $material, $modelo, $cor, $tamanho, $marca) {}

function cadastrarCliente($conexao, $nome, $cpf, $telefone, $email) {}

function cadastrarFuncionario($conexao, $nome, $cpf, $email, $telefone, $data_nascimento, $salario) {}

function cadastrarVenda($conexao, $idvenda, $idcliente, $idfuncionario, $idproduto) {}

function cadastrarUsuario($conexao, $nome, $usuario, $senha, $email) {}



function listarProdutos($conexao) {}

function listarVendas($conexao) {}

function listarClientes($conexao, ) {}

function listarFuncionarios($conexao) {}

function listarUsuarios($conexao) {}



function deletarCliente($conexao, $idcliente) {}

function deletarVenda($conexao, $idvenda) {}

function deletarFuncionario($conexao, $idfuncionario) {}

function deletarUsuario($conexao, $idusuario) {}

function deletarProduto($conexao, $idproduto) {}



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

function loginUsuario($conexao, $email, $senha) 


?>