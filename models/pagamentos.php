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


            public function getResumoMes($mes) {
                
                $sqlTotal = "SELECT SUM(valor) as total FROM pagamentos WHERE MONTH(dt_pagamento) = ?";
                $stmtTotal = $this->conn->prepare($sqlTotal);
                $stmtTotal->bind_param("i", $mes);
                $stmtTotal->execute();
                $resTotal = $stmtTotal->get_result()->fetch_assoc();
                $totalGeral = $resTotal['total'] ?? 0;

                $sqlSetores = "
                    SELECT s.id_setor, s.nome AS nome_setor, SUM(p.valor) AS total_setor
                    FROM pagamentos p
                    JOIN setores s ON s.id_setor = p.id_setor
                    WHERE MONTH(p.dt_pagamento) = ?
                    GROUP BY s.id_setor, s.nome
                ";


                $stmtSetores = $this->conn->prepare($sqlSetores);
                $stmtSetores->bind_param("i", $mes);
                $stmtSetores->execute();
                $resSetores = $stmtSetores->get_result();

                $setores = [];
                while ($setor = $resSetores ->fetch_assoc()) {
                    $sqlSubsetores = "
                        SELECT sub.id_subsetor, sub.nome AS nome_subsetor, SUM(p.valor) AS total_subsetor
                        FROM pagamentos p
                        JOIN subsetores sub ON sub.id_subsetor = p.id_subsetor
                        WHERE MONTH(p.dt_pagamento) = ? AND p.id_setor = ?
                        GROUP BY sub.id_subsetor, sub.nome
                    ";
                }

                $stmtSub = $this->conn->prepare($sqlSubsetores);
                $stmtSub->bind_param("ii", $mes, $setor['id_setor']);
                $stmtSub->execute();
                $resSub = $stmtSub->get_result();

                $subsetores = [];
                while ($sub = $resSub->fetch_assoc()) {
                    $subsetores[] = $sub;
                }

                $setores[] = [
                    'id_setor' => $setor['id_setor'],
                    'nome_setor' => $setor['nome_setor'],
                    'total_setor' => $setor['total_setor'],
                    'subsetores' => $subsetores
                ];

                return [
                    'total_geral' => $totalGeral,
                    'setores' => $setores
                ];




            }






    }



?>