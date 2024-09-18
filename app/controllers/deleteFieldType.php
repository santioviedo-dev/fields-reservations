<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require __DIR__ . '/../models/Connection.php';
    require __DIR__ . '/../models/FieldTypeModel.php';
    $id = $_POST['id'];

    $fieldTypeObj= new FieldType();
    $deletionSuccess = $fieldTypeObj->deleteFieldType(Connection::newConnection(), $id);

    if ($deletionSuccess) {
        echo 'success';
    } else {
        echo 'error';
    }
}