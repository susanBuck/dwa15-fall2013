<?php
class products_controller extends base_controller {

    public function __construct() {
        parent::__construct();
        #echo "products_controller construct called<br><br>";
    } 

    public function index() {

		$this->template->content = View::instance('v_products_test');
		#echo "This is the index page";
		$this->template->title = "Products";
		$this->template->body_id = 'products';
		
		// Render the View
		echo $this->template; 
    }

    public function test() {
            
        # Setup view
        $this->template->content = View::instance('v_products_test');
		#$this->template->title = "Products";
		#$this->template->body_id = 'products';

        # Render template
        echo $this->template;
            
        #echo "This is the products page";
    }

} # end of the class
