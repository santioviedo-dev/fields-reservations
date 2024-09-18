<?php
include __DIR__ . '/../models/Connection.php';
include __DIR__ . '/../models/ReservationsModel.php';
include __DIR__ . '/../models/CustomersModel.php';
include __DIR__ . '/../models/FieldsModel.php';
function getReservation($id)
{
    $obj = new Reservations();
    $customer = new Customer();
    $field = new Fields();
    $reservation = $obj->getReservationById(Connection::newConnection(), $id);
    if ($id === '' || $reservation === false) {
        $reservation = [
            'customer_id' => '',
            'reservation_date' => '',
            'reservation_for_date' => '',
            'field_id' => '',
            'reservation_time' => '',
            'reservation_duration' => '',
            'reservation_paid' => ''
        ];
        return $reservation;
    }

    

    return $reservation;
}

function getCustomer($id)
{
    $customer = new Customer();
    $customer = $customer->getCustomerById(Connection::newConnection(), $id);
    if ($id === '' || $customer === false) {
        $customer = [
            'customer_id' => '',
            'customer_name' => '',
            'customer_tel' => ''
        ];
        return $customer;
    }
    return $customer;
}

function getField($id) {
    $field = new Fields();
    $field = $field->getFieldById(Connection::newConnection(), $id);
    if ($id === '' || $field === false) {
        $field = [
            'field_id' => '',
            'FieldType_id' => ''
        ];
        return $field;
    }
    return $field;
}
