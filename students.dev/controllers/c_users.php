<?php
class users_controller extends base_controller {

    public function __construct() {
        parent::__construct();
    } 

    public function index () {
	# check that there is an authenticated user logged in to be able to view dashboard 
		if(!$this->user) {
		die("Registered users only. <a href='/users/login'>Please Log In</a>"); 
		}
		else {
	$this->template->content = View::instance('v_users_index'); 
	$this->template->content = View::instance('v_own_posts'); 
	echo $this->template;  	
    		}
        }
    
    /* commenting out the sign up since it is on the index page as view fragment 
    # allow a new user to sign up 
    public function signup() {
        $this->template->content = View::instance('v_users_signup');
	$this->template->title = "Sign Up"; 
	echo $this->template; 
    }
    */

    # process the sign up submission, add to database
    public function p_signup() {
	$_POST['created'] = Time::now();
	$_POST['modified'] = Time::now(); 
	$_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);
	$_POST['token'] = sha1(TOKEN_SALT.$_POST['email'].Utils::generate_random_string());
 	$user_id = DB::instance(DB_NAME)->insert('users', $_POST); 
	Router::redirect("/users/profile"); 
    }

    # allow a returning user to log in, if there is an error add the error message
    public function login($error = NULL) {
        $this->template->content = View::instance('v_users_login'); 
	$this->template->content->error = $error; 
	echo $this->template;
    }

    # process the log in, if the email and password match the token, set a cookie  
    # otherwise redirect back to login page with error message 
    public function p_login() {
	$_POST = DB::instance(DB_NAME)->sanitize($_POST);
	$_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);
	$q = "SELECT token
		FROM users
		WHERE email = '".$_POST['email']."'
		AND password = '".$_POST['password']."'";
	$token = DB::instance(DB_NAME)->select_field($q);
	if(!$token) {
		Router::redirect("/users/login/error");
	} else {
		setcookie("token", $token, strtotime('+1 week'), '/');
		Router::redirect("/users/profile"); 
	}
    }

    #assign a new token for next login, and remove cookie 
    public function logout() {
        $new_token = sha1(TOKEN_SALT.$this->user->email.Utils::generate_random_string());
	$data = Array("token" => $new_token); 
	DB::instance(DB_NAME)->update("users", $data, "WHERE token = '".$this->user->token."'"); 
	setcookie("token", "", strtotime('-1 week'), '/'); 
	Router::redirect("/"); 
    }

    # generate information to display user’s profile
    # if there is no user logged in redirect to login page 
    public function profile($user_name = NULL) {
	if(!$this->user) {
		Router::redirect('/users/login');
	}
	$this->template->content = View::instance('v_users_profile');
	$this->template->title = "Profile for ".$this->user->first_name;
	$client_files_head = Array(
		'/css/widgets.css',
		'/css/profile.css'
	);
	$this->template->client_files_head = Utils::load_client_files($client_files_head);
	$client_files_body = Array(
		'/js/widgets.min.js',
		'/js/profile.min.js' 
	);
	$this->template->client_files_body = Utils::load_client_files($client_files_body);
	$this->template->content->user_name = $user_name; 
	echo $this->template;
    }

} # end of the class