<?php
// Include your database connection
include('../../brta/dbConn.php');

// Fetch data from the "exam" table
$query = "SELECT * FROM `employeee`";
$result = mysqli_query($conn, $query);

// Prepare an array to store the dataa
$data = array();

// Fetch each row and add it to the array
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

// Close the database connection
mysqli_close($conn);

// Return the data as JSON
header('Content-Type: application/json');
echo json_encode($data);
?>