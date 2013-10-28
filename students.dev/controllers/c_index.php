<?php

class index_controller extends base_controller {
    
    /*-------------------------------------------------------------------------------------------------
     initialization tasks for the class 
    -------------------------------------------------------------------------------------------------*/
    public function __construct() {
        parent::__construct();
    } 
        
    /*-------------------------------------------------------------------------------------------------
    Accessed via http://localhost/index/index/
    -------------------------------------------------------------------------------------------------*/
    public function index() {

        if (!isset($user)) {

            # First, set the content of the template with a view file
            $this->template->content = View::instance('v_index_index');
            
            # Now set the <title> tag
            $this->template->title = "Small Talk";

            # Create an array of 1 or many client files to be included in the head
            $client_files_head = Array('/css/index.css');

            # Use load_client_files to generate the links from the above array
            $this->template->client_files_head = Utils::load_client_files($client_files_head);  

            # Render the view
            echo $this->template;
        }
        else {
            /* if user is already logged in, go to the user landing page */
            Router::redirect("/users/login");
        }

    } # End of method
    
    
} # End of class
