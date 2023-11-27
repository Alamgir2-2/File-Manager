<?php
session_start();

include('../../../../PHP/File/app/header.php');
include('../../PHP/File/brta/dbConn.php');


if (!isset($_SESSION['email']) || !isset($_SESSION['password'])) {
    // User is not logged in, redirect to the login page
    header("location: ../../../../../../PHP/File/app/Login/login.php");
    exit; // Ensure script termination after redirection
}

// Continue with the rest of your dashboard page code
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <title>Employee</title>
</head>

<body>
    <div class="container mt-5 d-flex justify-content-center">
        <div class="card w-100">
            <div class="card-body">
                <div class="d-flex justify-content-between container mt-4">
                    <div class="w-25">
                        <div class="input-group input-group-sm">
                            <input type="search" id="searchInput" class="form-control" placeholder=""
                                aria-label="Search" aria-describedby="search-addon" />
                            <button type="button" class="btn btn-outline-secondary btn-sm"><i
                                    class="fa fa-search"></i></button>
                        </div>
                    </div>

                    <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="modal"
                        data-bs-target="#exampleModal" data-bs-whatever="@mdo"><i class="fa fa-plus"></i> Employee</button>
                </div>

                <div class="m-2 text-center">
                    <div class="table-responsive rounded">
                        <table id="" class="table table-striped border border-3">

                            <thead>
                                <tr>
                                    <!-- <th scope="col" class="text-nowrap">Id</th> -->
                                    <th scope="col" class="text-nowrap">Name</th>
                                    <th scope="col" class="text-nowrap">Designation</th>
                                    <th scope="col" class="text-nowrap">Code</th>
                                    <th scope="col" class="text-nowrap">Action</th>
                                    <th scope="col" class="text-nowrap">Status</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody">
                                <!-- Table Data Apeare Here  -->
                            </tbody>
                        </table>
                    </div>


                    <!-- <ul class="pagination pagination-sm d-flex justify-content-end">
                        <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                    </ul> -->


                </div>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Employee</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <form id="myForm" method="POST">
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="empName" class="col-form-label">Name</label>
                                        <input type="text" name="emp_name" class="form-control" id="empName" required>
                                        <span id="nameError" class="text-danger"></span>
                                    </div>
                                    <div class="mb-3">
                                        <label for="empDesignation" class="col-form-label">Designation</label>
                                        <input type="text" name="designation" class="form-control" id="empDesignation"
                                            required>
                                            <span id="desigError" class="text-danger"></span>
                                    </div>
                                    <div class="mb-3">
                                        <label for="empID" class="col-form-label">Code</label>
                                        <input type="text" name="employee_id" class="form-control employee_id required" id="empID"
                                            required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger btn-sm"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="button" name="submit" id="submitBtn" class="btn btn-success btn-sm">Submit</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>


                <!-- Edit Modal -->
                <div class="modal fade" id="editData" tabindex="-1" aria-labelledby="editDataLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="editDataLabel">Edit Employee Details</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <form id="editForm" method="POST">
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <!-- <label for="id" class="col-form-label">Name</label> -->
                                        <input type="hidden" name="id" class="form-control" id="id" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="empName" class="col-form-label">Name</label>
                                        <input type="text" name="emp_name" class="form-control" id="emp_name" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="empDesignation" class="col-form-label">Designation</label>
                                        <input type="text" name="designation" class="form-control" id="emp_designation"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <!-- <label for="empID" class="col-form-label">Employee Id</label> -->
                                        <input type="hidden" name="code" class="form-control required"
                                            id="code" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger btn-sm"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="button" id="updateBtn" name="update" class="btn btn-success btn-sm">Update</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>







    <script src="../../../../PHP/File/public/JS/script.js"></script>
    <script src="../../../../PHP/File/public/JS/NewEmployee.js"></script>




</body>

</html>