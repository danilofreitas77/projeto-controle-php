<?php

    // Inclui a conexão ao banco de dados e o model de usuarios onde estão as funções relacionadas aos usuários
    include '../controller/conexao.php';
    include '../models/usuarios.php';


// Recebe os dados via POST
    $email = $_POST['email'];
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];
    $confirma = $_POST['confirma_senha'];

    // Confirma também no Backend se a senha e a confirmação dela coincidem
    if ($senha !== $confirma) {
        die("As senhas não coincidem");
    }

    //Transforma a senha digitada em um hash
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    //Busca o usuário pelo email pra evitar duplicidade
    if(emailJaCadastrado($conn, $email)) {
        die("E-mail já cadastrado!");
    }

    // Insere o usuário no banco de dados
    if (inserirUsuario($conn, $nome, $email, $senhaHash)) {
        header("Location: ../views/login.php");
        exit;
    } else {
        die("Erro ao cadastrar.");
    }



?>

