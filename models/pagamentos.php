<?php

class Pagamento {
    public static function listarMesesComDespesas($conn) {
        $sql = "SELECT DISTINCT DATE_FORMAT(data, '%M %Y') AS mes FROM pagamentos WHERE data IS NOT NULL ORDER BY data DESC";
        $result = $conn->query($sql);
        $meses = [];

        while ($row = $result->fetch_assoc()) {
            if ($row['mes']) {
                $meses[] = $row['mes'];
            }
        }
        return $meses;
    }

    public static function listarSetoresPorMes($conn, $mes) {
        $stmt = $conn->prepare("SELECT setor, SUM(valor) as total FROM pagamentos WHERE mes = ? GROUP BY setor");
        $stmt->bind_param("s", $mes);
        $stmt->execute();
        $result = $stmt->get_result();

        $setores = [];
        while ($row = $result->fetch_assoc()) {
            $setores[] = $row;
        }
        return $setores;
    }
}





?>