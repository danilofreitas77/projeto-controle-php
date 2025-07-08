<?php

    include '../controller/conexao.php';

    // Função para cadastrar usuários
    function inserirUsuario($conn, $nome, $email, $senhaHash) {
        $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, senha, tipo) VALUES (?, ?, ?, ?)");
        $tipo = 'usuario';
        $stmt->bind_param("ssss", $nome, $email, $senhaHash, $tipo);
        return $stmt->execute();
    }

    //Função para testar se o email já está cadastrado
    function emailJaCadastrado($conn, $email) {
        $stmt = $conn->prepare("SELECT id_usuario FROM usuarios WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        return $stmt->num_rows > 0;
    }

    // Função para levar os dados do usuario para a session na hora do login
    function obterUsuarioPorEmail($conn, $email) {
        $stmt = $conn->prepare("SELECT id, nome, senha, tipo FROM usuario WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

?>