<?php

    //session_start();
    include '../../controller/conexao.php';
    include '../templates/header.php';
?>




<main>
  <h3 id="valorTotalMes">Total do mês: R$ 0,00</h3>
  <div class="accordion mt-4" id="accordionSetores"></div>
</main>

<script>
const mes = new URLSearchParams(window.location.search).get('mes');

fetch(`../../api/get_resumo_mes.php?mes=${mes}`)
  .then(res => res.json())
  .then(data => {
    document.getElementById('valorTotalMes').innerText = `Total do mês: R$ ${parseFloat(data.total_geral).toFixed(2).replace('.', ',')}`;
    const acc = document.getElementById('accordionSetores');
    acc.innerHTML = '';

    data.setores.forEach((setor, i) => {
      const setorId = `setor${i}`;
      let subsetoresHTML = '';
      setor.subsetores.forEach(sub => {
        subsetoresHTML += `
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <span>${sub.nome_subsetor}</span>
            <div>
              <span class="me-3">R$ ${parseFloat(sub.total_subsetor).toFixed(2).replace('.', ',')}</span>
              <a href="ver_subsetor.php?mes=${mes}&subsetor=${sub.id_subsetor}" class="btn btn-sm btn-outline-primary">Ver detalhes</a>
            </div>
          </li>`;
      });

      acc.innerHTML += `
        <div class="accordion-item">
          <h2 class="accordion-header" id="heading${setorId}">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse${setorId}">
              ${setor.nome_setor} — R$ ${parseFloat(setor.total_setor).toFixed(2).replace('.', ',')}
            </button>
          </h2>
          <div id="collapse${setorId}" class="accordion-collapse collapse" data-bs-parent="#accordionSetores">
            <div class="accordion-body">
              <ul class="list-group">${subsetoresHTML}</ul>
            </div>
          </div>
        </div>`;
    });
  })
  .catch(err => console.error('Erro ao buscar resumo:', err));
</script>





<?php
    include '../templates/footer.php';
?>