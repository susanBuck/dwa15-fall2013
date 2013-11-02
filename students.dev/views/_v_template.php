<!DOCTYPE html>
<html>
<head>
	<title><?php if(isset($title)) echo $title; ?></title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
					
	<!-- Controller Specific JS/CSS -->
	<?php if(isset($client_files_head)) echo $client_files_head; ?>
	<!--css here-->
</head>

<body>	
	<div id='menu'>
		<a href='/'>Home</a>

		<!-- Menu for users who are logged in-->
		<?php if($user): ?>
			<a href='/users/logout'>Logout</a>
			<a href='/users/profile'>Profile</a>

		<!-- Menu for users who are not logged in-->
		<?php else: ?>
			<a href='/users/signup'>Sign up</a>
			<a href='/users/login'>Log in</a>

		<?php endif; ?>
	</div>


	<?php if(isset($content)) echo $content; ?>

	<?php if(isset($client_files_body)) echo $client_files_body; ?>
	<!--javascript at end of body-->

</body>
</html>