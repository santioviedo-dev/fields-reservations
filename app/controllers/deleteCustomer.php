<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require __DIR__ . '/../models/Connection.php';
    require __DIR__ . '/../models/CustomersModel.php';
    $id = $_POST['id'];

    $reservation = new Customer();
    $deletionSuccess = $reservation->deleteCustomer(Connection::newConnection(), $id);

    if ($deletionSuccess) {
        echo 'success';
    } else {
        echo 'error';
    }
}