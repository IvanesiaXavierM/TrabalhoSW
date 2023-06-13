<?php
    // Iniciar a sessão
    session_start();

    // Encerrar a sessão atual
    session_destroy();

    // Redirecionar para a página de login
    header("Location: ../login.html");
    exit();
?>
