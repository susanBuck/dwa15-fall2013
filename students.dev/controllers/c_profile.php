<?php
class profile_controller extends base_controller {

    public function __construct() {
        parent::__construct();
    } 

    public function index() {
        # If user is blank, they're not logged in; redirect them to the login page
        if(!$this->user) {
            Router::redirect('/users/login');
        }

        # First, set the content of the template with a view file
        $this->template->content = View::instance('v_profile_index');

        # Now set the <title> tag
        $this->template->title = "Profile";

        # Create an array of 1 or many client files to be included in the head
        $client_files_head = Array('/css/forms.css');

        # Use load_client_files to generate the links from the above array
        $this->template->client_files_head = Utils::load_client_files($client_files_head);  

        # Render the view
        echo $this->template;

        echo "<pre>";
        print_r($this->user);
        echo "</pre>";


    }

}#eoc