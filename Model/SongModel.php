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

    public function deleteRating($userData){
        $sql = "DELETE FROM ratings WHERE id=?";
        $id = $userData['id'];
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param('i', $id);
;       $stmt->execute();
    }

    public function updateSong($userData) {
        $sql = 'UPDATE ratings WHERE id = ? SET artist=?, song = ?, rating = ?';
        $id = $userData['id'];
        $artist = $userData['artist'];
        $song = $userData['song'];
        $rating = $userData['rating'];
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("issi", $id, $artist, $song, $rating);
        $stmt->execute();
    }

}




