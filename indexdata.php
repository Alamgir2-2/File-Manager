<?php
include('../../PHP/File/brta/dbConn.php');

$query = "SELECT * FROM `transaction`";

$result = mysqli_query($conn, $query);

$data = array();

// Fetch each row and format the date
while ($row = mysqli_fetch_assoc($result)) {
    $formattedDate = date('d M Y, H:i', strtotime($row['date']));

    $row['date'] = $formattedDate;

    $data[] = $row;
}

mysqli_close($conn);

header('Content-Type: application/json');
echo json_encode($data);




?>