jQuery(document).ready(function () {

    // Add form validation
    jQuery("#frm_add_employee").validate();

    // form submit
    jQuery("#frm_add_employee").on("submit", function (e) {
        e.preventDefault();
        var formData = new FormData(this);

        jQuery.ajax({
            url: wce_object.ajax_url,
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.status) {
                    jQuery("#message").html('<p style="color: green;">' + response.message + '</p>');
                    jQuery("#frm_add_employee")[0].reset();
                    loadEmployeeData();
                } else {
                    jQuery("#message").html('<p style="color: red;">' + response.message + '</p>');
                }

            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log('Error: ' + textStatus + ', ' + errorThrown);
            }

        });
    });

    // Load employee data   
    loadEmployeeData();

    // delete employee
    jQuery("#employee-table").on("click", ".delete-employee", function () {
        if(confirm("Are you sure you want to delete this employee?")){
            var employeeId = jQuery(this).data("id");
            deleteEmployee(employeeId);
        }
    });
});

function loadEmployeeData() {
    jQuery.ajax({
        url: wce_object.ajax_url,
        method: "GET",
        data: {
            action: 'wce_load_all_employee_data'
        },

        success: function (response) {
            console.log(response);
            if (response.status) {
                let tableBody = jQuery("#employee-table tbody");
                tableBody.empty();

                response.data.forEach(function (employee) {
                    let row = `<tr>
                        <td>${employee.id}</td>
                        <td>${employee.name}</td>
                        <td>${employee.email}</td>
                        <td>${employee.designation}</td>
                        <td><img src="${employee.profile_url}" alt="profile image" style="width: 100px; height: 100px;border-radius: 50%;"></td>
                        <td>
                            <button class="edit-employee" data-id="${employee.id}">Edit</button>
                            <button class="delete-employee" data-id="${employee.id}">Delete</button>
                        </td>
                    </tr>`;
                    tableBody.append(row);
                });
            } else {
                console.log('Error loading employee data:', response.message);
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log('Error: ' + textStatus + ', ' + errorThrown);
        }
    });
}

function deleteEmployee(employeeId) {
    jQuery.ajax({
        url: wce_object.ajax_url,
        method: "POST",
        data: {
            action: 'wce_delete_employee',
            employee_id: employeeId
        },
        success: function (response) {
            console.log(response);
            if(response && response.status){
                alert(response.message);
                loadEmployeeData();
            }
            else{
                alert(response.message);
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log('Error: ' + textStatus + ', ' + errorThrown);
        }   
    });
}


