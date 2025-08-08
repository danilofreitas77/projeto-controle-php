<?php

require '../controller/conexao.php';
require '../models/pagamentos.php';

// session_start();
// if(!isset($_SESSION['admin'])) {
//     header('Location: ../views/admin/login.php');
//     exit;
// }
$conn = Database::conectar();
$pagamento = new Pagamento($conn);

$id_setor = $_POST['id_setor'];
$id_subsetor = $_POST['id_subsetor'];
$fornecedor = $_POST['fornecedor'];
$dt_pagamento = $_POST['dt_pagamento'];
$valor = str_replace(',', '.', $_POST['valor']);
$valor = floatval($valor);


$uploadDir = __DIR__ . '/../uploads/';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$nomeArquivo = basename($_FILES['arquivo_pdf']['name']);
$caminhoCompleto = $uploadDir . $nomeArquivo;
$caminhoRelativo = 'uploads/' . $nomeArquivo;

if (move_uploaded_file($_FILES['arquivo_pdf']['tmp_name'], $caminhoCompleto)) {
    $pagamento->inserir($id_setor, $id_subsetor, $fornecedor, $valor, $dt_pagamento, $caminhoRelativo);
    echo "Pagamento inserido com sucesso!";
} else {
    echo "Erro ao fazer upload do arquivo.";
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Inserção de Pagamento</title>
</head>
<body>
<script>
    <?php if($inserido): ?>
        alert('Pagamento inserido com sucesso!');
        window.location.href = '../views/admin/inserir_pag.php';
    <?php else: ?>
        alert('Erro ao inserir pagamento.');
        window.location.href = '../views/admin/inserir_pag.php';
    <?php endif; ?>
</script>
</body>
</html>
