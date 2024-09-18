<?php
require_once __DIR__ . '/../models/Connection.php';
require_once __DIR__ . '/../models/CustomersModel.php';

$customerObj = new Customer();
$customerList = $customerObj->getAllCustomers(Connection::newConnection());

$customersSuggestions = [];
foreach ($customerList as $i => $customer) {
    $customersSuggestions[$i]['customer_id'] = $customer['customer_id'];
    $customersSuggestions[$i]['customer_name'] = $customerObj->getCustomerFormatted(Connection::newConnection(), $customer['customer_id']);
}

?>


?>