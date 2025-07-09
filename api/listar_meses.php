<?php

    require_once '../controller/conexao.php';
    require_once '../models/pagamentos.php';

    $meses = listarMesesComDespesas($conn);

    header('Content-Type: application/json');
    echo json_encode($meses);



?>