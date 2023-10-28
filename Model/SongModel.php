<?php
require_once PROJECT_ROOT_PATH . "/Model/Database.php";
class SongModel extends Database
{
    public function getRatings(){
        return $this->select("SELECT * FROM ratings");
    }

    public function insertRating(){
        $sql = "INSERT INTO ratings (username, artist, song, rating) VALUES ('yun', 'adele', 'hello', 2)";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
    }

    public function deleteRating(){
        $sql = "DELETE FROM ratings WHERE id=14";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
    }

}




