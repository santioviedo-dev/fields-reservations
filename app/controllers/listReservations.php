<?php
require __DIR__ . '/../models/Connection.php';
require __DIR__ . '/../models/ReservationsModel.php';
require __DIR__ . '/../models/FieldsModel.php';
require __DIR__ . '/../models/CustomersModel.php';
$reservations = new Reservations();
$field = new Fields();
$customer = new Customer();

$conn = Connection::newConnection();

$filterDate = isset($_GET['filter_date']) && $_GET['filter_date'] != '' ? $_GET['filter_date'] : null;
$filterInfo = isset($_GET['filter_info']) && $_GET['filter_info'] != '' ? $_GET['filter_info'] : null;

$reservationsList = $reservations->getAllReservations($conn, $filterDate, $filterInfo);

try {
    $rows = "";
    foreach ($reservationsList as $reservation) {
        $fieldType = $field->getFieldTypeName($conn, $reservation['field_id']);
        $reservation['field_id'] .= " - " . $fieldType['FieldType_name'];
        $reservation['customer_id'] = $customer->getCustomerFormatted($conn, $reservation['customer_id']);

        $rows .= "
                <tr id='row-{$reservation['reservation_id']}'>
                    <td>{$reservation['reservation_for_date']}</td>
                    <td>{$reservation['customer_id']}</td>
                    <td>{$reservation['reservation_time']}</td>
                    <td>{$reservation['reservation_duration']} hora/s</td>
                    <td>{$reservation['field_id']}</td>
                    <td>" . ($reservation['reservation_paid'] ? "Si" : "No") . "</td>
                    <td><a href='app/views/add-edit-reservation.php?id={$reservation['reservation_id']}'>Editar</a></td>
                    <td><a onclick='deleteReservation({$reservation['reservation_id']})'>Cancelar</a></td>
                </tr>";
    }
    echo $rows;
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
