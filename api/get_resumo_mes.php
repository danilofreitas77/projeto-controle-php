<?php

require '../controller/conexao.php';
require '../models/pagamentos.php';

$conn = Database::conectar();
$pagamento = new Pagamento($conn);

$mes = $_GET['mes'] ?? null;

if (!$mes) {
    http_response_code(400);
    echo json_encode(['error' => 'Mês não informado.']);
    exit;
}

echo json_encode($pagamento->getResumoMes((int)$mes));



?>