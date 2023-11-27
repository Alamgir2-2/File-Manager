<?php
session_start();
include('../../brta/dbConn.php');

$error_message = "";

if (isset($_POST['login'])) {
    $email    = $_POST["email"];
    $password = $_POST["password"];

    $sql    = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    if ($result->num_rows > 0) {

        $_SESSION['logged_in'] = true;
        $_SESSION['email']    = $email;
        $_SESSION['password'] = $password;

        header("location: /File-Manager/index.php");
    } else {
        $error_message = "Invalid email or password.";
    }
}

$conn->close();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>

    <!-- <link rel="stylesheet" href="../../../../PHP/File/public/CSS/style.css"> -->
    <link rel="stylesheet" href="../../public/CSS/style.css">

</head>

<body>
    <main>
        <section class="background-container overflow-hidden">
            <div class="container  pt-5  text-center text-lg-start my-5">

                <div class=" container card card-rounded rounded-5 align-self-center p-5 my-5 bg-glass w-75">
                    <div class="d-flex justify-content-around p-4">
                        <div class="align-self-center">
                            <img src="../../public/asset/image/user.png" alt="">
                        </div>
                        <div class="align-self-center">
                            <?php
                            if (isset($error_message)) {
                                echo '<h6 class="text-danger text-center">' . $error_message . '</h6>';
                                // header("location: login.php");
                            }
                            ?>

                            <div class="m-4 user-login">
                                <h1>User Login</h1>
                            </div>
                            <form id="loginForm" method="POST" action="">
                                <div class="form-outline mb-4">
                                    <input type="email" name="email" id="email" class="form-control"
                                        placeholder="Email" />
                                    <span class="invalid-feedback"></span>
                                </div>

                                <div class="form-outline ">
                                    <input type="password" name="password" id="password" class="form-control"
                                        placeholder="Password" />
                                    <span class="invalid-feedback"></span>
                                </div>

                                <div class="form-outline text-center mt-4">
                                    <input type="submit" name="login" id="submitBtn" value="Login"
                                        class="btn btn-primary">
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script>
        $(document).ready(function () {
            $("#loginForm").validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true
                    }
                },
                messages: {
                    email: {
                        required: "Please enter your email address",
                        email: "Please enter a valid email address"
                    },
                    password: {
                        required: "Please enter your password"
                    }
                },
                errorElement: "span",
                errorPlacement: function (error, element) {
                    error.addClass("invalid-feedback");
                    element.closest(".form-outline").append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass("is-invalid").removeClass("is-valid");
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass("is-invalid").addClass("is-valid");
                },
            });
        });


    </script>

</body>

</html>