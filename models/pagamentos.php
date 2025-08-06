<?php

    require_once '../controller/conexao.php';

    class Pagamento {
        private $conn;
        
        public function __construct($conn) {
            $this->conn = $conn;
        }
    
        public function inserir($id_setor, $id_subsetor, $fornecedor, $valor, $dt_pagamento, $caminho) {
            $stmt = $this->conn->prepare("INSERT INTO pagamentos (id_setor, id_subsetor, fornecedor, valor, dt_pagamento, comprovante) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("iissds", $id_setor, $id_subsetor, $fornecedor, $valor, $dt_pagamento, $caminho);
            $result = $stmt->execute();
            $stmt->close();

            return $result;
        }
    }



?>