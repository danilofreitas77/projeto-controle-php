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

                // Total geral do mês
                $sqlTotal = "SELECT SUM(valor) as total FROM pagamentos WHERE MONTH(dt_pagamento) = ?";
                $stmtTotal = $this->conn->prepare($sqlTotal);
                $stmtTotal->bind_param("i", $mes);
                $stmtTotal->execute();
                $resTotal = $stmtTotal->get_result()->fetch_assoc();
                $totalGeral = $resTotal['total'] ?? 0;

                // Lista fixa de setores
                $setoresFixos = [
                    1 => 'Pessoal',
                    2 => 'Impostos Associação',
                    3 => 'Mão de Obra Terceirizada',
                    4 => 'Manutenção/Conservação',
                    5 => 'Materiais de Consumo',
                    6 => 'Despesas Administrativas',
                    7 => 'Concessionárias',
                    8 => 'Despesas Bancárias',
                    9 => 'Eventos',
                    10 => 'Outras Despesas'
                ];

                $setores = [];

                foreach ($setoresFixos as $idSetor => $nomeSetor) {

                    // Total do setor
                    $sqlTotalSetor = "
                        SELECT SUM(valor) AS total_setor
                        FROM pagamentos
                        WHERE MONTH(dt_pagamento) = ? AND id_setor = ?
                    ";
                    $stmtTotalSetor = $this->conn->prepare($sqlTotalSetor);
                    $stmtTotalSetor->bind_param("ii", $mes, $idSetor);
                    $stmtTotalSetor->execute();
                    $resTotalSetor = $stmtTotalSetor->get_result()->fetch_assoc();
                    $totalSetor = $resTotalSetor['total_setor'] ?? 0;

                    // Busca subsetores desse setor
                    $sqlSubsetores = "
                        SELECT sub.id_subsetor, sub.nome AS nome_subsetor, SUM(p.valor) AS total_subsetor
                        FROM pagamentos p
                        JOIN subsetores sub ON sub.id_subsetor = p.id_subsetor
                        WHERE MONTH(p.dt_pagamento) = ? AND p.id_setor = ?
                        GROUP BY sub.id_subsetor, sub.nome
                    ";
                    $stmtSub = $this->conn->prepare($sqlSubsetores);
                    $stmtSub->bind_param("ii", $mes, $idSetor);
                    $stmtSub->execute();
                    $resSub = $stmtSub->get_result();

                    $subsetores = [];
                    while ($sub = $resSub->fetch_assoc()) {
                        $subsetores[] = $sub;
                    }

                    // Adiciona no array final apenas se tiver dados
                    if ($totalSetor > 0) {
                        $setores[] = [
                            'id_setor' => $idSetor,
                            'nome_setor' => $nomeSetor,
                            'total_setor' => $totalSetor,
                            'subsetores' => $subsetores
                        ];
                    }
                }

                return [
                    'total_geral' => $totalGeral,
                    'setores' => $setores
                ];
            }



            public function getPagamentosPorSubsetor($mes, $idSubsetor) {
                $sql = "
                    SELECT id_pagamento, fornecedor, descricao, valor, dt_pagamento, arquivo_pdf
                    FROM pagamentos
                    WHERE MONTH(dt_pagamento) = ? 
                    AND id_subsetor = ?
                    ORDER BY dt_pagamento DESC
                ";

                $stmt = $this->conn->prepare($sql);
                $stmt->bind_param("ii", $mes, $idSubsetor);
                $stmt->execute();
                $result = $stmt->get_result();

                $pagamentos = [];
                while ($row = $result->fetch_assoc()) {
                    $pagamentos[] = $row;
                }

                return $pagamentos;
            }








    }



?>