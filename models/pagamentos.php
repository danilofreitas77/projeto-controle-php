<?php

    require_once '../controller/conexao.php';

    class Pagamento {
        private $conn;
        
        public function __construct($conn) {
            $this->conn = $conn;
        }
    
        public function listarTodos() {
            $stmt = $this->conn->prepare("SELECT id, nome FROM setores ORDER BY nome");
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