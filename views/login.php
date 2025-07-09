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
        <h2>Bem vindo (a) de volta!</h2>
        <h2>Ainda não tem uma conta?</h2>
        <p>Cadastre-se agora mesmo!</p>
        <a href="cadastro.php" class="btn btn-light">Cadastre-se</a>
      </div>

      <!-- Lado direito -->
      <div class="col-md-6 lado-direito">
        <div class="form-container">
          <h2 class="mb-4">Login</h2>
          <form action="../api/login_usuario.php" method="POST">
            <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="email" class="form-control" name="email" required />
            </div>
            <div class="mb-3">
              <label class="form-label">Senha</label>
              <input type="password" class="form-control" name="senha" required />
            </div>
            <button type="submit" class="btn btn-success w-100">Entrar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>


</html>
