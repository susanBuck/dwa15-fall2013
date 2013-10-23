<?php
class posts_controller extends base_controller {

    public function __construct() {
        parent::__construct();
        #echo "posts_controller construct called<br><br>";
    } 

    public function index() {
        echo "This is the index page";
    }

    public function all($all_posts = NULL) {
            
        # Setup view
        $this->template->content = View::instance('v_posts_all');
        $this->template->title   = "View All Posts";
        
        //Query the DB for all posts and put into array
        $view_posts = DB::instance(DB_NAME)->select_rows('SELECT * FROM posts');

		$this->template->content->view_posts = $view_posts;

        # Render template
        echo $this->template;
    
        echo "This is the posts page";
    }
    
    /*public function p_all() {
    
        //Query the DB for all posts and put into array
        $view_posts = DB::instance(DB_NAME)->select_rows('SELECT * FROM posts');

		$this->template->content->view_posts = $view_posts;

        # Render template
        echo $this->template;    
    }*/
    
    public function add () {
    
       	// Setup view
        $this->template->content = View::instance('v_posts_add');
        $this->template->title   = "Add A Post";
        $this->template->body_id = 'add'; 

        // Render template
        echo $this->template;
    
    	#echo "This is the add a post page";
    
    }
    
    public function p_add () {
    
    	#echo "<pre>";
    	#print_r($_POST();
    	#echo "</pre>";
    	    
        // More data we want stored with the post
    	$_POST['created']  = Time::now();
    	$_POST['modified'] = Time::now();
    	
    	// Insert an array
    	#$_POST = Array (
		#	'comment' => "$_POST[comment]",
			
		#);
		
		// Insert this post into the database
		$post_id = DB::instance(DB_NAME)->insert('posts',$_POST);
		
		// Where do I want to redirect them
		#Router::redirect('/posts/...);
    }
    
    /*-------------------------------------------------------------------------------------------------
	Demonstrating Classes/Objects
	-------------------------------------------------------------------------------------------------*/
	public function display_image() {
	
		// Make sure code has access to my image class (temp solution)
		#require(APP_PATH.'/libraries/Image.php');
	
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
    

            

    

    public function edit() {
    
    
        echo "This is the edit post page";
    }

    #public function delete() {
        #echo "This is the delete post page";
    #}
    
    public function search() {
        echo "This is the delete post page";
    }
    #public function profile($user_name = NULL) {

       #if($user_name == NULL) {
            #echo "No user specified";
        #}
        #else {
            #echo "This is the profile for ".$user_name;
        #}
    #}

} # end of the class