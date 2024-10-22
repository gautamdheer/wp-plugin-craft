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

        
    }
    ?>