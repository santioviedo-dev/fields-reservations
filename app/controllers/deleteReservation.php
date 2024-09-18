<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require __DIR__ . '/../models/Connection.php';
    require __DIR__ . '/../models/ReservationsModel.php';
    $id = $_POST['id'];

    $reservation = new Reservations();
    $deletionSuccess = $reservation->deleteReservation(Connection::newConnection(), $id);

    if ($deletionSuccess) {
        echo 'success';
    } else {
        echo 'error';
    }
}
