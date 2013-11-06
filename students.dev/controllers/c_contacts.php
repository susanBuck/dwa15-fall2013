<?php
class contacts_controller extends base_controller {

    public function __construct() {
        parent::__construct();
        #echo "contacts_controller construct called<br><br>";
    } 

    public function index() {

		$this->template->content = View::instance('v_contacts_info');
		#echo "This is the index page";
		$this->template->title = "Contact";
		$this->template->body_id = 'contact';		

		// Render the View
		echo $this->template; 
    }

    public function test() {
            
        # Setup view
        $this->template->content = View::instance('v_contacts_info');
		#$this->template->title = "Contacts";
		#$this->template->body_id = 'contacts';

        # Render template
        echo $this->template;
            
        #echo "This is the contacts page";
    }

} # end of the class