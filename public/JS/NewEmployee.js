$(document).ready(function () {
    loadData();


    // Insert Data
    $('#submitBtn').click(function () {
        var name = $("#empName").val();
        var designation = $("#empDesignation").val();
        var code = $("#empID").val();
    
        // Check if the input fields are empty
        if (name.trim() === "") {
            $("#nameError").text("Name is required").show();
        } else {
            $("#nameError").hide();
        }
    
        if (designation.trim() === "") {
            $("#desigError").text("Designation is required").show();
        } else {
            $("#desigError").hide();
        }
    
        // Check if both name and designation are filled
        if (name.trim() !== "" && designation.trim() !== "") {
            $.ajax({
                type: "POST",
                url: "../../../../PHP/File/app/Employee/employeeProcess.php",
                data: {
                    insert_data: true,
                    name: name,
                    designation: designation,
                    code: code
                },
                success: function (response) {
                    // console.log(response);
                    // toastr.success("Data inserted successfully");
                    // $('#exampleModal').modal('hide');
                    // $("#myForm")[0].reset();
                    // loadData();
                    if (response === "duplicate") {
                        toastr.error("Employee with Code already exist !!.");
                        $("#myForm")[0].reset();
                        $('#exampleModal').modal('hide');
                    }
                    else if (response === "success"){
                        console.log(response);
                        toastr.success("Data inserted successfully");

                        $("#myForm")[0].reset();
                        $('#exampleModal').modal('hide');

                        loadData();
                    }
                    else{
                        toastr.error("Error inserting data.");
                    }

                },
                error: function () {
                    toastr.error("Error inserting data.");
                }
            });
        }
    });
    

    // // Edit Data
    $(document).on("click", ".edit_btn", function () {
        var id = $(this).closest('tr').find('.id').text();
        // alert(id);

        $.ajax({
            type: "POST",
            url: "../../../../PHP/File/app/Employee/employeeProcess.php",
            data: {
                edit: true,
                id: id,

            },
            success: function (response) {
                $.each(response, function (key, value) {
                    $('#id').val(value['id']);
                    $('#emp_name').val(value['name']);
                    $('#emp_designation').val(value['designation']);
                    $('#code').val(value['code']);
                });
                $('#editData').modal('show');
            }
        });
    });

    // Update Data 
    $('#updateBtn').click(function () {
        var id = $("#id").val();
        var name = $("#emp_name").val();
        var designation = $("#emp_designation").val();
        var code = $("#code").val();


        $.ajax({
            type: "POST",
            url: "../../../../PHP/File/app/Employee/employeeProcess.php",
            data: {
                update_data: true,
                id: id,
                name: name,
                designation: designation,
                code: code
            },
            success: function (response) {
                // alert(response);
                toastr.success("Data Updated successfully");

                $("#editForm")[0].reset();
                $('#editData').modal('hide');

                loadData();

               
            },
            error: function () {
                toastr.error("Error Updating data.");
            }
        });

    });

    // Delete Data 
    $(document).on("click", ".delete_btn", function () {
        if (confirm("Are you sure you want to delete this file?")) {
            var id = $(this).closest('tr').find('.id').text();

            $.ajax({
                type: "POST",
                url: "../../../../PHP/File/app/Employee/employeeProcess.php",
                data: {
                    delete: true,
                    id: id,

                },
                success: function (response) {
                    toastr.success("Data Delete successfully");
                    // // $('#tableBody').empty();
                    loadData();
                }
            });
        }
    });

});


// Load Data On Table
function loadData() {
    $.ajax({
        type: "GET",
        url: "../../../../PHP/File/app/Employee/employeeData.php",

        success: function (response) {
            // console.log(response);
            $('#tableBody').empty();

            $.each(response, function (key, value) {
                // console.log(value['name']);
                $('#tableBody').prepend(
                    '<tr>' +
                    '<td class = "id d-none">' + value['id'] + '</td>\
                    <td>'+ value['name'] + '</td>\
                    <td>'+ value['designation'] + '</td>\
                    <td>'+ value['code'] + '</td>\
                    <td>\
                    <button id="delete" class="btn btn-danger btn-sm delete_btn"><i class="fa fa-trash"></i></button>\
                    <button class="btn btn-primary btn-sm edit_btn"><i class="fa fa-edit"></i></button>\
                    <td>\
                    <a href="#" class="btn btn-sm toggle-status border border-info border-1"><i class="fa fa-check text-success"></i></a>\
                    </td>\
                    </td>\
                    </tr>'
                );
            });
        }
    });
}



// toggle-status buttons
$(document).on('click', '.toggle-status', function () {
    var icon = $(this).find('i');
    if (icon.hasClass('fa-check')) {
        icon.removeClass('fa-check text-success').addClass('fa-times text-danger');
        // console.log(1);
    } else {
        icon.removeClass('fa-times text-danger').addClass('fa-check text-success');
    }
});



$(document).ready(function () {
    $('#exampleModal').on('shown.bs.modal', function () {
        const alphanumericString = generateRandomAlphanumeric(10);
        // console.log(alphanumericString);
        $('.employee_id').val(alphanumericString);
    });

    // Function to generate a random alphanumeric string of a given length
    function generateRandomAlphanumeric(length) {
        const charset = '0123456789abcdefghijklmnopqrstuvwxyz';
        let result = '';
        for (let i = 0; i < length; i++) {
            const randomIndex = Math.floor(Math.random() * charset.length);
            result += charset.charAt(randomIndex);
        }
        return result;
    }
});

