<?php
header('Content-Type: application/json');

// Inclui a conexão
include '../controller/conexao.php';

// Inclui o model
include '../models/pagamentos.php';

$conn = Database::conectar();

$mes = $_GET['mes'] ?? null;
$idSubsetor = $_GET['subsetor'] ?? null;

if (!$mes || !$idSubsetor) {
    http_response_code(400);
    echo json_encode(['error' => 'Parâmetros inválidos']);
    exit;
}

$pagamento = new Pagamento($conn);
$resultado = $pagamento->getPagamentosPorSubsetor($mes, $idSubsetor);

echo json_encode($resultado);
