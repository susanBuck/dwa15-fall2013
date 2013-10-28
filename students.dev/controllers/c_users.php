<?php
class users_controller extends base_controller {

    public function __construct() {
        parent::__construct();
    } 

    public function index() {
        echo "This is the index page";
    }

    public function login() {
    
    	# Debugging
		echo "<div style='z-index:999; position:fixed; background-color:white'>";
    	foreach ($_GET as $key => $value){
			Debug::log($key."=>".$value);
		}
		echo "</div>";

        #login page used if the initial login from navigation bar fails

        # First, set the content of the template with a view file
        $this->template->content = View::instance('v_users_login');

        # Now set the <title> tag
        $this->template->title = "Login";

        # Create an array of 1 or many client files to be included in the head
        $client_files_head = Array('/css/forms.css');

        # Use load_client_files to generate the links from the above array
        $this->template->client_files_head = Utils::load_client_files($client_files_head);  

        # Render the view
        echo $this->template;
    }

    public function p_signup() {
        try {
            $this->user = $this->userObj->signup($_POST);
            if ($this->user) {
                Router::redirect('/profile/index');
            }
            else {
                Router::redirect('/index');
            }
        } 
        catch (Exception $e){
            $log = Log::instance(LOG_PATH."Users", Log::DEBUG, true);
            $log->LogError($e->getMessage());
        }
    }


    public function p_login() {

        Debug::log('timezone='.$POST['timezone'].'\n');

        $email = $_POST['email'];

        # Use the login method provided by the core framework
        $token = $this->userObj->login($email, $_POST['password'], $_POST['timezone'], $_SERVER['HTTP_USER_AGENT']);

        # Go to user appropriate page depending on login status
        $this->userObj->login_redirect($token, $email, '/users/index/');
        
    }


    public function logout() {

        # Generate and save a new token for next login
        $new_token = sha1(TOKEN_SALT.$this->user->email.Utils::generate_random_string());

        # Create the data array we'll use with the update method
        # In this case, we're only updating one field, so our array only has one entry
        $data = Array("token" => $new_token);

        # Do the update
        DB::instance(DB_NAME)->update("users", $data, "WHERE token = '".$this->user->token."'");

        # Delete their token cookie by setting it to a date in the past - effectively logging them out
        setcookie("token", "", strtotime('-1 year'), '/');

        #reset the $user object to null
        $this->template->set_global('user');

        # First, set the content of the template with a view file
        $this->template->content = View::instance('v_users_logout');

        # Now set the <title> tag
        $this->template->title = "Logout";

        # Render the view
        echo $this->template;
    }
} # eoc