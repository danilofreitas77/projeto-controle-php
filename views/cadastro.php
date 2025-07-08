<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Cadastro</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="../assets/css/login.css" />
</head>
<body>
  <div class="container-fluid">
    <div class="row">
      <!-- Lado esquerdo -->
      <div class="col-md-6 lado-esquerdo">
        <h2>Já tem uma conta?</h2>
        <p>Acesse com seu e-mail e senha.</p>
        <a href="login.php" class="btn btn-light">Faça o login!</a>
      </div>

      <!-- Lado direito -->
      <div class="col-md-6 lado-direito">
        <div class="form-container">
          <h2 class="mb-4">Cadastro</h2>
          <form action="../api/cadastrar_usuario.php" method="POST">
            <div class="mb-3">
              <label class="form-label">Nome</label>
              <input type="text" class="form-control" name="nome" required />
            </div>
            <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="email" class="form-control" name="email" required />
            </div>
            <div class="mb-3">
              <label class="form-label">Senha</label>
              <input type="password" class="form-control" name="senha" required />
            </div>
            <div class="mb-3">
              <label class="form-label">Confirmar senha</label>
              <input type="password" class="form-control" name="confirma_senha" required />
            </div>
            <button type="submit" class="btn btn-success w-100">Cadastrar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>

<script>
    const form = document.querySelector('form');
    form.addEventListener('submit', function (e) {
    const senha = form.senha.value;
    const confirma = form.confirma_senha.value;

    if (senha !== confirma) {
      e.preventDefault(); // Impede o envio do form
      alert('As senhas não coincidem!');
    }
  });
</script>


</html>
