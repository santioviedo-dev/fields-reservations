<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once __DIR__ . '/../models/Connection.php';
    require_once __DIR__ . '/../models/UsersModel.php';
    require_once __DIR__. '/../helpers/validations.php';

    $username = cleanString($_POST['username']);
    $password = cleanString($_POST['password']);

    if (empty($username) || empty($password)) {
        echo "Error: Debe completar todos los campos. <br/>";
    } else {
        $userObj = new User();
        $user = $userObj->validateUser(Connection::newConnection(), $username, $password);
        if (!$user) {
            echo "Los datos no son válidos.";
        } else {
            session_start();
            $_SESSION['userId'] = $user;

            echo "success";
        }
    }
} else {
    echo "Error: El formulario debe ser enviado por POST.";
}
