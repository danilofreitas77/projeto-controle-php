<?php

    //session_start();
    include '../../controller/conexao.php';
    include '../templates/header.php';
?>

<main>

    <div style="text-align: center;" class="alert alert-primary" role="alert">
        Clique no mês desejado e veja as informações! Lembrando: em caso de dúvida, pode entrar em contato com a Administração.
    </div>

    <div id="accordionMeses" class="accordion"></div>

</main>

<script>
    fetch('../../api/get_meses_pagamentos.php')
  .then(res => res.json())
  .then(meses => {
    const mesesMap = {
      1: 'Janeiro', 2: 'Fevereiro', 3: 'Março', 4: 'Abril',
      5: 'Maio', 6: 'Junho', 7: 'Julho', 8: 'Agosto',
      9: 'Setembro', 10: 'Outubro', 11: 'Novembro', 12: 'Dezembro'
    };

    const accordion = document.getElementById('accordionMeses');
    accordion.innerHTML = '';

    if(meses.length === 0) {
      accordion.innerHTML = '<p>Nenhum pagamento registrado ainda.</p>';
      return;
    }

    meses.forEach(mes => {
      const headerId = `heading${mes}`;
      const collapseId = `collapse${mes}`;
      accordion.innerHTML += `
        <div class="accordion-item">
          <h2 class="accordion-header" id="${headerId}">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#${collapseId}" aria-expanded="false" aria-controls="${collapseId}">
              ${mesesMap[mes]}
            </button>
          </h2>
          <div id="${collapseId}" class="accordion-collapse collapse" aria-labelledby="${headerId}" data-bs-parent="#accordionMeses">
            <div class="accordion-body">
              <p>Informações do mês de ${mesesMap[mes]}.</p>
              <a href="ver_despesas.php?mes=${mes}" class="btn btn-danger">Ver despesas</a>
            </div>
          </div>
        </div>
      `;
    });
  })
  .catch(err => {
    console.error('Erro ao carregar meses:', err);
  });

</script>

<?php
    include '../templates/footer.php';
?>

