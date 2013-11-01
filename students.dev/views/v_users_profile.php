<?php if(isset($user)): ?> 
   <h1>This is the profile for <?=$user->first_name?></h1>
<?php else: ?>
   <h1>No user specified</h1>
<?php endif; ?> 

<p>Tell us about yourself!</p>

<br>
<br>
<br>
