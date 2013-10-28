
     
    <h2>Hello <?=$user->first_name?></h2>
      
         
    <p>Here's where you can edit your profile! </p>
         
    <h2>Edit details</h2>
    
	<form method='POST' action='/users/p_edit'>

    	First Name<br>
    	<!--<input type='text' name='first_name' value='<?php if(isset($_POST['first_name'])) echo $_POST['first_name']?>'>-->
		<input type='text' name='first_name' value='<?=$user->first_name?>'>    
		<br><br>
        
    	Last Name<br>
		<!--<input type='text' name='last_name' value='<?php if(isset($_POST['last_name'])) echo $_POST['last_name']?>'>-->
		<input type='text' name='last_name' value='<?=$user->last_name?>'>    
    	<br><br>
    
    	Email<br>
		<input type='text' name='email' value='<?=$user->email?>'>    
    	<br><br>
    
    	<?php if($unique == false): ?>
        	<div class='error'>
            	Edit failed. This email is taken.
        	</div>
        
        	<br>
        
    	<?php endif; ?>

    	Password<br>
		<input type='password' name='password'>    
    	<br><br>
    	
    	Do you have a website you'd like to share?<br>
		<input type='text' name='website' value='<?php if(isset($_POST['website'])) echo $_POST['website']?>'>
    	<br><br>

    	<input type='submit' value='Edit Profile'>

	</form>     
    	<br><br>
        <p>Your profile has been saved!</p>
         
 
