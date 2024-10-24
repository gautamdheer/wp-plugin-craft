
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    </head>
    <body>

        <form action="javascript:void(0)" id="frm_add_employee" enctype="multipart/form-data">
            <input type="hidden" name="action" value="wce_add_employee">
            <div id="message"></div>
            <p>
                <label for="employee_name"><i class="fas fa-user form-icon"></i>Name</label>
                <input type="text" required name="name" id="employee_name" placeholder="Enter Employee Name">
            </p>
            <p>
                <label for="employee_email"><i class="fas fa-envelope form-icon"></i>Email</label>
                <input type="email" required name="email" id="employee_email" placeholder="Enter Employee Email">
            </p>
            <p>
                <label for="designation"><i class="fas fa-briefcase form-icon"></i>Designation</label>
                <select required name="designation" id="designation">
                    <option value="full_stack_developer">Full Stack Developer</option>
                    <option value="php_developer">PHP Developer</option>
                    <option value="net_developer">.Net Developer</option>
                    <option value="java_developer">Java Developer</option>
                </select>
            </p>
            <p>
                <label for="profile_image"><i class="fas fa-image form-icon"></i>Profile Image</label>
                <input type="file" name="profile_image" id="profile_image">
            </p>
            <p>
                <button type="submit" id="btn_save_data"><i class="fas fa-save"></i> Save </button>
            </p>
        </form>

        <div id="employee-table-container">
            <input type="hidden" id="wce_load_all_employee_data" value="1">
            <h3><i class="fas fa-list"></i> List of Employees</h3>
            <table id="employee-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Designation</th>
                        <th>Profile Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
        </div>

