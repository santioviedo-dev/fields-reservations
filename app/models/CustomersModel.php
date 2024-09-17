<?php

class Customer
{
    public function __construct() {}

    public function getAllCustomers($conn, $filter = null)
    {
        $query = "SELECT * FROM customers";
        $filterValue = "%{$filter}%";

        if ($filter) {
            $query .= " WHERE customer_name LIKE :filter";
        }

        $stmt = $conn->prepare($query);
        if ($filter) {
            $stmt->bindParam(':filter', $filterValue);
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCustomerById($conn, $id)
    {
        $stmt = $conn->prepare("SELECT * FROM customers WHERE customer_id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getCustomerFormatted($conn, $id)
    {
        $stmt = $conn->prepare("SELECT * FROM customers WHERE customer_id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $arr = $stmt->fetch(PDO::FETCH_ASSOC);
        return "{$arr['customer_name']} ({$arr['customer_tel']})";
    }

    public function getCustomersBySuggestion($conn, $suggestion)
    {
        $stmt = $conn->prepare("SELECT * FROM customers WHERE 
                                customer_name LIKE :suggestion OR customer_tel LIKE :suggestion");
        $stmt->execute([":suggestion" => "%{$suggestion}%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCustomerByTel($conn, $tel)
    {
        $stmt = $conn->prepare("SELECT * FROM customers WHERE customer_tel = :tel");
        $stmt->bindParam(':tel', $tel);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getCustomerByName($conn, $name)
    {
        $stmt = $conn->prepare("SELECT * FROM customers WHERE customer_name = :\name");
        $stmt->bindParam(':name', $name);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createCustomer($conn, $name, $tel)
    {
        $stmt = $conn->prepare("INSERT INTO customers ( customer_name, customer_tel ) VALUES (:name, :tel)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':tel', $tel);
        return $stmt->execute();
    }

    public function updateCustomer($conn, $id, $name, $tel)
    {
        $stmt = $conn->prepare("UPDATE customers SET 
                                customer_name = :\name, 
                                customer_tel = :tel WHERE customer_id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':tel', $tel);
        return $stmt->execute();
    }

    public function deleteCustomer($conn, $id)
    {
        $stmt = $conn->prepare("DELETE FROM customers WHERE customer_id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
