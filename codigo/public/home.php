<?php
require_once '../controle/verificar_login.php'
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MODELY</title>
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" href="../public/css/header.css">
    
    <!-- Link Animate.css e AOS.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    
   
</head>

<body>
<?php
        require_once './templates/header.html'
    ?>
    <main>
        <!-- Seções com animação de subida no scroll -->
        <section class="painel" data-aos="fade-up">
        <a href="listar_cliente.php">Listar Cliente</a><br><br>
        <a href="listar_produto.php">Listar Produtos</a><br><br>
        <a href="listar_venda.php">Listar Vendas</a><br><br>
        <a href="listar_funcionario.php">Listar Funcionarios</a><br><br>
        <a href="listar_usuario.php">Listar Usuarios</a>
        </section>

       

    


    </main>


    <!-- Scripts de Inicialização do AOS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
      AOS.init({
        duration: 1000,
        once: false
      });
    </script>
</body>
</html>
