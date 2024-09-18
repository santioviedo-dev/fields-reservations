<?php
session_start();
session_destroy(); // Destruye toda la sesión
header("Location: ../views/login.php");
exit;