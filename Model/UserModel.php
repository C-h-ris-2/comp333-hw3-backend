<?php
require_once PROJECT_ROOT_PATH . "/Model/Database.php";
class UserModel extends Database
{
    public function getUsers($user, $pass)
    {
        $result = $this->select("SELECT * FROM users WHERE username = ?", ["s", $user]);
        if (count($result) === 1) {
            $hashed_password = $result[0]['password'];

            if (password_verify($pass, $hashed_password)) {
                return $result;
            }
        }

        return false;
    }
    public function insertUser(){
        $hashed_password = password_hash(5678, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username, password) VALUES ('sean', '$hashed_password')";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
    }


}