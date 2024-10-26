jQuery(document).ready(function () {
  // form submit
  jQuery("#frm_add_employee").on("submit", function (e) {
    e.preventDefault();
    // Add form validation
    jQuery("#frm_add_employee").validate();

    var formData = new FormData(this);

    jQuery.ajax({
      url: wce_object.ajax_url,
      method: "POST",
      data: formData,
      processData: false,
      contentType: false,
      success: function (response) {
        if (response.status) {
          jQuery("#message").html(
            '<p style="color: green;">' + response.message + "</p>"
          );
          jQuery("#frm_add_employee")[0].reset();
          loadEmployeeData();
        } else {
          jQuery("#message").html(
            '<p style="color: red;">' + response.message + "</p>"
          );
        }
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.log("Error: " + textStatus + ", " + errorThrown);
      },
    });
  });

  // Load employee data
  loadEmployeeData();

  // delete employee
  jQuery("#employee-table").on("click", ".delete-employee", function () {
    if (confirm("Are you sure you want to delete this employee?")) {
      var employeeId = jQuery(this).data("id");
      deleteEmployee(employeeId);
    }
  });

  // Add Employee
  jQuery("#btn_add_employee").on("click", function () {
    jQuery("#close_employee_form").removeClass("hide_element");
    jQuery("#frm_add_employee").removeClass("hide_element");
    jQuery("#frm_edit_employee").addClass("hide_element");
    jQuery("#btn_add_employee").addClass("hide_element");
  });

  // Close employee form
  jQuery("#close_employee_form").on("click", function () {
    jQuery("#frm_add_employee").addClass("hide_element");
    jQuery("#frm_edit_employee").addClass("hide_element");
    jQuery("#btn_add_employee").removeClass("hide_element");
  });

  // Edit Employee
  jQuery("#employee-table").on("click", ".edit-employee", function (e) {
    e.preventDefault();
    var employeeId = jQuery(this).data("id");
    jQuery("#frm_edit_employee").removeClass("hide_element");
    jQuery("#close_employee_form").removeClass("hide_element");

    jQuery.ajax({
      url: wce_object.ajax_url,
      method: "GET",
      dataType: "json",
      data: {
        action: "wce_get_employee_data",
        employee_id: employeeId,
      },
      success: function (response) {
        jQuery("#employee_name").val(response.data.name);
        jQuery("#employee_email").val(response.data.email);
        jQuery("#employee_designation").val(response.data.designation);
        jQuery("#employee_profile_image_preview").attr("src",response.data.profile_image);

        console.log("Data received:", response);
    },
      error: function (jqXHR, textStatus, errorThrown) {
        console.log("Error: " + textStatus + ", " + errorThrown);
      },
    });
    jQuery("#btn_edit_data").on("click", function () {
      updateEmployee(employeeId);
    });
  });

  // Edit close employee form
  jQuery("#close_employee_edit_form").on("click", function () {
    jQuery("#frm_edit_employee").addClass("hide_element");
  });
});

function loadEmployeeData() {
  jQuery.ajax({
    url: wce_object.ajax_url,
    method: "GET",
    data: {
      action: "wce_load_all_employee_data",
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
                        <td><img src="${employee.profile_image}" alt="profile image" style="width: 100px; height: 100px;border-radius:50%;"></td>
                        <td width="150px">
                            <button class="edit-employee" data-id="${employee.id}">Edit</button>
                            <button class="delete-employee" data-id="${employee.id}">Delete</button>
                        </td>
                    </tr>`;
          tableBody.append(row);
        });
      } else {
        console.log("Error loading employee data:", response.message);
      }
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.log("Error: " + textStatus + ", " + errorThrown);
    },
  });
}

function deleteEmployee(employeeId) {
  jQuery.ajax({
    url: wce_object.ajax_url,
    method: "POST",
    data: {
      action: "wce_delete_employee",
      employee_id: employeeId,
    },
    success: function (response) {
      console.log(response);
      if (response && response.status) {
        alert(response.message);
        loadEmployeeData();
      } else {
        alert(response.message);
      }
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.log("Error: " + textStatus + ", " + errorThrown);
    },
  });
}

function updateEmployee(employeeId) {

  jQuery("#frm_edit_employee").on("submit", function (e) {
    e.preventDefault();
    
    jQuery.ajax({
        url: wce_object.ajax_url,
        method: "POST",
        data: {
          action: "wce_edit_employee",
          employee_id: employeeId,
          name: jQuery("#employee_name").val(),
          email: jQuery("#employee_email").val(),
          designation: jQuery("#employee_designation").val(), 
          profile_image: jQuery("#employee_profile_image").val(),
        },
        success: function (response) {
           if(response.status){
            alert(response.message);
            loadEmployeeData();
          }else{
            alert(response.message);
          }
        },
        error: function (jqXHR, textStatus, errorThrown) {
          console.log("Error: " + textStatus + ", " + errorThrown);
        },
      }); 
    });
}
