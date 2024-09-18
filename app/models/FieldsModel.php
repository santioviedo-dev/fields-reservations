<?php
class Fields
{
    public function __construct() {}

    public function getAllFields($conn, $filter = null)
    {
        $query = "SELECT * FROM field";
        $filterValue = "%{$filter}%";

        if ($filter) {
            $query .= " WHERE FieldType_id IN (SELECT FieldType_id FROM fieldType WHERE FieldType_name LIKE :filter)";
        }

        $stmt = $conn->prepare($query);
        if ($filter) {
            $stmt->bindParam(':filter', $filterValue);
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getFieldById($conn, $id)
    {
        $stmt = $conn->prepare("SELECT * FROM fieldtype WHERE FieldType_id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getFieldTypeName($conn, $id)
    {
        $stmt = $conn->prepare("SELECT FieldType_name FROM fieldtype WHERE FieldType_id IN
                                (SELECT FieldType_id FROM field WHERE field_id = :id)");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createField($conn, $type)
    {
        $stmt = $conn->prepare("INSERT INTO field (FieldType_id) VALUES (:type)");
        $stmt->bindParam(':type', $type);
        return $stmt->execute();
    }

    public function updateField($conn, $id, $type)
    {
        $stmt = $conn->prepare("UPDATE field SET FieldType_id = :type WHERE field_id = :id");
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function deleteField($conn, $id)
    {
        $stmt = $conn->prepare("DELETE FROM field WHERE field_id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
