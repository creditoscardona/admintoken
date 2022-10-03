<?php
/* Destruir la sesion */
session_start();
session_unset();
session_destroy();
/* Redirigir */
header('Location: /');

?>