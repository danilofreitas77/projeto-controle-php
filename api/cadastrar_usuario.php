<?php

    include '../controller/conexao.php';
    include '../models/usuarios.php';

    $email = $_POST['email'];
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];
    $confirma = $_POST['confirma_senha'];

    if ($senha !== $confirma) {
        die("As senhas não coincidem");
    }

    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    if(buscarUsuarioPorEmail($conn, $email)) {
        die("E-mail já cadastrado!");
    }

    if (inserirUsuario($conn, $nome, $email, $senhaHash)) {
        header("Location: ../views/login.php");
        exit;
    } else {
        die("Erro ao cadastrar.");
    }



?>