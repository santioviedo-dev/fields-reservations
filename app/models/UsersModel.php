<?php
class User
{
    public function __construct() {}

    public function validateUser($conn, $username, $password)
    {
        $stmt = $conn->prepare("SELECT user_id FROM users WHERE user_name = :username AND user_pass = :password LIMIT 1");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        $userId = $stmt->fetchColumn();

        return $userId ? $userId : false;
    }
}
