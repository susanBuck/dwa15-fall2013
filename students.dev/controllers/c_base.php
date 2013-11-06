<?php

class base_controller {

    public $user;
    public $userObj;
    public $template;
    public $email_template;

    public function __construct() {

        # Instantiate a User object
            $this->userObj = new User();

        # Authenticate / load user
            $this->user = $this->userObj->authenticate();                   
        # Set up templates
            $this->template       = View::instance('_v_template');
            $this->email_template = View::instance('_v_email');         

        # Set a global variable called $user which is accessible to all the views
        # Set it to be $this->user
            $this->template->set_global('user', $this->user);

    }

}

?>
