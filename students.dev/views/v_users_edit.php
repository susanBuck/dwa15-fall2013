<!-- This is already covered in the Profile page
	<h2>Hello <?=$user->first_name?></h2>
-->
    <h2>You can edit your profile here if you like. </h2>
             
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
    
            <?php if(isset($error)): ?>
                <div class='error'>
                    This email is taken.<br>
                    Use this field only if you are changing your email.
                </div>
                <br>
        
            <?php endif; ?>

            Password<br>
                <input type='password' name='password'>    
            	<br><br>
            
                Do you have a website you'd like to share? Please include http(s):// with your website name.<br>
                <input type='text' name='website' value='<?php if(isset($_POST['website'])) echo $_POST['website']?>'>
            	<br><br>

            <input type='submit' value='Edit Profile'>

        </form>     
