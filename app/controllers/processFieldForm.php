<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once __DIR__ . '/../models/Connection.php';
    require_once __DIR__ . '/../models/fieldsModel.php';

    $id = $_POST['id'];
    $fieldType = $_POST['field_type'];

    if (!$id == '') {
        $fieldObj = new Fields();
        $success = $fieldObj->updateField(Connection::newConnection(), $id, $fieldType);
        if (!$success) {
            echo "Error: No se pudieron actualizar los datos de la cancha.";
        } else {
            echo "success";
        }
    } else if (empty($fieldType)) {
        echo "Error: Debe completar todos los campos. <br/>";
    } else {
        $fieldObj = new Fields();
        $success = $fieldObj->createField(Connection::newConnection(), $fieldType);
        if (!$success) {
            echo "Error: No se pudo crear la cancha.";
        } else {
            echo "success";
        }
    }
} else {
    echo "Error: El formulario debe ser enviado por POST.";
}