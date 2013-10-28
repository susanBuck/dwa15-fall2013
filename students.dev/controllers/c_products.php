<?php
class products_controller extends base_controller {

    public function __construct() {
        parent::__construct();
        #echo "products_controller construct called<br><br>";
    } 

    public function index() {
    
    
        echo "This is the index page";
    }

    public function test() {
            
        # Setup view
        $this->template->content = View::instance('v_products_test');
        $this->template->title   = "Testing highlightnavigation.js";
        $this->template->body_id = 'products';

        # Render template
        echo $this->template;
            
        #echo "This is the products page";
    }
    
    
    /*-------------------------------------------------------------------------------------------------
	Demonstrating Classes/Objects
	-------------------------------------------------------------------------------------------------*/
	public function display_image() {
	
		// Make sure code has access to my image class (temp solution)
		require(APP_PATH.'/libraries/Image.php');
	
		#echo "You are looking at test1.";
	
		#echo APP_PATH."<br>";
		#echo DOC_ROOT."<br>";
	
		// Once we have access, we instantiate an object from that class
		// and pass the parameter to the construct
		$imageObj = new Image('http://placekitten.com/1000/1000');
	
		// Then we have access to all the methods within that object
		// and we can point to the methods in that class
		$imageObj->resize(500,500);
	
		$imageObj->display();

	}
    
    public function search() {
        echo "This is the page";
    }


} # end of the class
