<?php

    //session_start();
    include '../controller/conexao.php';
    require_once '../middleware/verificar_login.php';
    include 'templates/header.php';
?>



<main>
    <h1 style="margin-top: 3%; margin-left: 1%;">Seja Bem-Vindo (a) ao nosso</h1>
    <h2 style="margin-left: 1%; color: black; margin-bottom: 8%;">Portal da Transparência</h2>

<div class="container">
  <div class="row g-4">
    
    <div class="col-12 col-md-6">
      <a class="card1" href="#">
        <p>Relatório de Despesas 🗂️</p>
        <p class="small">Aqui você consegue acompanhar todas as despesas com o máximo de transparência!</p>
        <div class="go-corner">
          <div class="go-arrow">→</div>
        </div>
      </a>
    </div>


<?php if($_SESSION['tipo'] == 'admin'): ?>
    <div class="col-12 col-md-6">
      <a class="card1" href="#">
        <p>Relatório Por Mês 📅</p>
        <p class="small">Todos os detalhes dos meses e possibilidade de edição.</p>
        <div class="go-corner">
          <div class="go-arrow">→</div>
        </div>
      </a>
    </div>

    <div class="col-12 col-md-6">
      <a class="card1" href="#">
        <p>Adicionar Pagamentos 📅</p>
        <p class="small">Todos os detalhes dos meses e possibilidade de edição.</p>
        <div class="go-corner">
          <div class="go-arrow">→</div>
        </div>
      </a>
    </div>

    <div class="col-12 col-md-6">
      <a class="card1" href="#">
        <p>Adicionar Extrato Bancário 📅</p>
        <p class="small">Todos os detalhes dos meses e possibilidade de edição.</p>
        <div class="go-corner">
          <div class="go-arrow">→</div>
        </div>
      </a>
    </div>

    <div class="col-12 col-md-6">
      <a class="card1" href="#">
        <p>Adicionar Demonstrativo 📅</p>
        <p class="small">Todos os detalhes dos meses e possibilidade de edição.</p>
        <div class="go-corner">
          <div class="go-arrow">→</div>
        </div>
      </a>
    </div>
<?php endif; ?>

  </div>
</div>

</main>



<?php
    include 'templates/footer.php';
?>
