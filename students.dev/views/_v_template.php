<!DOCTYPE html>
<html>
<head>
	<title><?php if(isset($title)) echo $title; ?></title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	

	<!-- Common CSS/JSS -->
	<link rel="stylesheet" href="/css/app.css" type="text/css">
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
					
	<!-- Controller Specific JS/CSS -->
	<?php if(isset($client_files_head)) echo $client_files_head; ?>
	
</head>

<body>	
	<div class = "container">
	<div id="menu">
	<?php if($user): ?>
		<a href="/users"><img src="/images/Home.png" onmouseover="this.src='/images/HomeHover.png'" onmouseout="this.src='/images/Home.png'" alt="Link to Home" width="125" height ="125"></a>
	   <a href="/users/profile"><img src="/images/profileButton.png" onmouseover="this.src='/images/profileButtonHover.png'" onmouseout="this.src='/images/profileButton.png'" alt="My Profile" width="125" height ="125"></a>
	   <a href="/posts/add"><img src="/images/addPostButton.png" onmouseover="this.src='/images/addPostHover.png'" onmouseout="this.src='/images/addPostButton.png'" alt="Add a Post" width="125" height ="125"></a>
	   <a href="/posts/users"><img src="/images/otherUsersButton.png" onmouseover="this.src='/images/otherUsersHover.png'" onmouseout="this.src='/images/otherUsersButton.png'" alt="See Other Users" width="125" height ="125"></a>
	   <a href="/posts/index"><img src="/images/otherPostsButton.png" onmouseover="this.src='/images/otherPostsHover.png'" onmouseout="this.src='/images/otherPostsButton.png'" alt="See Other Posts" width="125" height ="125"></a>
	   <a href="/users/logout"><img src="/images/logOutButton.png" onmouseover="this.src='/images/logOutHover.png'" onmouseout="this.src='/images/logOutButton.png'" alt="Log Out" width="125" height ="125"></a>

	<?php else: ?>
	   
			 
	<?php endif; ?>
	</div>
	
	<br> 

	<?php if(isset($content)) echo $content; ?>

	<?php if(isset($client_files_body)) echo $client_files_body; ?>
</container>

<div class="footer">
<p>copyright 2013, Aimee Gonzalez.</p>
</div>
</body>
</html>