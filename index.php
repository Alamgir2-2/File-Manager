<?php
session_start();

include('../File-Manager/app/header.php');
include('../File-Manager/brta/dbConn.php');

if (!isset($_SESSION['email']) || !isset($_SESSION['password'])) {
    header("location: ../../File-Manager/app/Login/login.php");
    exit;
}

?>



<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

</head>

<body>
    <div class="container mt-5 d-flex justify-content-center">

        <div class="card w-100">
            <div class="card-body">
                <div class="container d-flex justify-content-between mt-4">
                    <div class="w-25">
                        <div class="input-group input-group-sm">
                            <input type="search" id="searchInput" class="form-control form-control-sm" placeholder=""
                                aria-label="Search" aria-describedby="search-addon" />
                            <button type="button" class="btn btn-outline-secondary btn-sm"><i
                                    class="fa fa-search"></i></button>
                        </div>
                    </div>

                    <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="modal"
                        data-bs-target="#exampleModal" data-bs-whatever="@mdo"><i class="fa fa-plus"></i>
                        New Transaction</button>
                </div>



                <div class="container my-2 text-center">
                    <div class="table-responsive rounded">
                        <table class="table table-striped border border-3">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-nowrap">Transaction Id</th>
                                    <th scope="col" class="text-nowrap">File Name</th>
                                    <th scope="col" class="text-nowrap">Employee</th>
                                    <th scope="col" class="text-nowrap">Transaction Type</th>
                                    <th scope="col" class="text-nowrap">Date</th>
                                    <th scope="col" class="text-nowrap">Action</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody">

                            </tbody>
                        </table>
                    </div>



                    <!-- <ul class="pagination pagination-sm justify-content-end">
                        <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                    </ul> -->


                </div>
                <!--New Transaction Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">New Transaction</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form method="POST" id="myForm">
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="col-form-label">Employee</label>
                                        <select class="form-select selectEmployee" name="id" id="code" style="width: 100%">
                                        <option value="" class="form-control">Select Employee</option>
                                            <?php
                                            $sql = "SELECT * FROM `employeee` ORDER BY id DESC";

                                            $result = $conn->query($sql);

                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo '<option>' . $row["name"] . " - " . $row["code"] . '</option>';
                                                }
                                            } else {
                                                echo '<option>No ID found</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="col-form-label">File Name</label><br>
                                        <select class="selectFile form-select" id="fileName" style="width: 100%">
                                            <option value="" class="form-control">Select File</option>
                                            <?php

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

                                        </select>
                                    </div>
                                    <!-- <div class="mb-3">
                                        <label class="form-label">Transaction Type</label>
                                        <select class="form-select" name="type" id="type">
                                            <option class="fw-bold">Select Type</option>
                                            <option>Receive</option>
                                            <option>Return</option>
                                        </select>
                                    </div> -->
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger btn-sm"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="button" name="submit" id="submitBtn"
                                        class="btn btn-success btn-sm">Submit</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>


                <!--Update Modal -->
                <div class="modal fade" id="updateDataModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Update Transaction</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form method="POST" id="editForm">
                                <div class="modal-body">
                                    <input type="hidden" id="transaction_id">
                                    <div class="mb-3">
                                        <label class="col-form-label">Employee</label>
                                        <select class="form-select select2Employee" name="id" id="employee" style="width: 100%gite">
                                        <!-- <select class="form-select" name="id" id="employee"> -->
                                        <option value="" class="form-control"  ></option>
                                            <?php
                                            $sql = "SELECT * FROM `employeee` ORDER BY id DESC";

                                            $result = $conn->query($sql);

                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo '<option>' . $row["name"] . " - " . $row["code"] . '</option>';
                                                }
                                            } else {
                                                echo '<option>No ID found</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Transaction Type</label>
                                        <select class="form-select" name="type" id="tr_type" style="width: 100%">
                                            <option>Receive</option>
                                            <option>Return</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger btn-sm"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="button" name="submit" id="updateBtn"
                                        class="btn btn-success btn-sm">Update</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>


    <script src="../File-Manager/public/JS/script.js"></script>
    <script src="./public/JS/homePage.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


</body>

</html>