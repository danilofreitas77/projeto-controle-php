<?php

    function listarMesesComDespesas($conn) {
        $sql = "SELECT DISTINCT DATE_FORMAT(data, '%M %Y') AS mes
                FROM pagamentos
                WHERE data IS NOT NULL
                ORDER BY data DESC";

        $result = $conn->query($sql);
        $meses = [];

        while ($row = $result->fetch_assoc()) {
            if ($row['mes']) { // Garante que só entra mês válido
                $meses[] = $row['mes'];
            }
        }

        return $meses;
}





?>