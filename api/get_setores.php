<?php

    require_once __DIR__ . '/../controller/conexao.php';
    require_once __DIR__ . '/../models/setores.php';


    $conn = conectar();
    $setor = new Setor($conn);
    $dados = $setor->listarTodos();

    header('Content-Type: application/json');
    echo json_encode($dados);



?>