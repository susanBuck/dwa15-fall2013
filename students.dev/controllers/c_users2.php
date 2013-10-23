<?php
class users_controller extends base_controller {

    public function __construct() {
        parent::__construct();
        #echo "users_controller construct called<br><br>";
    } 

    public function index() {
        echo "This is the index page";
    }

    public function signup() {
    
        # Setup view
            $this->template->content = View::instance('v_users_signup');
            $this->template->title   = "Sign Up";

        # Render template
            echo $this->template;
    }
    
    public function p_signup() {

        // Dump out the results of POST to see what the form submitted
        #echo '<pre>'
        #print_r($_POST);
        #echo '</pre>'
        
        // More data we want stored with the user
    	$_POST['created']  = Time::now();
    	$_POST['modified'] = Time::now();
    	
    	// Encrypt the password  
    	$_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);
    	
    	// Create an encrypted token via their email address and a random string
    	$_POST['token'] = sha1(TOKEN_SALT.$_POST['email'].Utils::generate_random_string());  
        
        // Insert this user into the database
    	$user_id = DB::instance(DB_NAME)->insert('users', $_POST);

    	// For now, just confirm they've signed up - 
    	// You should eventually make a proper View for this
    	echo 'You\'re signed up';          
    }

    public function login() {
    
        // Setup view
        	$this->template->content = View::instance('v_users_login');
        	$this->template->title   = "Login";

    	// Render template
        	echo $this->template;
        	#echo "This is the login page";
    }
    
    public function p_login() {

    	// Sanitize the user entered data to prevent any funny-business (re: SQL Injection Attacks)
    	$_POST = DB::instance(DB_NAME)->sanitize($_POST);
    	
    	// Hash submitted password so we can compare it against one in the db
    	$_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);
    	
    	// Search the db for this email and password
    	// Retrieve the token if it's available
    	$q = "SELECT token 
        	FROM users 
        	WHERE email = '".$_POST['email']."' 
        	AND password = '".$_POST['password']."'";
        	
		$token = DB::instance(DB_NAME)->select_field($q); 
        	
        // If we didn't find a matching token in the database, it means login failed
    	if(!$token) {

        	// Send them back to the login page
        	Router::redirect("/users/login/");
        
        // But if we did, login succeeded! 
    	} else {

        	/* 
        	Store this token in a cookie using setcookie()
        	Important Note: *Nothing* else can echo to the page before setcookie is called
        	Not even one single white space.
        	param 1 = name of the cookie
        	param 2 = the value of the cookie
        	param 3 = when to expire
        	param 4 = the path of the cooke (a single forward slash sets it for the entire domain)
        	*/
        	setcookie("token", $token, strtotime('+1 year'), '/');

        	// Send them to the main page - or whever you want them to go
        	// This is the index page ... maybe send them to posts.php
        	Router::redirect("/");
        	
        	#echo '<pre>';
			#print_r($this->user);
			#echo '</pre>';

    	}    
    }

    public function logout() {
    
        // Generate and save a new token for next login
    	$new_token = sha1(TOKEN_SALT.$this->user->email.Utils::generate_random_string());

    	// Create the data array we'll use with the update method
    	// In this case, we're only updating one field, so our array only has one entry
    	$data = Array("token" => $new_token);

    	// Do the update
    	DB::instance(DB_NAME)->update("users", $data, "WHERE token = '".$this->user->token."'");

    	// Delete their token cookie by setting it to a date in the past - effectively logging them out
    	setcookie("token", "", strtotime('-1 year'), '/');

    	// Send them back to the main index.
    	Router::redirect("/");
    
        #echo "This is the logout page";
    }

    public function profile($user_name = NULL) {
    
    	// Don't have to do this because it's already in the base_controller
    	#$template = View::instance('_v_template');
    	
    	// If user is blank, they're not logged in; redirect them to the login page
    	if(!$this->user) {
        	Router::redirect('/users/login');
    	}

    	// If they weren't redirected away, continue:

    	// Pass our view fragment to the master template content
    	// Set up the View (see Cheat Sheet)
    	$this->template->content = View::instance('v_users_profile');
    	$this->template->title = "Profile of".$this->user->first_name;
    	
    	// Method inside the utilities library to help with this
    	$client_files_head = Array(
    		'/css/profile.css',
    		'/css/reset.css',  
    		'/css/master.css'
    		);
    	
    	$this->template->client_files_head = Utils::load_client_files($client_files_head);
    
        // Method inside the utilities library to help with this
    	$client_files_body = Array(
    		'/js/profile.js', 
    		);
    	
    	$this->template->client_files_body = Utils::load_client_files($client_files_body);
    
    	// Pass the data to the view
    	$this->template->content->user_name = $user_name;
    	
    	// Or
    	// In class suggestion of creating a variable to pass data
    	#$content = View::instance('v_users_profile');
    	#$content->user_name = $user_name;
    	#$this->template->content = $content;
    	  	
    	// We just need to access it
    	// Display the view
    	echo $this->template;
    
    	// Below is the isolated view fragment ... 
    	// Above, we recreated this view and  passed it to the master template
    	#$view = View::instance('v_users_profile');	
    	// On the fly pass it a variable
    	#$view->user_name = $user_name;
    	//$view->color = "red";
    	
    	// You should only ever have one echo in you controllers 
    	// and that is to echo at the end of the file
    	#echo $view;

        #if($user_name == NULL) {
        #    echo "No user specified";
        #}
        #else {
        #    echo "This is the profile for ".$user_name;
        #}
    }

} # end of the class