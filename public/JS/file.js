$(document).ready(function () {
    loadData();


    // Insert Data
    $('#submitBtn').click(function () {
        var file_name = $("#fileName").val();
        var file_id = $("#fileId").val();

        // console.log(file_name);

        // Check if the input field is empty
        if (file_name.trim() === "") {
            $("#nameError").text("Fill the input field").show();
        } else {
            $("#nameError").hide();

            $.ajax({
                type: "POST",
                url: "../../../../PHP/File/app/File/newFileProcess.php",
                data: {
                    insert_data: true,
                    file_name: file_name,
                    file_id: file_id
                }, 
                success: function (response) {
                    // alert(response);

                    if (response === "duplicate") {
                        toastr.error("File with Same Name or ID already exist !!.");
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

    // Edit Data
    $(document).on("click", ".edit_btn", function () {
        var id = $(this).closest('tr').find('.id').text();
        // alert(id);

        $.ajax({
            type: "POST",
            url: "../../../../PHP/File/app/File/newFileProcess.php",
            data: {
                edit: true,
                id: id,

            },
            success: function (response) {
                // console.log(response);
                $.each(response, function (key, value) {
                    $('#id').val(value['id']);
                    $('#file_name').val(value['file_name']);
                    $('#file_id').val(value['file_id']);
                });
                $('#editData').modal('show');
            }
        });
    });

    // Update Data
    $('#updateBtn').click(function () {
        var id = $("#id").val();
        var file_name = $("#file_name").val();
        var file_id = $("#fileId").val();

        // console.log(file_name);


        $.ajax({
            type: "POST",
            url: "../../../../PHP/File/app/File/newFileProcess.php",
            data: {
                update_data: true,
                id: id,
                file_name: file_name,
                file_id: file_id
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
                url: "../../../../PHP/File/app/File/newFileProcess.php",
                data: {
                    delete: true,
                    id: id,

                },
                success: function (response) {
                    toastr.success("Data Delete successfully");
                    // $('#tableBody').empty();
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
        url: "../../../../PHP/File/app/File/tableData.php",

        success: function (response) {
            // console.log(response);
            $('#tableBody').empty();

            $.each(response, function (key, value) {
                // console.log(value['file_name']);
                $('#tableBody').prepend(
                    '<tr>' +
                    '<td class = "id d-none">' + value['id'] + '</td>\
                    <td>'+ value['file_name'] + '</td>\
                    <td class="file_id">'+ value['file_id'] + '</td>\
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

// Generate a unique alphanumeric random string
$(document).ready(function () {
    $('#exampleModal').on('shown.bs.modal', function () {
        
        const alphanumericString = generateRandomAlphanumeric(10);
        console.log('Generated Unique Alphanumeric String: ' + alphanumericString);
        $('.fileId').val(alphanumericString);
    });

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

