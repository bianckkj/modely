<?php
    require_once "../controle/conexao.php";
    require_once "../public/funcoes.php";

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $id_usuario = verificarLogin($conexao, $email, $senha);

    if ($id_usuario == 0) {
        header("Location: ../public/index.php");
    }
    else {
        $usuario = pegarDadosUsuario($conexao, $id_usuario);
        
        if ($usuario == 0) {
            header("Location: ../public/index.php");
        }
        else {
            session_start();
            $_SESSION['logado'] = 'sim';
            $_SESSION['tipo'] = $usuario['tipo'];
            $_SESSION['nome'] = $usuario['nome'];
            header("Location: ../public/home.php");
        }
    }
?>