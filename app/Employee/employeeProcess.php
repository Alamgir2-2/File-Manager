<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('../../../../PHP/File/brta/dbConn.php');

if (isset($_POST['insert_data'])) {
   $name = $_POST['name'];
   $designation = $_POST['designation'];
   $code = $_POST['code'];

  $check_query     = "SELECT * FROM `employeee` WHERE  code = '$code'";
  $check_query_run = mysqli_query($conn, $check_query);

  if (mysqli_num_rows($check_query_run) > 0) {
      echo $return = "duplicate"; 

  } else {
  $query     = "INSERT INTO `employeee`(name, designation, code) VALUES('$name','$designation', '$code')";
  $query_run = mysqli_query($conn, $query);

  if ($query_run) {
    echo $return = "success";
  } else {
    echo $return = "Error";
  }
  }

}

// Edit Data
if (isset($_POST['edit'])) {
  // echo ("Hello");
  $id          = $_POST['id'];
  $arrayResult = [];

  $fetch_query     = "SELECT * from `employeee` where id='$id'";
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

  $id          = $_POST['id'];
  $name        = $_POST['name'];
  $designation = $_POST['designation'];
  $code        = $_POST['code'];


  $update_query     = "UPDATE `employeee` set name = '$name', designation ='$designation' where id = '$id'";
  $update_query_run = mysqli_query($conn, $update_query);

  if ($update_query_run) {
    echo $return = "success";
  } else {
    echo $return = "Error" . mysqli_error($conn);
  }


}

// Delete Data From Table

if (isset($_POST['delete'])) {
  // echo $return = "Hello";
  $id = $_POST['id'];

  $delete_query     = "DELETE FROM `employeee` WHERE id = $id";
  $delete_query_run = mysqli_query($conn, $delete_query);

  if ($delete_query_run) {
    echo $return = "Delete Successfully !";
  } else {
    echo $return = "Error";
  }
}

?>