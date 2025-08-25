<?php
session_start();
if (!isset($_SESSION['logado'])) {
    // echo "nao posso acessar";
    header("Location: ../public/index.php");
}
?>