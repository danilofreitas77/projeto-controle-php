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

         public function inserir($id_setor, $id_subsetor, $fornecedor, $valor, $dt_pagamento, $caminho_pdf) {
                $sql = "INSERT INTO pagamentos (id_setor, id_subsetor, fornecedor, valor, dt_pagamento, arquivo_pdf) 
                        VALUES (?, ?, ?, ?, ?, ?)";

                $stmt = $this->conn->prepare($sql);
                if (!$stmt) {
                    die("Erro na preparação da query: " . $this->conn->error);
                }

                // bind dos parâmetros (s = string, i = int, d = double/float)
                $stmt->bind_param("iisdss", $id_setor, $id_subsetor, $fornecedor, $valor, $dt_pagamento, $caminho_pdf);


                $executou = $stmt->execute();
                $stmt->close();

                return $executou; // true se inseriu, false se não
            }

            public function getMesesComPagamentos() {
                $sql = "SELECT DISTINCT MONTH(dt_pagamento) AS mes FROM pagamentos ORDER BY mes ASC";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute();
                $result = $stmt->get_result();
                $meses = [];
                while ($row = $result->fetch_assoc()) {
                    $meses[] = (int)$row['mes'];
                }
                $stmt->close();
                return $meses;
        }
    }



?>