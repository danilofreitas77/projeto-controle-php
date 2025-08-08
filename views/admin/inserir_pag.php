<?php require '../templates/header.php'; ?>

<style>
    main {
        display: flex;
        justify-content: center;
    }

    form {
        border-radius: 10px;
        width: 40%;
        height: 90%;
    }

    form input {
        width: 100%;
    }
</style>

<main>
    <form action="../../api/inserir_pagamento.php" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="fornecedor" class="form-label">Fornecedor</label>
            <input name="fornecedor" type="text" class="form-control" id="fornecedor" placeholder="Digite o nome do fornecedor">
        </div>

        <div class="mb-3">
            <label for="valor" class="form-label">Valor</label>
            <input name="valor" type="text" class="form-control" id="valor" placeholder="Digite o valor">
        </div>

        <div class="row">
            <div class="col">
                <label for="id_setor">Setor</label>
                <select name="id_setor" id="id_setor" class="form-select" required>
                    <option selected disabled>Selecione um setor</option>
                </select>
            </div>

            <div class="col">
                <label for="id_subsetor">Subsetor</label>
                <select name="id_subsetor" id="id_subsetor" class="form-select" required>
                    <option selected disabled>Selecione um subsetor</option>
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label for="dt_pagamento" class="form-label">Data</label>
            <input name="dt_pagamento" type="date" class="form-control" id="dt_pagamento" required>
        </div>

        <div class="input-group mb-3">
            <input name="arquivo_pdf" type="file" class="form-control" id="arquivo_pdf" accept="application/pdf" required>
            <label class="input-group-text" for="arquivo_pdf">Upload</label>
        </div>

        <input class="btn btn-primary" type="submit" value="Enviar Pagamento">
    </form>
</main>

<script>

  // Carrega os setores
  fetch('../../api/get_setores.php')
    .then(response => response.json())
    .then(data => {
      const selectSetor = document.getElementById('id_setor');
      selectSetor.innerHTML = '<option selected disabled>Selecione um setor</option>';
      data.forEach(setor => {
        const option = document.createElement('option');
        option.value = setor.id_setor;
        option.textContent = setor.nome;
        selectSetor.appendChild(option);
      });
    })
    .catch(error => console.error('Erro ao carregar setores:', error));

  // Carrega os subsetores ao mudar o setor
  document.getElementById('id_setor').addEventListener('change', function () {
    const setorId = this.value;
    const selectSubsetor = document.getElementById('id_subsetor');

    selectSubsetor.innerHTML = '<option selected disabled>Carregando subsetores...</option>';

    fetch(`../../api/get_subsetores.php?id_setor=${setorId}`)
      .then(response => response.json())
      .then(data => {
        selectSubsetor.innerHTML = '<option selected disabled>Selecione um subsetor</option>';
        data.forEach(subsetor => {
          const option = document.createElement('option');
          option.value = subsetor.id_subsetor;
          option.textContent = subsetor.nome;
          selectSubsetor.appendChild(option);
        });
      })
      .catch(err => {
        console.error('Erro ao carregar subsetores:', err);
        selectSubsetor.innerHTML = '<option selected disabled>Erro ao carregar subsetores</option>';
      });
  });

</script>

<?php require '../templates/footer.php'; ?>
