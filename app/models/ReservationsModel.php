<?php
class Reservations
{
    public function __construct() {}

    public function getAllReservations($conn, $filterDate = null, $filterInfo = null)
    {
        $query = "SELECT * FROM reservation";
        $filterValue = "%{$filterInfo}%";

        if ($filterDate && $filterInfo) {
            $query .= " WHERE reservation_for_date = :filterDate";
            $query .= " AND customer_id IN 
            (SELECT customer_id FROM customers WHERE customer_name LIKE :filterInfo OR customer_tel LIKE :filterInfo)";
        } elseif ($filterDate && !$filterInfo) {
            $query .= " WHERE reservation_for_date = :filterDate";
        } elseif ($filterInfo && !$filterDate) {
            $query .= " WHERE customer_id IN 
            (SELECT customer_id FROM customers WHERE customer_name LIKE :filterInfo OR customer_tel LIKE :filterInfo)";
        }
        $stmt = $conn->prepare($query);
        if ($filterDate && $filterInfo) {
            $stmt->bindParam(':filterDate', $filterDate);
            $stmt->bindParam(':filterInfo', $filterValue);
        } elseif ($filterDate && !$filterInfo) {
            $stmt->bindParam(':filterDate', $filterDate);
        } elseif ($filterInfo && !$filterDate) {
            $stmt->bindParam(':filterInfo', $filterValue);
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getReservationById($conn, $id)
    {
        $stmt = $conn->prepare("SELECT * FROM reservation WHERE reservation_id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function filterReservationByDate($conn, $date)
    {
        $stmt = $conn->prepare("SELECT * FROM reservation WHERE reservation_for_date = :date");
        $stmt->bindParam(':date', $date);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function isReservationAvailable($conn, $forDate, $time, $field, $duration)
    {
        try {
            $stmt = $conn->prepare("SELECT field_id
                                    FROM field f
                                    WHERE f.field_id = :field
                                    AND NOT EXISTS (
                                        SELECT 1 
                                        FROM reservation r
                                        WHERE r.field_id = f.field_id
                                        AND r.reservation_for_date = :forDate
                                        AND (
                                            (r.reservation_time <= :time 
                                            AND ADDTIME(r.reservation_time, SEC_TO_TIME(r.reservation_duration * 3600)) > :time)
                                            OR
                                            (r.reservation_time < ADDTIME(:time, SEC_TO_TIME(:duration * 3600))
                                            AND ADDTIME(r.reservation_time, SEC_TO_TIME(r.reservation_duration * 3600)) > :time)
                                            OR
                                            (r.reservation_time = :time)
                                        )
                                    );
        ");
            $params = [
                ":forDate" => $forDate,
                ":time" => $time,
                ":field" => $field,
                ":duration" => $duration,
            ];
            $stmt->execute($params);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ? true : false;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function createReservation($conn, $customer, $date, $forDate, $time, $field, $duration, $paid)
    {
        $stmt = $conn->prepare("INSERT INTO 
                                reservation ( customer_id, reservation_date, reservation_for_date, 
                                reservation_time, field_id, reservation_duration, reservation_paid ) VALUES 
                                (:customer, :date, :forDate, :time, :field, :duration, :paid )");
        $params = [
            ":customer" => $customer,
            ":date" => $date,
            ":forDate" => $forDate,
            ":time" => $time,
            ":field" => $field,
            ":duration" => $duration,
            ":paid" => $paid
        ];
        return $stmt->execute($params);
    }

    public function updateReservation($conn, $id, $customer, $forDate, $time, $field, $duration, $paid)
    {
        try {
            $stmt = $conn->prepare("UPDATE reservation SET customer_id = :customer, reservation_for_date = :forDate, reservation_time = :time, field_id = :field, reservation_duration = :duration, reservation_paid = :paid WHERE reservation_id = :id");
            $params = [
                ":id" => $id,
                ":customer" => $customer,
                ":forDate" => $forDate,
                ":time" => $time,
                ":field" => $field,
                ":duration" => $duration,
                ":paid" => $paid
            ];
            $stmt->execute($params);
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function deleteReservation($conn, $id)
    {
        $stmt = $conn->prepare("DELETE FROM reservation WHERE reservation_id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function getAvailableSlots($conn, $date)
    {
        $availableHours = [
            '16:00',
            '17:00',
            '18:00',
            '19:00',
            '20:00',
            '21:00',
            '22:00',
            '23:00'
        ];

        $availableSlots = [];

        // Obtener todos los campos
        $queryFields = "SELECT field_id FROM field";
        $stmtFields = $conn->query($queryFields);
        $fields = $stmtFields->fetchAll(PDO::FETCH_COLUMN);

        // Obtener todas las reservas para la fecha dada
        $queryReservations = "
        SELECT field_id, reservation_time, reservation_duration 
        FROM reservation 
        WHERE reservation_for_date = :date
    ";
        $stmt = $conn->prepare($queryReservations);
        $stmt->bindParam(':date', $date);
        $stmt->execute();
        $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($fields as $field) {
            $fieldAvailableHours = $availableHours;

            // Filtrar las reservas para el campo actual
            $fieldReservations = array_filter($reservations, function ($reservation) use ($field) {
                return $reservation['field_id'] == $field;
            });

            foreach ($fieldReservations as $reservation) {
                $reservedTime = $reservation['reservation_time'];
                $duration = $reservation['reservation_duration'];
                $endTime = strtotime("+{$duration} hours", strtotime($reservedTime));

                foreach ($fieldAvailableHours as $key => $hour) {
                    $startHour = strtotime($hour);
                    // Comprobar si la hora está dentro del rango reservado
                    if ($startHour >= strtotime($reservedTime) && $startHour < $endTime) {
                        unset($fieldAvailableHours[$key]);
                    }
                }
            }

            // Guardar las horas disponibles para el campo actual
            $availableSlots[$field] = array_values($fieldAvailableHours);
        }

        return $availableSlots;
    }
}
