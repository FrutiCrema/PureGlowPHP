<?php
// middleware.php

// Inicia la sesión
session_start();



// Verifica si el usuario está autenticado
function authenticate() {
    // Si el usuario no está autenticado, redirige a la página de inicio de sesión
    if (!isset($_SESSION["AUTH"])) {
        header("Location: /PureGlow/back/src/views/login.php");
        exit; // Detiene la ejecución del script después de la redirección
    }
    else{
        header("Location: /PureGlow/back/src/views/landingPage.php");

    }
}

// Llama a la función authenticate() para verificar la autenticación
authenticate();
?>
