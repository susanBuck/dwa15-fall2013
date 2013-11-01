<?php 

class posts_controller extends base_controller {
	
	public function __construct() {
		parent::__construct(); 
	
	# check that there is an authenticated user logged in to be able to add a post 
	if(!$this->user) {
		die("Registered users only. <a href='/users/login'>Please Log In</a>"); 
	}

}
	# add a new post 
	public function add() {
		$this->template->content = View::instance('v_posts_add'); 
		$this->template->title = "New Post"; 
		
		echo $this->template; 
	}

	# process the submitted post 
	public function p_add(){
		$_POST['user_id'] = $this->user->user_id; 
		$_POST ['created'] = Time::now();
		$_POST['modified'] = Time::now(); 

		DB::instance(DB_NAME)->insert('posts', $_POST); 

		echo "Your post has been added. <a href='/posts/add'>Share another thought</a> or <a href='/posts/index'>See all posts</a>";
	}

	#delete an added post 
	public function p_delete(){
		$_POST['user_id'] = $this->user->user_id;
		$_POST['modified'] = Time::now(); 

		DB::instance(DB_NAME)->delete('posts', $_POST); 
	}

	# generate and show a list of followed users’ posts only 
	public function index() {
		$this->template->content = View::instance('v_posts_index'); 
		$this->template->title = "All Thoughts"; 

		$q = "SELECT 
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
		   WHERE users_users.user_id = ".$this->user->user_id; 

		$posts = DB::instance(DB_NAME)->select_rows($q); 
		$this->template->content->posts = $posts; 
		
		echo $this->template; 
	}

	#generate and show a list of user's own posts only 
	public function own() {
		$this->template->content = View::instance('v_own_posts'); 
		$this->template->title = "My Dashboard"; 

		$q = "SELECT 
			posts.content, 
			posts.created, 
			posts.user_id AS post_user_id,
		     FROM posts
		     WHERE user_id = ".$this->user->user_id;

		$posts = DB::instance(DB_NAME)->select_rows($q);
		$this->template->content->posts = $posts; 
		echo $this->template;
	}
	
	# generate and show a list of users
	public function users() {
		$this->template->content = View::instance("v_posts_users");
		$this->template->title = "Users"; 

		$q = "SELECT *
		      FROM users"; 

		$users = DB::instance(DB_NAME)->select_rows($q); 

		$q = "SELECT *
		      FROM users_users
		      WHERE user_id = ".$this->user->user_id; 

		$connections = DB::instance(DB_NAME)->select_array($q, 'user_id_followed'); 

		$this->template->content->users =       $users;
		$this->template->content->connections = $connections; 

		echo $this->template; 

	}

	# start following a user by creating a user to user relationship
	public function follow($user_id_followed) {
		$data = Array (
			"created" => Time::now(),
			"user_id" => $this->user->user_id, 
			"user_id_followed" => $user_id_followed
			); 

		DB::instance(DB_NAME)->insert('users_users', $data); 

		Router::redirect("/posts/users"); 
	
	}
	
	# stop following a user by deleting the user to user relationship
	public function unfollow($user_id_followed) {
		$where_condition = 'WHERE user_id = '.$this->user->user_id.' AND user_id_followed = '.$user_id_followed; 		

		DB::instance(DB_NAME)->delete('users_users', $where_condition); 

		Router::redirect("/posts/users"); 
	
	}
	
}