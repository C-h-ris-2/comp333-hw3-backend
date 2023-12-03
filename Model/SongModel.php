<?php
require_once PROJECT_ROOT_PATH . "/Model/Database.php";
class SongModel extends Database
{
    //grabbing all of the info from ratings
    public function getRatings(){
        return $this->select("SELECT * FROM ratings");
    }
//based on the user input and who is logged in, new rating is input into the table
    public function insertRating($userData){
    
        $sql = "INSERT INTO ratings (username, artist, song, rating) VALUES (?,?,?,?)";
        $stmt = $this->connection->prepare($sql);
        $user = $userData['username'];
        $artist = $userData['artist'];
        $song = $userData['song'];
        $rating = $userData['rating'];
        $stmt->bind_param('sssi', $user, $artist, $song, $rating);
        return($stmt->execute());
        
    }
//grabs id and user input to make changes to a preexisting entry in the table
    public function updateSong($userData) {
        $sql = 'UPDATE ratings SET artist = ?, song = ?, rating = ? WHERE id = ?';
        $artist = $userData['artist'];
        $song = $userData['song'];
        $rating = $userData['rating'];
        $id = $userData['id'];
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("ssii", $artist, $song, $rating, $id);
        $stmt->execute();
        $result = $this->select("SELECT * FROM ratings WHERE id = ?", ["i", $id]);
        if(count($result) === 1) {
            return $result;
        } 
    }
//grabs id to delete rating in the table
    public function deleteSong($userData){
        $id = $userData["id"];
        $sql = "DELETE FROM ratings WHERE id=$id";
        $stmt = $this->connection->prepare($sql);
        return($stmt->execute());
    }

}




