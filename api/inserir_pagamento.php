<?php

    require '../controller/conexao.php';
    require '../models/pagamentos.php';

    session_start();
    if(!isset($_SESSION['admin'])) {
        header('Location: ../views/admin/login.php');
        exit;
    }


    $id_setor = $_POST['id_setor'];
    $id_subsetor = $_POST['id_subsetor'];
    $fornecedor = $_POST['fornecedor'];
    $valor = $_POST['valor'];
    $dt_pagamento = $_POST['dt_pagamento'];

    // Processamento do PDF

    $arquivo_nome = $_FILES['arquivo_pdf']['name'];
    $arquivo_tmp = $_FILES['arquivo_pdf']['tmp_name'];
    $caminho = "../uploads/comprovantes/" . $arquivo_nome;
    move_uploaded_file($arquivo_tmp, $caminho);

    $conn = conectar();

    $pagamento = new Pagamento($conn);

    if($upload_ok) {
        $inserido = $pagamento->$pagamento->inserir($id_setor, $id_subsetor, $fornecedor, $valor, $dt_pagamento, $caminho);
    } else {
        $inserido = false;
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
    <script>
        <?php if($inserido): ?>
            alert('Pagamento inserido com sucesso!');
            window.location.href = '../views/admin/pagamentos.php';
        <?php else: ?>
            alert('Erro ao inserir pagamento.');
            window.location.href = '../views/admin/pagamentos.php';
        <?php endif; ?>
    </script>
</body>
</html>
