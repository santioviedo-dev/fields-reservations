<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once __DIR__ . '/../models/Connection.php';
    require_once __DIR__ . '/../models/FieldTypeModel.php';

    $fieldType = $_POST['FieldType_name'];

    if (empty($fieldType)) {
        echo "Error: Debe completar todos los campos. <br/>";
    } else {
        $fieldObj = new FieldType();
        $success = $fieldObj->createFieldType(Connection::newConnection(), $fieldType);
        if (!$success) {
            echo "Error: No se pudo crear el tipo de cancha.";
        } else {
            echo "success";
        }
    }
} else {
    echo "Error: El formulario debe ser enviado por POST.";
}
