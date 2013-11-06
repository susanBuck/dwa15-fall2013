<div id="content">

	<h1>Profile Status</h1>

    <?php if($user): ?> 
   	<h2>You are logged as <?=$user->first_name?> <?=$user->last_name?></h2><br>
    <h3>
    	User ID: <?=$user->user_id?><br>
        Email: <?=$user->email?><br>
    	Country: <?=$user->country?><br>
        Picture: <?=$user->picture?><br>
         <img src="/images/picture/<?=$user->picture; ?>" class='profile'>
        </h3>
	
	<?php else: ?>
   	<h2>You are NOT logged in!</h2>
	<?php endif; ?> <br>
</div>
