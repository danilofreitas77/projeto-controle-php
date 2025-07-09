<?php

    //session_start();
    include '../controller/conexao.php';
    require_once '../middleware/verificar_login.php';
    include 'templates/header.php';
?>

<main>

    <div style="text-align: center;" class="alert alert-primary" role="alert">
        Clique no mês desejado e veja as informações! Lembrando: em caso de dúvida, pode entrar em contato com a Administração.
    </div>

    <div class="accordion accordion-flush" id="accordionFlushExample">
  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
        Junho
      </button>
    </h2>
    <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">
        <div class="d-grid gap-3"> <!-- Garante espaçamento e largura total -->
            <a href="#">
                <button class="btn btn-success w-100">Receitas</button>
            </a>
            <a href="#">
                <button class="btn btn-danger w-100">Despesas</button>
            </a>
            <a href="#">
                <button class="btn btn-primary w-100">Previsão Orçamentária</button>
            </a>
            <a href="#">
                <button class="btn btn-primary w-100">Receitas x Despesas</button>
            </a>
        </div>
    </div>
  </div>

  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
        Julho
      </button>
    </h2>
    <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body"><div style="text-align: center;" class="alert alert-primary" role="alert">
        As informações do mês de Julho estarão disponíveis a partir do dia 5 de Agosto.
    </div></div>
    </div>
  </div>
</main>



<?php
    include 'templates/footer.php';
?>

