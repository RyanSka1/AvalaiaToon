<?php

session_start();
if(!$_SESSION["usuario"]){
  header('Location: ../index.html');
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Loja</title>

    <link href="../../css/bootstrap.min.css" rel="stylesheet">
    <link href="../../css/pagina.css" rel="stylesheet">
  </head>

  <body>
    <div class="container py-3">
      <a href="../Paginas/index.html">Voltar</a>
      <a href="../php/logout.php">Sair</a>
      <br>
     
        <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
            <h1 class="display-4 fw-normal">Bem-Vindo!</h1>
            <p class="fs-5 text-muted">Contrate os melhores profissionais para as mais diversas áreas!</p>
      </div>

    <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">
      <div class="col">
        <div class="card">
          <div class="card-header py-3">
            <h4>Plano básico</h4>
          </div>
          <div class="card-body">
            <h1>R$ 49,90<small>/mês</small></h1>
            <ul class="list-unstyled mt-3">
              <li>- Até <b>3</b> profissionais</li>
              <li>- <b>15</b> especialidades</li>
              <li>- Suporte on-line</li>
            </ul>
            <button type="button" class="w-100 btn-lg">Contratar</button>
          </div>
        </div>
      </div>
      
      <div class="col">
        <div class="card">
          <div class="card-header py-3">
            <h4>Plano profissional</h4>
          </div>
          <div class="card-body">
            <h1>R$ 99,90<small>/mês</small></h1>
            <ul class="list-unstyled mt-3">
              <li>- Até <b>10</b> profissionais</li>
              <li>- Todas especialidades</li>
              <li>- Suporte on-line</li>
            </ul>
            <button type="button" class="w-100 btn-lg">Contratar</button>
          </div>
        </div>
      </div>
    </div>
    <footer class="my-md-5 pt-md-5">
      <div class="row">
         <div class="col-6">
            <small>&copy; 2021</small>
         </div>
      </div>
    </footer>
   </div>
  </body>
</html>
