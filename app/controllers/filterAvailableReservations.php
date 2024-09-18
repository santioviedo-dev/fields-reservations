<?php
require __DIR__ . '/../models/Connection.php';
require __DIR__ . '/../models/ReservationsModel.php';
require __DIR__ . '/../models/FieldsModel.php';
$reservations = new Reservations();
$fieldObj = new Fields();

$conn = Connection::newConnection();

$date = isset($_GET['filter_date']) && $_GET['filter_date'] != '' ? $_GET['filter_date'] : null;

$availableSlots = $reservations->getAvailableSlots($conn, $date);

try {
    $rows = "";
    foreach ($availableSlots as $key => $field) {
        $fieldType = $fieldObj->getFieldTypeName($conn, $key);
        $fieldTypeName = $key . " - " . $fieldType['FieldType_name'];

        $rows .= "
                <tr>
                    <td>$fieldTypeName</td>
                    <td>    
                ";
        foreach ($field as $keyField => $slot) {
            $rows .= $keyField + 1 != count($field) ? "$slot, " : "$slot";
        }
        $rows .= "</td></tr>";
    }
    echo $rows;
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
