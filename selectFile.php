<?php
session_start();
include('./brta/dbConn.php');

$sql = "SELECT * FROM `filee` ORDER BY id DESC";

$file = $conn->query($sql);

if ($file->num_rows > 0) {
    while ($row = $file->fetch_assoc()) {
        echo '<option>' . $row["file_name"] . '</option>';
    }
} else {
    echo '<option>No files found</option>';
}

?>