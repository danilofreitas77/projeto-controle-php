<?php

    function listarMesesComDespesas($conn) {
        $sql = "SELECT DISTINCT DATE_FORMAT(data, '%M %Y') AS mes FROM pagamentos ORDER BY data DESC";

        $result = $conn->query($sql);

        $meses = [];
        while ($row = $result->fetch_assoc()) {
            $meses[] = $row['mes'];
        }

        return $meses;
    }





?>