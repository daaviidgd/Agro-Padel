<?php
// Iniciar sesión (si no se ha iniciado previamente)
session_start();

// Destruir todas las variables de sesión
session_unset();

// Destruir la sesión
session_destroy();

exit();
?>