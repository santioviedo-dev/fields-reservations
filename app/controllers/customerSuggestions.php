<?php
    if (isset($_GET['query'])) {
        require_once __DIR__ . '/../models/Connection.php';
        require_once __DIR__. '/../models/CustomersModel.php';

        $query = $_GET['query'];

        

        // Realizar una búsqueda en la base de datos
        $customersObj = new Customer();
        $customersList = $customersObj->getCustomersBySuggestion(Connection::newConnection(), $query);
        
        $results = [];
        foreach ($customersList as $i => $customer) {
            $results[$i] = [
                'id' => $customer['customer_id'],
                'text' => $customersObj->getCustomerFormatted(Connection::newConnection(), $customer['customer_id'])
            ];
        }

        // Devolver resultados como JSON
        echo json_encode($results);
    }
?>