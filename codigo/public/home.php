<?php
// require_once '../controle/verificar_login.php'
require_once '../controle/verificarlogado.php'
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
  <form class="pesquisa" action="resultado.html" method="get">
    <input type="text" name="q" placeholder="Pesquisar...">
    <button type="submit">OK</button>
  </form>


<div class="icones">
    <a href="login.html"><img src="../public/assets/foto_usuario.png" alt="Usuário"></a>
      
    <a href="carrinho.html"><img src="../public/assets/foto_carrinho.png" alt="Carrinho"></a>
         
</div>







<img src="../public/assets/logo.png" alt="logo do site" id="logo">




<nav class="categories">
    <a href="#">DESCONTOS</a>
    <a href="#">FEMININO</a>
    <a href="#">MASCULINO</a>
    <a href="#">NOVIDADES</a>
</nav>
<br>

<img src="../public/assets/imagem_home.png" class="imagem_home">


  <div class="vitrine">
    <div class="produto">
      <img src="../public/assets/vestidorosa.png" alt="Vestido Le Lis Lise Seda Feminino">
      <div class="marca">LE LIS</div>
      <div class="titulo">Vestido Le Lis Katia | Feminino</div>
      <div class="preco-antigo">R$ 989,90</div>
      <div class="preco">R$ 296,97</div>
      <div class="desconto">-70%</div>
    </div>

    <div class="produto">
      <img src="../public/assets/vestidorosaxdrez.png" alt="Vestido Le Lis Kim Midi Feminina">
      <div class="marca">LE LIS</div>
      <div class="titulo">Vestido Le Lis Donatela Feminino</div>
      <div class="preco-antigo">R$ 1.980,00</div>
      <div class="preco">R$ 594,00</div>
      <div class="desconto">-70%</div>
    </div>

    <div class="produto">
      <img src="../public/assets/vestidoflor.png" alt="Vestido Le Lis Juju Seda Midi Feminino">
      <div class="marca">LE LIS</div>
      <div class="titulo">Vestido Le Lis Regata Leila Longo</div>
      <div class="preco-antigo">R$ 789,90</div>
      <div class="preco">R$ 315,96</div>
      <div class="desconto">-60%</div>
    </div>

    <div class="produto">
      <img src="../public/assets/vestidoverde.png" alt="Vestido Le Lis Caroline Midi Feminino">
      <div class="marca">LE LIS</div>
      <div class="titulo">Vestido Le Lis Midi Floral</div>
      <div class="preco-antigo">R$ 699,90</div>
      <div class="preco">R$ 279,96</div>
      <div class="desconto">-60%</div>
    </div>

    <div class="produto">
      <img src="../public/assets/oncaverde.png" alt="Chemise Le Lis Eve Seda Midi Feminina">
      <div class="marca">LE LIS</div>
      <div class="titulo">Vestido Le Lis Longo Azul</div>
      <div class="preco-antigo">R$ 1.199,90</div>
      <div class="preco">R$ 479,96</div>
      <div class="desconto">-60%</div>
    </div>
  </div>



<?php
        require_once '../public/templates/header.html'
    ?>
    <main>


    </main>


    <!-- Scripts de Inicialização do AOS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
      AOS.init({
        duration: 1000,
        once: false
      });
    </script>

    <form action="../controle/deslogar.php" method="post">
        <button type="submit" class="btn-logout">Deslogar</button>
    </form>    

</body>
</html>
