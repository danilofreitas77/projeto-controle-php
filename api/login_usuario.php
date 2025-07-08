<?php

    session_start();
    include '../controller/conexao.php';
    include '../models/usuarios.php';

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $usuario = obterUsuarioPorEmail($conn, $email);

    if($usuario && password_verify($senha, $usuario['senha'])) {
        $_SESSION['id_usuario'] = $usuario['id_usuario'];
        $_SESSION['nome'] = $usuario['nome'];
        $_SESSION['tipo'] = $usuario['tipo'];


        header("Location: ../views/dashboard.php");
        exit;


    } else {
        echo "Email ou Senha Inválidos";
    }






?>