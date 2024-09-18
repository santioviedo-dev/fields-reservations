<?php
require __DIR__ . '/../models/Connection.php';
require __DIR__ . '/../models/ReservationsModel.php';
require __DIR__ . '/../models/FieldsModel.php';
require __DIR__ . '/../models/CustomersModel.php';
$reservations = new Reservations();
$field = new Fields();
$customerObj = new Customer();

$conn = Connection::newConnection();

$filterInfo = isset($_GET['filter_info']) && $_GET['filter_info'] != '' ? $_GET['filter_info'] : null;

$customersList = $customerObj->getAllCustomers($conn, $filterInfo);

try {
    $rows = "";
    foreach ($customersList as $customer) {
        $rows .= "
                <tr id='row-{$customer['customer_id']}'>
                    <td>{$customer['customer_name']}</td>
                    <td>{$customer['customer_tel']}</td>
                    <td><a href='app/views/add-edit-customer.php?id={$customer['customer_id']}'>Editar</a></td>
                    <td><a onclick='deleteCustomer({$customer['customer_id']})'>Eliminar</a></td>
                </tr>";
    }
    echo $rows;
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}