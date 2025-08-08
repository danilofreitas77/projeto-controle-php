<?php

    require_once __DIR__ . '/../controller/conexao.php';

    class Subsetor {
        private $conn;
        
        public function __construct($conn) {
            $this->conn = $conn;
        }
    
        public function listarPorSetor($id_setor) {
            $sql = "SELECT * FROM subsetores WHERE id_setor = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $id_setor);
            $stmt->execute();
            $resultado = $stmt->get_result();

            $subsetores = [];

            while ($row = $resultado->fetch_assoc()) {
                $subsetores[] = $row;
            }

            return $subsetores;
        }
    }



?>