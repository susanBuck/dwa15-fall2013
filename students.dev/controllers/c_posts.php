<?php
class posts_controller extends base_controller {

    public function __construct() {
        parent::__construct();
        
        # Make sure user is logged in if they want to use anything in this controller
        if(!$this->user) {
            die("Members only. <a href='/users/login'>Login</a>");
        }
        #echo "posts_controller construct called<br><br>";
    } 
    
    /*-------------------------------------------------------------------------------------------------
	INDEX
	-------------------------------------------------------------------------------------------------*/
    public function index() {

    	// Set up the View
    	$this->template->content = View::instance('v_posts_index');
    	
    	// I want followed posts listed under my add method
    	#$this->template->content = View::instance('v_posts_add');
    	
    	$this->template->title   = "Posts";
    	$this->template->body_id   = 'posts';

    	/* This is the entire steam of posts
    	// Build the query
    	$q = "SELECT 
            	posts .* , 
            	users.first_name, 
            	users.last_name
        	FROM posts
        	INNER JOIN users 
            	ON posts.user_id = users.user_id";
        */
        
        // Build the follow query
        
        $q = 'SELECT 
            posts.content,
            posts.created,
            posts.user_id AS post_user_id,
            users_users.user_id AS follower_id,
            users.first_name,
            users.last_name
        FROM posts
        INNER JOIN users_users 
            ON posts.user_id = users_users.user_id_followed
        INNER JOIN users 
            ON posts.user_id = users.user_id
        WHERE users_users.user_id = '.$this->user->user_id;

    	// Run the query
    	$posts = DB::instance(DB_NAME)->select_rows($q);

    	// Pass data to the View
    	$this->template->content->posts = $posts;

    	// Render the View
    	echo $this->template;

	}
	
    /*-------------------------------------------------------------------------------------------------
	ADD a post
	-------------------------------------------------------------------------------------------------*/

        public function add() {
    
       	// Setup view
        $this->template->content = View::instance('v_posts_add');
        $this->template->title   = "New Post";
        $this->template->body_id = 'add'; 

        // Render template
        echo $this->template;
    
    	#echo "This is the add a post page";
    
    }
    
    public function p_add() {
    
    	#echo "<pre>";
    	#print_r($_POST();
    	#echo "</pre>";
    	
        // Associate this post with this user
        $_POST['user_id']  = $this->user->user_id;
            	    
        // Unix timestamp of when this post was created / modified
    	$_POST['created']  = Time::now();
    	$_POST['modified'] = Time::now();
		
		// Insert
 		/* Note we didn't have to sanitize any of the $_POST data 
 		because we're using the insert method which does it for us*/		
 		DB::instance(DB_NAME)->insert('posts',$_POST);
 		
		// Quick and dirty feedback
        echo "Your post has been added. <a href='/posts/add'>Add another</a>";
        		
		// Where do I want to redirect them
		#Router::redirect('/posts/...);
    }
    
    /*-------------------------------------------------------------------------------------------------
	USERS a setting for which users are seen
	-------------------------------------------------------------------------------------------------*/
	public function users() {

    	// Set up the View
    	$this->template->content = View::instance("v_posts_users");
    	$this->template->title   = "Users";
    	$this->template->body_id = 'users'; 

    	// Build the query to get all the users
    	$q = "SELECT *
        	FROM users";

    	// Execute the query to get all the users. 
    	// Store the result array in the variable $users
    	$users = DB::instance(DB_NAME)->select_rows($q);

    	// Build the query to figure out what connections does this user already have? 
    	// I.e. who are they following
    	$q = "SELECT * 
        	FROM users_users
        	WHERE user_id = ".$this->user->user_id;

    	// Execute this query with the select_array method
    	// select_array will return our results in an array and use the "users_id_followed" field as the index.
    	// This will come in handy when we get to the view
    	// Store our results (an array) in the variable $connections
    	$connections = DB::instance(DB_NAME)->select_array($q, 'user_id_followed');

    	// Pass data (users and connections) to the view
    	$this->template->content->users       = $users;
    	$this->template->content->connections = $connections;

    	// Render the view
    	echo $this->template;
	}


    /*-------------------------------------------------------------------------------------------------
	FOLLOW
	-------------------------------------------------------------------------------------------------*/

	public function follow($user_id_followed) {

    	// Prepare the data array to be inserted
    	$data = Array(
        	"created" => Time::now(),
        	"user_id" => $this->user->user_id,
        	"user_id_followed" => $user_id_followed
        	);

    	// Do the insert
    	DB::instance(DB_NAME)->insert('users_users', $data);

    	// Send them back
    	Router::redirect("/posts/users");

	}
	
    /*-------------------------------------------------------------------------------------------------
	UNFOLLOW
	-------------------------------------------------------------------------------------------------*/

	public function unfollow($user_id_followed) {

    	// Delete this connection
    	$where_condition = 'WHERE user_id = '.$this->user->user_id.' AND user_id_followed = '.$user_id_followed;
    	DB::instance(DB_NAME)->delete('users_users', $where_condition);

    	// Send them back
    	Router::redirect("/posts/users");

	}

    /*-------------------------------------------------------------------------------------------------
	...
	-------------------------------------------------------------------------------------------------*/

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