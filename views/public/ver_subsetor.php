<?php include '../templates/header.php'; ?>

<main>
    <h3 id="tituloSubsetor" style="color: white;">Pagamentos</h3>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Fornecedor</th>
                <th>Descrição</th>
                <th>Data</th>
                <th>Valor</th>
                <th>PDF</th>
            </tr>
        </thead>
        <tbody id="tabelaPagamentos">
            <tr><td colspan="5">Carregando...</td></tr>
        </tbody>
    </table>

    <a href="index.php"><button class="btn btn-primary">< Voltar</button></a>
</main>

<!-- Modal PDF -->
<div class="modal fade" id="modalPDF" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-xl" style="max-width: 90vw;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Visualizar PDF</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body" style="height: 80vh; overflow: auto; text-align: center;">
        <canvas id="pdfCanvas" style="border: 1px solid #ccc; max-width: 100%;"></canvas>
      </div>
      <div class="modal-footer">
        <button id="prevPage" class="btn btn-secondary btn-sm">Anterior</button>
        <span>Página: <span id="pageNum"></span> / <span id="pageCount"></span></span>
        <button id="nextPage" class="btn btn-secondary btn-sm">Próxima</button>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/pdfjs-dist@3.7.107/build/pdf.min.js"></script>
<script>
  // Configura o worker do pdf.js
  pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdn.jsdelivr.net/npm/pdfjs-dist@3.7.107/build/pdf.worker.min.js';

  let pdfDoc = null,
    pageNum = 1,
    pageRendering = false,
    pageNumPending = null,
    scale = 1.2,
    canvas = document.getElementById('pdfCanvas'),
    ctx = canvas.getContext('2d');

  function renderPage(num) {
    pageRendering = true;
    pdfDoc.getPage(num).then(function(page) {
      const viewport = page.getViewport({ scale: scale });
      canvas.height = viewport.height;
      canvas.width = viewport.width;

      const renderContext = {
        canvasContext: ctx,
        viewport: viewport
      };
      const renderTask = page.render(renderContext);

      renderTask.promise.then(function () {
        pageRendering = false;
        if (pageNumPending !== null) {
          renderPage(pageNumPending);
          pageNumPending = null;
        }
      });
    });

    document.getElementById('pageNum').textContent = num;
  }

  function queueRenderPage(num) {
    if (pageRendering) {
      pageNumPending = num;
    } else {
      renderPage(num);
    }
  }

  function onPrevPage() {
    if (pageNum <= 1) return;
    pageNum--;
    queueRenderPage(pageNum);
  }

  function onNextPage() {
    if (pageNum >= pdfDoc.numPages) return;
    pageNum++;
    queueRenderPage(pageNum);
  }

  function abrirModalPDF(caminhoArquivo) {
    const urlArquivo = `/projeto-controle-php/${caminhoArquivo}`;
    pdfjsLib.getDocument(urlArquivo).promise.then(function(pdfDoc_) {
      pdfDoc = pdfDoc_;
      pageNum = 1;
      document.getElementById('pageCount').textContent = pdfDoc.numPages;
      renderPage(pageNum);

      const modal = new bootstrap.Modal(document.getElementById('modalPDF'));
      modal.show();
    }).catch(function(error) {
      alert('Erro ao carregar PDF: ' + error.message);
    });
  }

  document.getElementById('prevPage').addEventListener('click', onPrevPage);
  document.getElementById('nextPage').addEventListener('click', onNextPage);
</script>

<script>
const urlParams = new URLSearchParams(window.location.search);
const mes = urlParams.get('mes');
const subsetor = urlParams.get('subsetor');

fetch(`../../api/get_pagamentos_subsetor.php?mes=${mes}&subsetor=${subsetor}`)
  .then(res => res.json())
  .then(data => {
    const tbody = document.getElementById('tabelaPagamentos');
    tbody.innerHTML = '';

    if (!data.length) {
      tbody.innerHTML = `<tr><td colspan="5">Nenhum pagamento encontrado.</td></tr>`;
      return;
    }

    data.forEach(pag => {
      const tr = document.createElement('tr');
      tr.innerHTML = `
        <td>${pag.fornecedor}</td>
        <td>${pag.descricao}</td>
        <td>${new Date(pag.dt_pagamento).toLocaleDateString('pt-BR')}</td>
        <td>R$ ${parseFloat(pag.valor).toFixed(2).replace('.', ',')}</td>
        <td>
          ${pag.arquivo_pdf ? 
            `<button class="btn btn-sm btn-outline-primary" onclick="abrirModalPDF('${pag.arquivo_pdf}')">Ver PDF</button>` 
            : '—'}
        </td>
      `;
      tbody.appendChild(tr);
    });
  })
  .catch(err => console.error('Erro ao carregar pagamentos:', err));
</script>

<?php include '../templates/footer.php'; ?>
