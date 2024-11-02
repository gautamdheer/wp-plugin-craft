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
    register_rest_route('students/v1', '/students/(?P<id>\d+)', [
        'methods' => 'GET',
        'callback' => 'wcp_handle_get_single_student',
    ]);

    // update single student
    register_rest_route('students/v1', '/students/(?P<id>\d+)', [
        'methods' => 'PUT',
        'callback' => 'wcp_handle_put_student',
    ]);

    // delete single student
    register_rest_route('students/v1','/students/(?P<id>\d+)', [
        'methods' => 'DELETE',
        'callback' => 'wcp_handle_delete_student',
    ]);

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

    // get single student
    function wcp_handle_get_single_student($request)
    {
        $id = $request->get_param('id');

        global $wpdb;
        $table_name = $wpdb->prefix . 'students';
        $student = $wpdb->get_row('SELECT * FROM ' . $table_name . ' WHERE id = ' . $id, ARRAY_A);

        return rest_ensure_response([
            'success' => true,
            'message' => 'Student fetched successfully',
            'data' => $student,
        ]);
    }

    // handle put student
    function wcp_handle_put_student($request)
    {
      $id = $request->get_param('id');
      $name = $request->get_param('name');
      $email = $request->get_param('email');
      $phone = $request->get_param('phone');

      global $wpdb;
      $table_name = $wpdb->prefix . 'students';
      $wpdb->update($table_name, [
        'name' => $name,
        'email' => $email,
        'phone' => $phone,
    ], ['id' => $id]);

        return rest_ensure_response([
            'success' => true,
            'message' => 'Student updated successfully',
            'data' => $request->get_params(),
        ]);
    }


    // handle delete student
    function wcp_handle_delete_student($request)
    {
        $id = $request->get_param('id');

        global $wpdb;
        $table_name = $wpdb->prefix . 'students';
        $wpdb->delete($table_name, ['id' => $id]);

        return rest_ensure_response([
            'success' => true,
            'message' => 'Student deleted successfully',
        ]);
    }   
    ?>
