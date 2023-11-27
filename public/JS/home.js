$(document).ready(function () {
    loadData();


    // Insert Data
    $('#submitBtn').click(function () {
        var employee_id = $("#code").val();
        var file_name = $("#fileName").val();
        var transaction_type = $("#type").val();
        var transaction_id = $("#transaction_id").val();
        var date = $("#date").val();


        $.ajax({
            type: "POST",
            url: "../../../../PHP/File/indexProcess.php",
            data: {
                insert_data: true,
                file_name: file_name,
                employee_id: employee_id,
                transaction_type: transaction_type,
                transaction_id: transaction_id,
                date: date
            },
            success: function (response) {
                // alert(response);

                if (response === "received") {
                    toastr.error("File Already Exist, You can update status !!.");
                    $("#myForm")[0].reset();
                    $('#exampleModal').modal('hide');

                }
                else if (response === "inserted") {
                    toastr.success("Data Inserted Successfully !");
                    $("#myForm")[0].reset();
                    $('#exampleModal').modal('hide');
                    loadData();
                }
            },
            error: function () {
                toastr.error("Error inserting data.");
            }
        });
    });

});

// Edit Data
$(document).on("click", ".edit_btn", function () {
    var transaction_id = $(this).closest('tr').find('.transaction_id').text();
    // alert(transaction_id);

    $.ajax({
        type: "POST",
        url: "../../../../PHP/File/indexProcess.php",
        data: {
            edit: true,
            transaction_id: transaction_id,

        },
        success: function (response) {
            // console.log(response);
            $.each(response, function (key, value) {
                $('#transaction_id').val(value['transaction_id']);
                $('#employee').val(value['employee_id']);
                $('#tr_type').val(value['transaction_type']);
            });
            $('#updateDataModal').modal('show');
        }
    });
});

// Update Data 
$('#updateBtn').click(function () {
    var employee_id = $("#employee").val();
    var transaction_type = $("#tr_type").val();
    var transaction_id = $("#transaction_id").val();
    var date = $("#date").val();



    console.log(1);


    $.ajax({
        type: "POST",
        url: "../../../../PHP/File/indexProcess.php",
        data: {
            update_data: true,
            employee_id: employee_id,
            transaction_type: transaction_type,
            transaction_id: transaction_id,
            date: date
        },
        success: function (response) {
            if (response === "success") {
                toastr.success("Update Transaction Successfully");
                $("#editForm")[0].reset();
                $('#updateDataModal').modal('hide');

                loadData();
            } else if (response === "received") {
                toastr.error("File Already Received !");
                $("#editForm")[0].reset();
                $('#updateDataModal').modal('hide');
            } else if (response === "returned") {
                toastr.error("File Already Returned !");
                $("#editForm")[0].reset();
                $('#updateDataModal').modal('hide');
            }
        },
        error: function () {
            toastr.error("Error inserting data.");
        }
    });
});

// Delete Data 
$(document).on("click", ".delete_btn", function () {
    if (confirm("Are you sure you want to delete this file?")) {
        var transaction_id = $(this).closest('tr').find('.transaction_id').text();

        $.ajax({
            type: "POST",
            url: "../../../../PHP/File/indexProcess.php",
            data: {
                delete: true,
                transaction_id: transaction_id,

            },
            success: function (response) {
                toastr.success("Data Delete successfully");
                // // $('#tableBody').empty();
                loadData();
            }
        });
    }
});


// Load Data On Table
function loadData() {
    $.ajax({
        type: "GET",
        url: "../../../../PHP/File/indexdata.php",

        success: function (response) {
            // console.log(response);
            $('#tableBody').empty();

            var serialNumber = response.length;

            $.each(response, function (key, value) {

                // console.log(value['file_name']);
                $('#tableBody').prepend(
                    '<tr>' +
                    '<td class = "transaction_id d-none">' + value['transaction_id'] + '</td>\
                    <td class = "fw-bold">' + serialNumber + '</td>\
                    <td>'+ value['file_name'] + '</td>\
                    <td>'+ value['employee_id'] + '</td>\
                    <td>'+ value['transaction_type'] + '</td>\
                    <td>'+ value['date'] + '</td>\
                    <td>\
                    <button id="delete" title="Delete" class="btn btn-danger btn-sm delete_btn"><i class="fa fa-trash"></i></button>\
                    <button title="Update" class="btn btn-primary btn-sm edit_btn"><i class="fa fa-edit"></i></button>\
                    </td>\
                    </tr>'
                );
                serialNumber--;
            });
        }
    });
}

// Select2
$(document).ready(function () {
    $(".selectFile").select2({
        placeholder: "Select File",
        dropdownParent: '#exampleModal'
    });
})

$(document).ready(function () {
    $(".selectEmployee").select2({
        placeholder: "Select Employee",
        dropdownParent: '#exampleModal'
    });
})

$(document).ready(function () {
    $(".select2Employee").select2({
        // placeholder: '#employee',
        dropdownParent: '#updateDataModal'
    });
})
