<?php
require __DIR__ . '/../models/Connection.php';
require __DIR__ . '/../models/FieldsModel.php';
$fieldObj = new Fields();

$conn = Connection::newConnection();

$filterInfo = isset($_GET['filter_info']) && $_GET['filter_info'] != '' ? $_GET['filter_info'] : null;

$fieldsList = $fieldObj->getAllFields($conn, $filterInfo);

try {
    $rows = "";
    foreach ($fieldsList as $field) {
        $fieldType = $fieldObj->getFieldTypeName($conn, $field['field_id']);
        $field['FieldType_id'] = $fieldType['FieldType_name'];
        $rows .= "
                <tr id='row-{$field['field_id']}'>
                    <td>{$field['field_id']}</td>
                    <td>{$field['FieldType_id']}</td>
                    <td><a href='app/views/add-edit-field.php?id={$field['field_id']}'>Editar</a></td>
                    <td><a onclick='deleteField({$field['field_id']})'>Eliminar</a></td>
                </tr>";
    }
    echo $rows;
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
