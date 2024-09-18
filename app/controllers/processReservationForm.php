<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once __DIR__ . '/../models/Connection.php';
    require_once __DIR__ . '/../models/ReservationsModel.php';

    $id = $_POST['id'];
    $customer = $_POST['customer_id'];
    $forDate = $_POST['reservation_date'];
    $duration = $_POST['reservation_duration'];
    $time = $_POST['reservation_time'];
    $field = isset($_POST['field_id']) ? $_POST['field_id'] : '';
    $paid = $_POST['reservation_paid'];

    if (!$id == '') {
        $reservationObj = new Reservations();
        $success = $reservationObj->updateReservation(Connection::newConnection(), $id, $customer, $forDate, $time, $field, $duration, $paid);
        if (!$success) {
            echo "Error: No se pudo actualizar la reserva.";
        } else {
            echo "success";
        }
    } else if (empty($customer) || empty($forDate) || empty($duration) || empty($field) || empty($time)) {
        echo "Error: Debe completar todos los campos. <br/>";
        // echo "$customer, $forDate, $duration, $time, $field, $paid";
    } else {


        if (DateTime::createFromFormat('Y-m-d', $forDate) === false) {
            echo "Error: La fecha ingresada no es válida.";
        } else {
            if (DateTime::createFromFormat('H:i', $time) === false || $time < "16:00" || ($time == "23:00" && $duration > 2)) {
                echo "Error: La hora ingresada no es válida. ";
            } else {
                $dateTime = DateTime::createFromFormat('H:i', $time);
                $time = $dateTime->format('H:i:s');
                $currentDate = new DateTime();

                if ($forDate < $currentDate->format('Y-m-d')) {
                    echo "Error: No se puede ingresar una fecha anterior a la de hoy." . $currentDate->format('Y-m-d');
                } else {
                    if ($duration < 1) {
                        echo "Error: La duración de la reserva debe ser al menos 1 hora.";
                    } else {
                        $reservationObj = new Reservations();
                        $isAvailable = $reservationObj->isReservationAvailable(Connection::newConnection(), $forDate, $time, $field, $duration);
                        if (!$isAvailable) {
                            echo "Error: El turno seleccionado no se encuentra disponible.";
                        } else {
                            $reservationObj = new Reservations();
                            $success = $reservationObj->createReservation(Connection::newConnection(), $customer, $currentDate->format('Y-m-d'), $forDate, $time, $field, $duration, $paid);
                            if (!$success) {
                                echo "Error: No se pudo crear la reserva.";
                            } else {
                                echo "success";
                            }
                        }
                    }
                }
            }
        }
    }
} else {
    echo "Error: El formulario debe ser enviado por POST.";
}
