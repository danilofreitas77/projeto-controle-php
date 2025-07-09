<?php

    session_start();

    if(!isset($_SESSION['id_usuario']) || $_SESSION['tipo'] !== 'admin') {
        header('Location: ../views/login.php');
        exit;
    }






?>