<?php
require '../controller/conexao.php';
require '../models/pagamentos.php';

$conn = Database::conectar();
$pagamentos = new Pagamento($conn);

$meses = $pagamentos->getMesesComPagamentos();

header('Content-Type: application/json');
echo json_encode($meses);
