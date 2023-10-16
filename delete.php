<?php
include 'connection.php';
$sql = "DELETE FROM ratings WHERE id='" . $_GET["id"] . "'";
if (mysqli_query($db, $sql)) {
    echo "Record deleted successfully";
    header("Location: musicratings.php");
} else {
    echo "Error deleting record: " . mysqli_error($db);
}
mysqli_close($db);
?>