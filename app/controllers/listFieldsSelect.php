<?php

$fieldObj = new Fields();
$fieldsList = $fieldObj->getAllFields(Connection::newConnection());
foreach ($fieldsList as $i => $field) {
    $fieldType = $fieldObj->getFieldTypeName(Connection::newConnection(), $field['field_id']);
    $fieldsList[$i]['FieldType_id'] = $field['field_id'] . ' - ' . $fieldType['FieldType_name'];
}
