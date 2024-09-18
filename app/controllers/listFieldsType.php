<?php
require_once __DIR__ . '/../models/FieldTypeModel.php';
$fieldObj = new FieldType();
$fieldsTypeList = $fieldObj->getAllFieldTypes(Connection::newConnection());
