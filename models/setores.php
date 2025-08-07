<?php

    require_once __DIR__ . '/../controller/conexao.php';


    class Setor {
        private $conn;
        
        public function __construct($conn) {
            $this->conn = $conn;
    }

    public function listarTodos() {
        $stmt = $this->conn->prepare("SELECT id_setor, nome FROM setores ORDER BY nome");
        $stmt->execute();

        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }


}




?>