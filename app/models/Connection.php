<?php
include __DIR__ . '/../config.php';
class Connection
{

    public function __construct()
    {
    }

    public static function newConnection() {
        try {
            $conn = new PDO("mysql:host=" . HOSTNAME . "; dbname=" . DATABASE, USERNAME, PASSWORD);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->exec('SET CHARACTER SET UTF8');
            return $conn;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
}
