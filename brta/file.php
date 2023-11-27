<!DOCTYPE html>
<html>
<head>
    <title>Modal with Dynamic Form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        Open Modal
    </button>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Update</h1>
                    <button class="btn btn-select" id="newButton">New Transaction</button>
                    <button class="btn" id="updateButton">Update Transaction</button>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- New Transaction Form -->
                <div class="modal-body" id="newTransactionForm">
                    <!-- Your New Transaction Form content -->
                    <form action="">
                        <div>
                            <h1>Hello man</h1>
                        </div>
                    </form>
                </div>

                <!-- Update Transaction Form (Initially hidden) -->
                <div class="modal-body" id="updateTransactionForm" style="display: none;">
                    <!-- Your Update Transaction Form content -->
                    <form action="">
                        <div>
                            <h1>Hello</h1>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                    <button type="button" name="submit" id="submitBtn" class="btn btn-success btn-sm">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function () {
            // Initially select the "New Transaction" button
            $("#newButton").addClass("btn-select");

            // Add a click event handler to the "New Transaction" button
            $("#newButton").click(function () {
                // Add the btn-select class to the clicked button and remove it from the other button
                $("#newButton").addClass("btn-select");
                $("#updateButton").removeClass("btn-select");

                // Show the New Transaction Form
                $("#newTransactionForm").show();
                // Hide the Update Transaction Form
                $("#updateTransactionForm").hide();
            });

            // Add a click event handler to the "Update Transaction" button
            $("#updateButton").click(function () {
                // Add the btn-select class to the clicked button and remove it from the other button
                $("#updateButton").addClass("btn-select");
                $("#newButton").removeClass("btn-select");

                // Show the Update Transaction Form
                $("#updateTransactionForm").show();
                // Hide the New Transaction Form
                $("#newTransactionForm").hide();
            });
        });
    </script>
</body>
</html>
