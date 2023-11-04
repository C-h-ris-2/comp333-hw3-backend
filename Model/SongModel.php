<?php
require_once PROJECT_ROOT_PATH . "/Model/Database.php";
class SongModel extends Database
{
    public function getRatings(){
        return $this->select("SELECT * FROM ratings");
    }

    public function insertRating($userData){

        $sql = "INSERT INTO ratings (username, artist, song, rating) VALUES (?,?,?,?)";
        $stmt = $this->connection->prepare($sql);
        $user = $userData['username'];
        $artist = $userData['artist'];
        $song = $userData['song'];
        $rating = $userData['rating'];
        $stmt->bind_param('sssi', $user, $artist, $song, $rating);
        $stmt->execute();
    }

    public function updateSong($userData) {
        $sql = 'UPDATE ratings SET artist = ?, song = ?, rating = ? WHERE id = ?';
        $artist = $userData['artist'];
        $song = $userData['song'];
        $rating = $userData['rating'];
        $id = $userData['id'];
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("ssii", $artist, $song, $rating, $id);
        $stmt->execute();
    }

    public function deleteSong($userData){
        $id = $userData["id"];
        $sql = "DELETE FROM ratings WHERE id=$id";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
    }

}




