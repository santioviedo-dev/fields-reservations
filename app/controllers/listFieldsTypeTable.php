<?php
require __DIR__ . '/../models/Connection.php';
require __DIR__ . '/../models/FieldTypeModel.php';
$fieldTypeObj = new FieldType();

$conn = Connection::newConnection();

$fieldsTypeList = $fieldTypeObj->getAllFieldTypes($conn);

try {
    $rows = "";
    foreach ($fieldsTypeList as $fieldType) {
        $rows .= "
                <tr id='type-row-{$fieldType['FieldType_id']}'>
                    <td>{$fieldType['FieldType_id']}</td>
                    <td>{$fieldType['FieldType_name']}</td>
                    <td><a onclick='deleteFieldType({$fieldType['FieldType_id']})'>Eliminar</a></td>
                </tr>";
    }
    echo $rows;
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
