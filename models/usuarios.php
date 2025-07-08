<?php

    include '../controller/conexao.php';

    // Função para cadastrar usuários
    function inserirUsuario($conn, $nome, $email, $senhaHash) {
        $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, senha, tipo) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nome, $email, $senhaHash, 'usuario');
        return $stmt->execute();
    }


    function buscarUsuarioPorEmail($conn, $email) {
        $stmt = $conn->prepare("SELECT id FROM usuarios WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        return $stmt->num_rows > 0;
    }

?>