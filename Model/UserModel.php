<?php
require_once PROJECT_ROOT_PATH . "/Model/Database.php";
class UserModel extends Database
{
    public function getUsers($limit)
    {
        return $this->select("SELECT * FROM users");
    }

    public function insertUser(){
        $sql = "INSERT INTO users (username, password) VALUES ('sean', 5678)";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
    }


}