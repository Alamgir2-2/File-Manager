<?php 
$host = "localhost";
$username = "root";
$password = "";
$database = "file_manager";


$conn = mysqli_connect($host, $username, $password, $database);

if(!$conn){
die ("Connection Failed !!".mysqli_connect_errno());
}

// else{
//     echo "Connect Succesfully !";
// }


?>