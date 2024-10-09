<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require __DIR__ . '/../models/Connection.php';
    require __DIR__ . '/../models/FieldsModel.php';
    $id = $_POST['id'];

    $fieldObj= new Fields();
    $deletionSuccess = $fieldObj->deleteField(Connection::newConnection(), $id);

    if ($deletionSuccess) {
        echo 'success';
    } else {
        echo 'error';
    }
}