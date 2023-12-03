<?php
require_once PROJECT_ROOT_PATH . "/Model/Database.php";
class UserModel extends Database
{
    public function getUsers($userData)
    {   
        $user = $userData['username'];
        $pass = $userData['password'];
        $result = $this->select("SELECT * FROM users WHERE username = ?", ["s", $user]);
        if (count($result) === 1) {
            $hashed_password = $result[0]['password'];

            if (password_verify($pass, $hashed_password)) {
                return $result;
            }
        }

        return false;
    }
    public function insertUser($userData){
        $sql = "INSERT INTO users (username, password) VALUES (?,?)";

        $stmt = $this->connection->prepare($sql);
        $user = $userData['username'];
        $hashed_pass = password_hash($userData["password"], PASSWORD_DEFAULT);
        $stmt->bind_param("ss", $user, $hashed_pass);
        $stmt->execute();
        $result = $this->select("SELECT * FROM users WHERE username = ?", ["s", $user]);
        if(count($result) === 1) {
            return $result;
        } 
    }


}