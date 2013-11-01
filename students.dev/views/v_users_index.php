<?php if(isset($user)): ?> 
   <h1>This is <?=$user->first_name?>'s Dashboard</h1>
<?php else: ?>
   <h1>No user specified</h1>
<?php endif; ?> 

<p>Here are your recent posts</p>


<br>
<br>
<p>This is who you're currently following</p>
<?=$followed?>

