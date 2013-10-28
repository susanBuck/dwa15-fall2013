<?php
class users_controller extends base_controller {

    public function __construct() {
        parent::__construct();
        #echo "users_controller construct called<br><br>";
    } 

    public function index() {
    
    echo "This is the index page";
    
    }

	/*-------------------------------------------------------------------------------------------------
	SIGNUP (old signup before error check for empty fields
	-------------------------------------------------------------------------------------------------*/

/**    public function signup() {
    
        # Setup view
        $this->template->content = View::instance('v_users_signup');
        $this->template->title   = "Sign Up";
        $this->template->body_id = 'signup';

        # Render template
            echo $this->template;
            
    }*/
    
	/*-------------------------------------------------------------------------------------------------
	Demonstrating an alternative way to handle signup errors.
	In this method, we're submitting the signup form to itself.
	See Susan's code https://gist.github.com/susanBuck/7022533
	-------------------------------------------------------------------------------------------------*/
	public function signup() {
	
		# Set up view
		$this->template->content = View::instance('v_practice_signup');
        $this->template->title   = "Sign Up";
        $this->template->body_id = 'signup';		
	
		# Innocent until proven guilty
		$error = false;
	
		# Initiate error
		$this->template->content->error = '<br>';
	
		# If we have no post data (i.e. the form was not yet submitted, just display the View with the signup form and be done
		if(!$_POST) {
			echo $this->template;
			return;
		}
	
		# Otherwise...
		# Loop through the POST data
		foreach($_POST as $field_name => $value) {
		
			# If a field was blank, add a message to the error View variable
			if($value == "") {
				$this->template->content->error .= $field_name.' is blank.<br>';
				$error = true;
			}
		}	
		
		# Passed
		if(!$error) {
			#echo "No errors! At this point, you'd want to enter their info into the DB and redirect them somewhere else...";
			/*
			Code here to enter into DB
			Code here to redirect them somewhere else
			*/

        // Insert this user into the database
    	$user_id = DB::instance(DB_NAME)->insert('users', $_POST);
    	
    	// In class additions ???
    	#DB::instance(DB_NAME)->insert_row('users', $_POST):
    	
    	// For now, just confirm they've signed up - 
    	// You should eventually make a proper View for this
    	#echo 'You\'re signed up'; 
    	
    	// Send them to the login page
    	Router::redirect('/users/login');
    				
		}
		else {
			Render $this->template;
		}
 
	}

    // Helper function to determine duplicate email
    private function unique_email() {
    
		//Make sure it's sanitized first
		$_POST = DB::instance(DB_NAME)->sanitize($_POST);
    	
    	// Search the db for this email
    	$q = "SELECT COUNT(*) 
        		FROM users 
        		WHERE email  = '" .$_POST['email']. "'";
        
		// Run the query, echo what it returns	
		$count = DB::instance(DB_NAME)->select_field($q);
	        		
		if($count > 0) {
			// If there is a match $q will be greater than 0
			return false;
		}
		else {
			return true;
		}
    
    }
    
    public function p_signup() {

        // Dump out the results of POST to see what the form submitted
        #echo '<pre>'
        #print_r($_POST);
        #echo '</pre>'
        
        // More data we want stored with the user
    	$_POST['created']  = Time::now();
    	$_POST['modified'] = Time::now();
    	
    	// Encrypt the password with salt
    	$_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);
    	
    	// This is how we will determine if the user is logged in
    	// Create an encrypted token via their email address and a random string
    	$_POST['token'] = sha1(TOKEN_SALT.$_POST['email'].Utils::generate_random_string());
    	
		// Using Helper function to check for duplicate emails
    	$unique = $this->unique_email();
    	
    	if(!$unique) {
    	// Setup view
        $this->template->content = View::instance('v_users_signup');
        #$this->template->title   = "Signup";
        #$this->template->body_id = 'signup';

    	// Pass data to the view
    	$this->template->content->error = true;

    	// Render template
        echo $this->template;
        #echo "This is the login page";
        
    		// Send them back to the signup page
        	// Signin failed ... maybe give 'forgot password' option to reset password.
        	//echo "You already have an account";
        	//Router::redirect("/users/signup/error");
    	
    	} else {
    	
        // Insert this user into the database
    	$user_id = DB::instance(DB_NAME)->insert('users', $_POST);
    	
    	// In class additions ???
    	#DB::instance(DB_NAME)->insert_row('users', $_POST):
    	
    	// For now, just confirm they've signed up - 
    	// You should eventually make a proper View for this
    	#echo 'You\'re signed up'; 
    	
    	// Send them to the login page
    	Router::redirect('/users/login');
    	}
    	
    }

	/*-------------------------------------------------------------------------------------------------
	LOGIN
	-------------------------------------------------------------------------------------------------*/

    public function login($error = NULL) {
    	
    	/* Code for controller specific css and js place in _v 
        // Create an array for all the client files
        // Method inside the utilities library to help with this
        $client_files_head = Array(
            '/css/master.css'
        );
            
        // Use load_client_files to generate the links from the above array
        $this->template->client_files_head = Utils::load_client_files($client_files_head);    
        
        // Create an array of 1 or many client files to be included before the closing </body> tag
        $client_files_body = Array(
            '/js/widgets.min.js',
            '/js/profile.min.js'
        );
            
        // Use load_client_files to generate the links from the above array
        $this->template->client_files_body = Utils::load_client_files($client_files_body);
        */      
 
        // Setup view
        $this->template->content = View::instance('v_users_login');
        $this->template->title   = "Login";
        $this->template->body_id = 'login';

        	
    	// Pass data to the view
    	$this->template->content->error = $error;

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
        		WHERE email  = '".$_POST['email']."' 
        		AND password = '".$_POST['password']."'";
        	
		$token = DB::instance(DB_NAME)->select_field($q); 
        	
        // If we found a matching token, login succeeded! 
    	if($token) {
    	
    	    /* 
        	Store this token in a cookie using setcookie()
        	Important Note: *Nothing* else can echo to the page before setcookie is called
        	Not even one single white space.
        	param 1 = name of the cookie
        	param 2 = the value of the cookie
        	param 3 = when to expire
        	param 4 = the path of the cooke (a single forward slash sets it for the entire domain)
        	*/
        	
        	// ToDo: Authenticate by checking the browser for this cookie and if it exists we know they're logged in
        	setcookie("token",$token, strtotime('+2 weeks'), '/');

        	// Send them to the main page - or whever you want them to go
        	// This is the index page ... maybe send them to posts.php
        	Router::redirect("/posts/add");
        	
        	#echo '<pre>';
			#print_r($this->user);
			#echo '</pre>';
        
        // But if we didn't, login failed
    	} else {

        	// Send them back to the login page
        	// Login failed ... maybe give 'forgot password' option to reset password.
        	Router::redirect("/users/login/error");
    	}
    	
    }
    
	/*-------------------------------------------------------------------------------------------------
	LOGOUT
	-------------------------------------------------------------------------------------------------*/

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
    
        public function edit() {
    
        echo "This is the edit user page";
    }
    
	/*-------------------------------------------------------------------------------------------------
	PROFILE
	-------------------------------------------------------------------------------------------------*/
    
    public function profile($user_name = NULL) {
    
    	// Don't have to do this because it's already in the base_controller
    	#$template = View::instance('_v_template');
    	
    	// If user is blank, they're not logged in; redirect them to the login page
    	if(!$this->user) {
        	Router::redirect('/users/login');
    	}

    	// If they weren't redirected away, continue:
    	
    	/*
    	If you look at _v_template you'll see it prints a $content variable in the <body>
    	Knowing that, let's pass our v_users_profile.php view fragment to $content so 
    	it's printed in the <body>
    	*/

    	// Pass our view fragment to the master template content
    	// Set up the View (see Cheat Sheet)
    	$this->template->content = View::instance('v_users_profile');
    	// Set page title
    	$this->template->title = "Profile of".$this->user->first_name;
    	    	
    	// Pass information to the view fragment
    	$this->template->content->user_name = $user_name;
    	// Set the body id for the highlightnavigation.js
    	$this->template->body_id = 'profile'; 
    	
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
