    <?php

    class MyEmployees
    {
        private $wpdb;
        private $table_name;
        private $table_prefix;

        public function __construct()
        {
            global $wpdb;
            $this->wpdb = $wpdb;
            $this->table_prefix = $this->wpdb->prefix;
            $this->table_name = $this->table_prefix."employees";
        }
    
        // Create DB table
        public function callPluginActivationFunctions()
        {
            $collate = $this->wpdb->get_charset_collate();
            $createCommand = "
            CREATE TABLE IF NOT EXISTS `".$this->table_name."` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `name` varchar(50) NOT NULL,
                `email` varchar(50) DEFAULT NULL,
                `designation` varchar(50) DEFAULT NULL,
                PRIMARY KEY (`id`)
            ) ".$collate."
        ";
            require_once(ABSPATH. "/wp-admin/includes/upgrade.php");
            dbDelta($createCommand);

            $post_title = "Employee Listing Form";
            $post_content = "[wp-employee-form]";
            
            if(!get_the_title($post_title)){
                wp_insert_post(array(
                    "post_title"=>$post_title,
                    "post_content"=>$post_content,
                    "post_type"=>"page",
                    "post_status"=>"publish")
                );  
            }

            
        }

        public function dropTheTable(){
            $createCommand = "DROP TABLE IF EXISTS {$this->table_name}";
            $this->wpdb->query($createCommand);
        }

        public function createEmployeeForm(){
           ob_start();
           include_once plugin_dir_path(__FILE__)."template/employee-form.php";
           $layout = ob_get_contents();
           ob_end_clean();
           return $layout;
        }

        // add css / js file
        public function addAssetsToPlugin(){
            // Style
            wp_enqueue_style("employee-crud-css",WCE_DIR_URL."assets/style.css");

            //ValidateJs 
            wp_enqueue_script("wce-validation",WCE_DIR_URL."assets/jquery.validate.min.js",array("jquery"));

            // JS
            wp_enqueue_script("employee-crud-js",WCE_DIR_URL."assets/script.js",array("jquery"),"3.0");
            
            wp_localize_script("employee-crud-js","wce_object", array(
                "ajax_url" => admin_url("admin-ajax.php")
                ));
        }

        // Process Ajax Request : Add Employee Form
        public function handleAddEmployeeFormData() {    

            $name = sanitize_text_field($_POST['name']);
            $email = sanitize_text_field($_POST['email']);
            $designation = sanitize_text_field($_POST['designation']);
            
            $profile_url = "";
            /**
             * array("test_form"=>false) -> wp_handle_upload is not going to check any file attributes or even file submission
             * 
             * array("test_form"=>true) -> wp_handle_upload will validate form request nonce value and other form parameters
             */

            // File is empty
            if(isset($_FILES['profile_image']['name'])){
                
                // file available
                $fileUploaded = wp_handle_upload($_FILES['profile_image'], array("test_form"=>false));
                $profile_url = $fileUploaded['url'];
            }

            $this->wpdb->insert(
                $this->table_name,[
                    'name'=> $name,
                    'email'=> $email,
                    'designation'=> $designation,
                    'profile_url'=> $profile_url
                ]
            );
            $employee_id  = $this->wpdb->insert_id;

            if($employee_id){
                echo json_encode([
                    "status"=>"1",
                    "message"=> "Successfully, created the employee",
                    "data" => $_POST
                ]);
            }
            else{
                echo json_encode([
                    "status"=>"0",
                    "message"=> "There is error while submiting the request",
                    "data" => $_POST
                ]);
            }


        }
    }
    ?>  