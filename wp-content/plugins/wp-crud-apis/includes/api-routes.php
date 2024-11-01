<?php
// create student
register_rest_route('students/v1', 'students', [
    'methods' => 'POST',
    'callback' => 'wcp_handle_create_student',
    'args' => [
        'name' => [
            'required' => true,
            'type' => 'string',
        ],
        'email' => [
            'required' => true,
            'type' => 'string',
        ],
        'phone' => [
            'required' => true,
            'type' => 'string',
        ],
    ],
]);

// read all students
register_rest_route('students/v1', '/students', [
    'methods' => 'GET',
    'callback' => 'wcp_handle_get_students',
]);

// read single student

// update single student

// delete single student

// handle create student
function wcp_handle_create_student($request)
{
    $name = $request->get_param('name');
    $email = $request->get_param('email');
    $phone = $request->get_param('phone');

    global $wpdb;
    $table_name = $wpdb->prefix . 'students';

    // insert data into database
    $wpdb->insert($table_name, [
        'name' => $name,
        'email' => $email,
        'phone' => $phone,
    ]);

    if ($wpdb->insert_id > 0) {
        return rest_ensure_response([
            'success' => true,
            'message' => 'Student created successfully',
            'data' => $request->get_params(),
        ]);
    } else {
        return rest_ensure_response([
            'success' => false,
            'message' => 'Student creation failed',
        ], 500);
    }
}

// get all students
function wcp_handle_get_students()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'students';
    $students = $wpdb->get_results('SELECT * From ' . $table_name, ARRAY_A);

    return rest_ensure_response([
        'success' => true,
        'message' => 'Students fetched successfully',
        'data' => $students,
    ]);
}

?>
