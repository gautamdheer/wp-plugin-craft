
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        h3 {
            color: #2c3e50;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: auto;
        }
        label {
            font-weight: bold;
            color: #34495e;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 16px;
        }
        button {
            background-color: #3498db;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #2980b9;
        }
        .form-icon {
            margin-right: 10px;
        }
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #34495e;
            color: white;
        }
        td {
            color: #333;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .action-buttons button {
            background-color: #e74c3c;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            margin-right: 10px;
        }
        .action-buttons button:hover {
            background-color: #c0392b;
        }
        .action-buttons .edit-btn {
            background-color: #2ecc71;
        }
        .action-buttons .edit-btn:hover {
            background-color: #27ae60;
        }
    </style>
</head>
<body>

    <form action="javascript:void(0)" id="frm_add_employee" enctype="multipart/form-data">
        <p>
            <label for="employee_name"><i class="fas fa-user form-icon"></i>Name</label>
            <input type="text" name="employee_name" id="employee_name" placeholder="Enter Employee Name">
        </p>
        <p>
            <label for="employee_email"><i class="fas fa-envelope form-icon"></i>Email</label>
            <input type="email" name="employee_email" id="employee_email" placeholder="Enter Employee Email">
        </p>
        <p>
            <label for="designation"><i class="fas fa-briefcase form-icon"></i>Designation</label>
            <select name="designation" id="designation">
                <option value="full">Full Stack Developer</option>
                <option value="php">PHP Developer</option>
                <option value="net">.Net Developer</option>
                <option value="java">Java Developer</option>
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

    <div>
        <h3><i class="fas fa-list"></i> List of Employees</h3>
        <table>
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
                <tr>
                    <td>1</td>
                    <td>Gautam Dheer</td>
                    <td>gautamdheer@gmail.com</td>
                    <td>Senior Software Developer</td>
                    <td>-----</td>
                    <td class="action-buttons">
                        <button class="edit-btn"><i class="fas fa-edit"></i> Edit</button>
                        <button><i class="fas fa-trash-alt"></i> Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

