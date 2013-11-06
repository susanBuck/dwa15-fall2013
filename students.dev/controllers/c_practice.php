<?php

class practice_controller extends base_controller {


    public function edit() {
    
    if(!$this->user) { 
    
    	// If user is blank, they're not logged in; redirect them to the login page
    	if(!$this->user) {
        Router::redirect('/users/login');
        
    // Load user from  DB
		$q = "SELECT *
			FROM ".$this->user."
			WHERE token = '".$this->token."'
			LIMIT 1";
			}
			
		$this->user = DB::instance(DB_NAME)->select_row($q, "object");
		
		echo $q;    
    	
        echo "This is the edit user page";
        }

    }
    
    public function p_edit() {
    
    	// Set error at default state
    	$error = false;

		if(!$_POST) {
			Router::redirect('/users/edit');
			return;
		}
		# Otherwise...

		// Modify the $_POST array so it's ready to be inserted 
        // in the database (drop empty fields) 
		// Create an array ($valid_fields) to drop out empty fields and replace the $_POST
		$valid_fields = Array();
		
		// Loop through the POST data
		foreach($_POST as $field_name => $value) {
                
        	if(!(trim($value)=="")) {
        		$valid_fields[$field_name] = $value;
        	#echo $field_name."<br/>";
        	}
 		}
		#var_dump($valid_fields);
		#var_dump($_POST);
/**		
			if(!(trim($_POST['password'])=="")) {
 				unset($_POST['password']);
				}
				else {
		    		$valid_fields['password'] = sha1(PASSWORD_SALT.$_POST['password']);
			}
*/
		# Passed
		if($error==false) {
		// echo "No errors! At this point, you'd want to enter their info into the DB and redirect them somewhere else...";
			
		// Enter into DB
        
        // Add additional data
    	$valid_fields['modified'] = Time::now();  
    	
    	// Encrypt the password with salt
    	$valid_fields['password'] = sha1(PASSWORD_SALT.$_POST['password']);
    	
    	// Update database straight from the $_POST array, similar to insert in sign-up
		// And the additional parameters are the WHERE clause 
		// to make sure the correct user is updated
		DB::instance(DB_NAME)->update('users', $valid_fields, "WHERE user_id =" .$this->user->user_id);

    	// Code here to redirect them somewhere else
    				
		}	
		else {
    	// Send them to the ... page
    	#Router::redirect('/users/profile');			
    	#echo $this->template;
		}

    }
    
	/*-------------------------------------------------------------------------------------------------
	Demonstrating 
	-------------------------------------------------------------------------------------------------*/
	
	public function profile_update() {
	
	
	$q = "UPDATE users
			Set first_name = '".$_REQUEST['firstname']."'
			WHERE email = '".$this->user->email."'";
			
	#Run the command
	DB::instance(DB_NAME)->query($q);
	echo "First name updated";		
	
	}

	/*-------------------------------------------------------------------------------------------------
	Demonstrating 
	-------------------------------------------------------------------------------------------------*/
	public function display_profile() {
	
    $q = "SELECT * 
        	FROM users
        	WHERE user_id = ".$this->user->user_id;
			
	// echo a query is a useful debugging technique
	#echo $q;
		
	// Run the query, echo what it returns	
	echo DB::instance(DB_NAME)->select_field($q);
	
	}

	/*-------------------------------------------------------------------------------------------------
	Demonstrating sample method
	-------------------------------------------------------------------------------------------------*/
	public function test_db() {
	
	// Notes: protect against sql injection attachs
	// INSERT PRACTICE
	/*$q = 'INSERT INTO users
		SET first_name = "Albert",
		last_name = "Einstein"';
	// echo a query is a useful debugging technique		
	echo $q;
	DB::instance(DB_NAME)->query($q);*/
	
	
	/*// UPDATE PRACTICE manual way of running a query
	$q ='UPDATE users
		SET email = "albert@aol.com"
		WHERE first_name = "Albert"';
	
	echo $q;
	
	// All sql queries go through this method
	DB::instance(DB_NAME)->query($q);*/
	
	/*// INSERT PRACTICE using the query builder
	$new_user = Array (
		'first_name' => 'Albert',
		'last_name' => 'Einstein',
		'email' => 'albert@gmail.com',
	);
	
	echo $q;
	
	DB::instance(DB_NAME)->insert('users',$new_user);*/
	
	
	// Lets pretend this is data we got from a form
	$_POST['first_name'] = 'Albert';
	
	//Make sure it's sanitized first
	$_POST = DB::instance(DB_NAME)->sanitize($_POST);
	
	$q = 'SELECT email
			FROM users
			WHERE first_name = "'.$_POST['first_name'].'"';
	// echo a query is a useful debugging technique
	echo $q;
		
	// Run the query, echo what it returns	
	echo DB::instance(DB_NAME)->select_field($q);
	
	}
	
	/*-------------------------------------------------------------------------------------------------
	Demonstrating an alternative way to handle signup errors.
	In this method, we're submitting the signup form to itself.
	-------------------------------------------------------------------------------------------------*/
	public function signup() {
	
	# Set up view
	$this->template->content = View::instance('v_practice_signup');
	
	# Innocent until proven guilty
	$error = false;
	
	# Initiate error
	$this->template->content->error = '<br>';
	
	# If we have no post data (i.e. the form was not yet submitted, 
	# just display the View with the signup form and be done
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
		echo "No errors! At this point, you'd want to enter their info into the DB and redirect them somewhere else...";
		/*
		Code here to enter into DB
		Code here to redirect them somewhere else
		*/
	}
	else {
		echo $this->template;
	}
 
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
	
  	public function test1(){
    	#require(APP_PATH.'/libraries/image.php');
    	#echo "testing!";
    	$imgObj = new Image('images/placeholder.png');
       	$imgObj->resize(200, 200);
    	$imgObj->display();
    	
  	}

	
	public function test2() {
	
		// Static ... didn't have to instantiate it i.e., $timeObj = new Time();
		echo Time::now();
	
	}
	
	public function test3() {
	
	# Our SQL command
	$q = "INSERT INTO users SET 
    		first_name = 'Sam', 
    		last_name = 'Seaborn',
    		email = 'seaborn@whitehouse.gov'";

	# Run the command
	echo DB::instance(DB_NAME)->query($q);
	}

	// Our Update SQL command
	public function test4() {
	$q = "UPDATE users
    		SET email = 'samseaborn@whitehouse.gov'
    		WHERE email = 'seaborn@whitehouse.gov'";

	# Run the command
	echo DB::instance(DB_NAME)->query($q);
	}
	
	// Our Delete SQL command
	public function test5() {
	$q = "DELETE FROM users
    		WHERE email = 'sam@whitehouse.gov'";

	# Run the command
	echo DB::instance(DB_NAME)->query($q);
	}
	
	/*-------------------------------------------------------------------------------------------------
	Testing email on live server with not SMTP settings
	-------------------------------------------------------------------------------------------------*/
	public function test_email() {
		echo Utils::alert_admin('Testing email from live server', '');
	}
	
	/*-------------------------------------------------------------------------------------------------
	Demonstrating two different ways to render a view
	-------------------------------------------------------------------------------------------------*/
	public function test_render() {
		
		# Setup view
			$this->template->content = View::instance('v_index_index');
			
		# Render template
		# Either one of these works
			#echo $this->template;
			echo $this->template->render();
		
	}
	
	/*-------------------------------------------------------------------------------------------------
	Demonstrating PHP Warning when a param is not defaulted and not passed
	-------------------------------------------------------------------------------------------------*/
	public function test_not_null_var($message) {
		
		if($message != NULL) {
			echo $message;
		}
		
	}
	
	/*-------------------------------------------------------------------------------------------------
	Demonstrating vague MySQL errors on live server
	-------------------------------------------------------------------------------------------------*/
	public function test_db_error() {
		
		$q = "SELECT * FROM posts";
		echo DB::instance(DB_NAME)->select_rows($q);
	}
	
	/*-------------------------------------------------------------------------------------------------
	Time tests
	-------------------------------------------------------------------------------------------------*/
	public function test_time() {
	
		$full_moon = 1326119760; # Jan 9, 2012 07:30 GMT

		# Shows the time in your app's timezone
		echo "<br>App TZ: ".Time::display($full_moon);
	
		# Hard code in the timezone you want to display
		echo "<br>Los Angeles TZ: ".Time::display($full_moon, '', 'America/Los_Angeles');
		
		# Or, assuming you know your user's timezone, pass it in as a variable
		//echo "<br>User's TZ: ".Time::display($full_moon, '', $this->user->timezone);
		
	}		

}  # eoc

