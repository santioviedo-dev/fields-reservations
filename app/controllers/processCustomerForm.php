<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once __DIR__ . '/../models/Connection.php';
    require_once __DIR__ . '/../models/CustomersModel.php';

    $id = $_POST['id'];
    $name = $_POST['customer_name'];
    $tel = $_POST['customer_tel'];

    if (!$id == '') {
        $customerObj = new Customer();
        $success = $customerObj->updateCustomer(Connection::newConnection(), $id, $name, $tel);
        if (!$success) {
            echo "Error: No se pudo actualizar la reserva.";
        } else {
            echo "success";
        }
    } else if (empty($name) || empty($tel)) {
        echo "Error: Debe completar todos los campos. <br/>";
    } else {
        $customerObj = new Customer();
        $success = $customerObj->createCustomer(Connection::newConnection(), $name, $tel);
        if (!$success) {
            echo "Error: No se pudo crear la reserva.";
        } else {
            echo "success";
        }
    }
} else {
    echo "Error: El formulario debe ser enviado por POST.";
}
