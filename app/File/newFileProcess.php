<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('../../brta/dbConn.php');

if (isset($_POST['insert_data'])) {
  $file_name = $_POST['file_name'];
  $file_id = $_POST['file_id'];

  $check_query     = "SELECT * FROM `filee` WHERE file_name = '$file_name' OR file_id = '$file_id'";
  $check_query_run = mysqli_query($conn, $check_query);

  if (mysqli_num_rows($check_query_run) > 0) {
    echo $return = 'duplicate';
 
  } else {
    $query     = "INSERT INTO `filee`(file_name, file_id) VALUES('$file_name','$file_id')";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
     echo $return = 'success';
    } else {
      $return = "Error";
    }

  }

}

// Edit Data 
if (isset($_POST['edit'])) {
  // echo ("Hello");
  $id          = $_POST['id'];
  $arrayResult = [];

  $fetch_query     = "SELECT * from `filee` where id='$id'";
  $fetch_query_run = mysqli_query($conn, $fetch_query);

  if (mysqli_num_rows($fetch_query_run) > 0) {
    foreach ($fetch_query_run as $row) {

      array_push($arrayResult, $row);

    }
    header('Content-type: application/json');
    echo json_encode($arrayResult);
  } else {
    echo $return = "No Data Found";
  }

}

// Update Data 
if (isset($_POST['update_data'])) {
  //  echo $return = "helloe";

  $id        = $_POST['id'];
  ;
  $file_name = $_POST['file_name'];
  $file_id   = $_POST['file_id'];


  $update_query     = "UPDATE `filee` set file_name = '$file_name' where id = '$id'";
  $update_query_run = mysqli_query($conn, $update_query);

  if ($update_query_run) {
    echo $return = "success" . mysqli_error($conn);
  } else {
    echo $return = "Error" . mysqli_error($conn);
  }


}

// Delete Data From Table

if (isset($_POST['delete'])) {
  // echo $return = "Hello";
  $id = $_POST['id'];

  $delete_query     = "DELETE FROM `filee` WHERE id = $id";
  $delete_query_run = mysqli_query($conn, $delete_query);

  if ($delete_query_run) {
    echo $return = "Delete Successfully !";
  } else {
    echo $return = "Error";
  }
}



?>