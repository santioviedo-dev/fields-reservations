<?php
class FieldType
{

    public function __construct() {}

    public function getAllFieldTypes($conn) {
        $stmt = $conn->prepare("SELECT * FROM fieldtype");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getFieldTypeById($conn, $id) {
        $stmt = $conn->prepare("SELECT * FROM fieldtype WHERE FieldType_id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createFieldType($conn, $name) {
        $stmt = $conn->prepare("INSERT INTO fieldtype (FieldType_name) VALUES (:name)");
        $stmt->bindParam(':name', $name);
        return $stmt->execute();
    }

    public function updateFieldType($conn, $id, $name) {
        $stmt = $conn->prepare("UPDATE fieldtype SET FieldType_name = :name WHERE FieldType_id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        return $stmt->execute();
    }

    public function deleteFieldType($conn, $id) {
        $stmt = $conn->prepare("DELETE FROM fieldtype WHERE FieldType_id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
