<?php
class users_controller extends base_controller {

    public function __construct() {
        parent::__construct();
    } 
	
	 public function index() {
        echo "This is the index page";
    }
	
	
	public function test() {
		
		$imageObj = new Image(APP_PATH.'/images/picture/38.jpg');
         $imageObj->resize(150,150,'crop');
         $imageObj->save_image(APP_PATH.'/images/picture/38.jpg');
		
	}
	
	# Sign up function

	public function signup($error = Null) {

        # Setup view
            $this->template->content = View::instance('v_users_signup');
            $this->template->title   = 'Sign Up';
			
		# Pass data to the view
		$this->template->content->error = $error;

        # Render template
            echo $this->template;
	}
	
	# Process signup

	public function p_signup() {
		
		# Sanitize Data Entry
    	$_POST = DB::instance(DB_NAME)->sanitize($_POST);
		
		# Set up Email / Password Query
    	$q = "SELECT * FROM users WHERE email = '".$_POST['email']."'"; 
		
		# Query Database
    	$user_exists = DB::instance(DB_NAME)->select_rows($q);
    	
    	# Check if email exists in database
    		if(!empty($user_exists)){
    		
    			# Send to Login page
    			# needs to pass some error message along...
	    		Router::redirect('/users/login/user-exists');
    		}
			
			
    		
    		else {
	    		
		    	# Mail Setup
				$to = $_POST['email'];
				$subject = "Welcome to All Things European!";
				$message = "Thanks for signing up to our Blog, login at p2.allthingseuropean.com and your Blog.";
				$from = 'ladams@allthingseuropean.com';
				$headers = "From:" . $from;         
	    		
	    		# More data we want stored with the user
				$_POST['created'] = Time::now();
				$_POST['modified'] = Time::now();
    	
				# Encrypt password
				$_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);
    	
				# Create encrypted token via email and random string
				$_POST['token'] = sha1(TOKEN_SALT.$_POST['email'].Utils::generate_random_string());
    	
				# Insert this user into the database
				$user_id = DB::instance(DB_NAME)->insert('users', $_POST);
    	
				# Send Email
                if(!$this->user) {
	            	mail($to, $subject, $message, $headers);
                }         
    	
				# Send to the login page
				//Router::redirect('/users/login');
			}
   
	
	# Upload image
	   if ($_FILES['picture']['error'] == 0) {
            
            $picture = Upload::upload($_FILES, "/images/picture/", array('jpg', 'jpeg', 'gif', 'png'), $user_id);
 
            if($picture == 'Invalid file type.') {
                
                # Error
                Router::redirect('/users/profile/error'); 
            }
            
            else {
                
                # Upload Image
                $data = Array('picture' => $picture);
                DB::instance(DB_NAME)->update('users', $data, 'WHERE user_id = '.$user_id);
                
              
                # Resize and Save Image
                $imageObj = new Image($_SERVER['DOCUMENT_ROOT'].'/images/picture/'.$picture);
                $imageObj->resize(150,150,'crop');
                $imageObj->save_image($_SERVER['DOCUMENT_ROOT'].'/images/picture/'.$picture);
                
                
            }
        }
        
        else {
        
            # Error
            Router::redirect("/users/profile/error");  
        }
 
        # Send to Profile Page
        Router::redirect('/users/profile'); 
    } 
	
	
	  public function login($error = NULL) {
        
        # Setup view
        $this->template->content = View::instance('v_users_login');
        $this->template->title   = "Login";

        # Pass data to the view
        $this->template->content->error = $error;

        # Render template
        echo $this->template;

    }
	

	public function p_login() {
	
	# Sanitize the user entered data to prevent any funny-business (re: SQL Injection Attacks)
    $_POST = DB::instance(DB_NAME)->sanitize($_POST);

    # Hash submitted password so we can compare it against one in the db
    $_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);

    # Search the db for this email and password
    # Retrieve the token if it's available
    $q = "SELECT token 
        FROM users 
        WHERE email = '".$_POST['email']."' 
        AND password = '".$_POST['password']."'";

    $token = DB::instance(DB_NAME)->select_field($q);

    # If we didn't find a matching token in the database, it means login failed
    if(!$token) {

    # Send them back to the login page if there is an error
    Router::redirect("/users/login/invalid-login");

    # But if we did, login succeeded! 
    } else {

       # Sets cookie for two weeks
        setcookie("token", $token, strtotime('+2 weeks'), '/');

        # Send them to the profile page
        Router::redirect("/users/profile");

    }
		}
	

	public function logout() {
		
	# Sanitize Data Entry
    $_POST = DB::instance(DB_NAME)->sanitize($_POST);

    # Generate and save a new token for next login
    $new_token = sha1(TOKEN_SALT.$this->user->email.Utils::generate_random_string());

    # Create the data array we'll use with the update method
    # In this case, we're only updating one field, so our array only has one entry
    $data = Array("token" => $new_token);

    # Do the update
    DB::instance(DB_NAME)->update("users", $data, "WHERE token = '".$this->user->token."'");

    # Delete their token cookie by setting it to a date in the past - effectively logging them out
    setcookie("token", "", strtotime('-2 weeks'), '/');

    # Send them back to the main index.
    Router::redirect("/");

	}
	
	public function profile($error = NULL) {
		
	# Sanitize Data Entry
    $_POST = DB::instance(DB_NAME)->sanitize($_POST);
		
	# If user is blank, they're not logged in; redirect them to the login page
    if(!$this->user) {
    Router::redirect('/users/login');
    }
    
    $this->template->content = View::instance('v_users_profile');

    # $title is another variable used in _v_template to set the <title> of the page
    $this->template->title = "Profile of".$this->user->first_name;
	
	# Query
            $q = "SELECT *
                FROM posts 
                WHERE user_id = ".$this->user->user_id;

        # Run the query, store the results in the variable $posts
        $posts = DB::instance(DB_NAME)->select_rows($q);

        # Pass data to the View
        $this->template->content->posts = $posts;


    # Pass information to the view fragment
    #$this->template->content->user_name = $user_name;

    # Render View
    echo $this->template;

	}

} # eoc