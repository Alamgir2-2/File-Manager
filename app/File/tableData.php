<?php

// Include your database connection
include('../../brta/dbConn.php');

// Get page and items per page parameters from the client
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$itemsPerPage = isset($_GET['itemsPerPage']) ? (int)$_GET['itemsPerPage'] : 10;

// Calculate the OFFSET value based on the page and items per page
$offset = ($page - 1) * $itemsPerPage;

// Query to retrieve data for the current page
$query = "SELECT * FROM filee LIMIT $itemsPerPage OFFSET $offset";
$result = mysqli_query($conn, $query);

// Prepare an array to store the data
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












// // Include your database connection
// include('../../brta/dbConn.php');

// // Fetch data from the "exam" table
// $query = "SELECT * FROM filee";
// $result = mysqli_query($conn, $query);

// // Prepare an array to store the dataa
// $data = array();

// // Fetch each row and add it to the array
// while ($row = mysqli_fetch_assoc($result)) {
//     $data[] = $row;
// }

// // Close the database connection
// mysqli_close($conn);

// // Return the data as JSON
// header('Content-Type: application/json');
// echo json_encode($data);
?>