<?php

class posts_controller extends base_controller{

	public function __construct(){
		parent::__construct();

		#Make sure user is logged in if they want to use anything in this controller.

		if(!$this->user){
			die("Members only. Please <a href='/users/login'>Login</a>");
		}
	}
	public function add(){

		#Set up view
		$this ->template->content = View::instance('v_posts_add');
		$this->template->title = "New Post";

		#Render Template
		echo $this->template;
	}	
		
	public function p_add(){

		#Associate this post with this user
		$_POST['user_id'] = $this->user->user_id;

		#Unix timestamp for when post is created and modified
		$_POST['created']  = Time::now();
		$_POST['modified'] = Time::now();

		#Insert
		#We didn't have to sanitize any of the $_POST data because we're using the insert method which does it for us.
		DB::instance(DB_NAME)->insert('posts', $_POST);

		#Verify posting
		echo "Your post has been added. <a href='/posts/add'>Add another</a>";
	}

	public function users() {

		#Set up the view
		$this->template->content = View::instance("v_posts_users");
		$this->template->title   = "Users";

		#Build a query to get all of the users
		$q = "SELECT * FROM users";

		#Execute the query to get all of teh users.
		#Stor the resulting arraty in the variable $users
		$users = DB::instance(DB_NAME)->select_rows($q);

		#Build the query to figure outwhat connections the user already has
		$q = "SELECT * FROM users_users WHERE user_id = ".$this->user->user_id;

		#Execute this query with the select_array method.
		#The select_array will return ourresults in an array and use the "users_id Followed" field as the index.
		#This will come in handy when we get to the view. 
		#Store the results (an array) in teh variable $connections

		$connections = DB::instance(DB_NAME)->select_array($q, 'user_id_followed');

		#Pass data (users and connections) to the view
		$this->template->content->users 		= $users;
		$this->template->content->connections 	= $connections;

		#Render the view
		echo $this->template;
	}
		
	public function follow($user_id_followed) {
		#Prepare the dtat array to be inserted
		$data = Array(
			"created" => Time::now(),
			"user_id" => $this->user->user_id,
			"user_id_followed" => $user_id_followed
			);

		#Do the insert
		DB::instance(DB_NAME)->insert('users_users', $data);

		#Sent them back
		Router::redirect("/posts/users");
	}

	public function unfollow($user_id_followed) {

    	# Delete this connection
    	$where_condition = 'WHERE user_id = '.$this->user->user_id.' AND user_id_followed = '.$user_id_followed;
    	DB::instance(DB_NAME)->delete('users_users', $where_condition);

   		# Send them back
    	Router::redirect("/posts/users");

	}

	 public function index(){
	 	#Set up the view
	 	$this->template->content = View::instance('v_posts_index');
	 	$this->template->title = "Posts";

	 	#Build the query
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

            #Run the query
            $posts = DB::instance(DB_NAME)->select_rows($q);

            #Pass the data to the View
            $this->template->content->posts = $posts;

            #Render the view
            echo $this->template;

	 }

}# end of the class
	
