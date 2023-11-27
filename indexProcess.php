<?php
session_start();
include('./brta/dbConn.php');


if (isset($_POST['insert_data'])) {
  $employee_id      = $_POST['employee_id'];
  $file_name        = $_POST['file_name'];
  $transaction_type = $_POST['transaction_type'];
  $transaction_id   = $_POST['transaction_id'];
  $date             = $_POST['date'];


  $check_query     = "SELECT * FROM `transaction` WHERE file_name = '$file_name'";
  $check_query_run = mysqli_query($conn, $check_query);

  if (mysqli_num_rows($check_query_run) > 0) {
    echo $return = 'received';

  } else {
    $query     = "INSERT INTO `transaction`( employee_id, file_name, transaction_type) VALUES('$employee_id', '$file_name', 'Receive')";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
      echo $return = "inserted";
    } else {
      echo $return = "Error" . mysqli_error($conn);
    }
  }

}


// Insert Data without Validation

// if (isset($_POST['insert_data'])) {
//   $employee_id      = $_POST['employee_id'];
//   $file_name        = $_POST['file_name'];
//   $transaction_type = $_POST['transaction_type'];

//     $query     = "INSERT INTO `transaction`( employee_id, file_name, transaction_type) VALUES('$employee_id', '$file_name', '$transaction_type')";
//     $query_run = mysqli_query($conn, $query);

//     if ($query_run) {
//       echo $return = "success";
//     } else {
//       echo $return = "Error" . mysqli_error($conn);
//     }



// }



// Edit Data 
if (isset($_POST['edit'])) {
  // echo ("Hello");
  $transaction_id = $_POST['transaction_id'];
  $arrayResult    = [];

  $fetch_query     = "SELECT * from `transaction` where transaction_id='$transaction_id'";
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

  $employee_id      = $_POST['employee_id'];
  $transaction_type = $_POST['transaction_type'];
  $transaction_id   = $_POST['transaction_id'];

  if ($transaction_type === 'Receive') {

    $check_query     = "SELECT * FROM `transaction` WHERE  transaction_type = 'Receive' AND transaction_id = '$transaction_id'";
    $check_query_run = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_query_run) > 0) {
      echo $return = 'received';

    } else {
      $update_query     = "UPDATE `transaction` set employee_id = '$employee_id', transaction_type ='$transaction_type' where transaction_id = '$transaction_id'";
      $update_query_run = mysqli_query($conn, $update_query);

      if ($update_query_run) {
        echo $return = "success";
      } else {
        echo $return = "Error" . mysqli_error($conn);
      }
    }
  } else if ($transaction_type === 'Return') {
    $check_query     = "SELECT * FROM `transaction` WHERE  transaction_type = 'Return' AND transaction_id = '$transaction_id'";
    $check_query_run = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_query_run) > 0) {
      echo $return = 'returned';

    } else {
      $update_query     = "UPDATE `transaction` set employee_id = '$employee_id', transaction_type ='$transaction_type' where transaction_id = '$transaction_id'";
      $update_query_run = mysqli_query($conn, $update_query);

      if ($update_query_run) {
        echo $return = "success";
      } else {
        echo $return = "Error" . mysqli_error($conn);
      }
    }
  }

}



// Delete Data From Table

if (isset($_POST['delete'])) {
  // echo $return = "Hello"; 
  $transaction_id = $_POST['transaction_id'];

  $delete_query     = "DELETE FROM `transaction` WHERE transaction_id = $transaction_id";
  $delete_query_run = mysqli_query($conn, $delete_query);

  if ($delete_query_run) {
    echo $return = "Delete Successfully !";
  } else {
    echo $return = "Error";
  }
}

// Select2 


?>