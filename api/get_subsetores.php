<?php
//require_once __DIR__ . '/../controller/conexao.php';
require_once __DIR__ . '/../models/subsetores.php';

$conn = Database::conectar();
$subsetor = new Subsetor($conn);

$id_setor = isset($_GET['id_setor']) ? intval($_GET['id_setor']) : null;


if ($id_setor !== null) {
    $dados = $subsetor->listarPorSetor($id_setor);
    header('Content-Type: application/json');
    echo json_encode($dados);
} else {
    http_response_code(400);
    echo json_encode(['erro' => 'Id do setor não informado']);
}





?>
