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

    <div class="accordion accordion-flush" id="accordionFlushExample"></div>

</main>

<script>
    fetch('../api/listar_meses.php')
        .then(response => response.json())
        .then(meses => {
            const accordion = document.getElementById('accordionFlushExample');
            accordion.innerHTML = ''; // limpa o conteúdo original

            meses.forEach((mes, index) => {

                const nomeMesFormatado = mes.charAt(0).toUpperCase() + mes.slice(1).toLowerCase();

                const id = `mes-${index}`;
                accordion.innerHTML += `
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#${id}" aria-expanded="false" aria-controls="${id}">
                            ${mes}
                        </button>
                    </h2>
                    <div id="${id}" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <div class="d-grid gap-3">
                                <a href="#"><button class="btn btn-outline-success w-100">Receitas</button></a>
                                <a href="#"><button class="btn btn-outline-danger w-100">Despesas</button></a>
                                <a href="#"><button class="btn btn-outline-primary w-100">Previsão Orçamentária</button></a>
                                <a href="#"><button class="btn btn-outline-primary w-100">Receitas x Despesas</button></a>
                            </div>
                        </div>
                    </div>
                </div>`;
            });
        })
        .catch(error => console.error('Erro ao carregar meses:', error));
</script>



<?php
    include 'templates/footer.php';
?>

