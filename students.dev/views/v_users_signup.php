<form method='POST' action='/users/p_signup'>

    First Name<br>
    <input type='text' name='first_name' value='<?php if(isset($_POST['first_name'])) echo $_POST['first_name']?>'>
    <br><br>
    
    Last Name<br>
	<input type='text' name='last_name' value='<?php if(isset($_POST['last_name'])) echo $_POST['last_name']?>'>
    <br><br>
    
    Email<br>
    <input type='text' name='email'>
    <br><br>
    
    <?php if($unique == false): ?>
        <div class='error'>
            Signup failed. You already have an account.
        </div>
        <br>
        
    <?php endif; ?>

    Password<br>
    <input type='password' name='password'>
    <br><br>

    <?php if(isset($error)): ?>
        <div class='error'>
            Please fill in all fields!.
        </div>
        <br>
        
    <?php endif; ?>
    
    <input type='submit' value='Sign up'>

</form>

