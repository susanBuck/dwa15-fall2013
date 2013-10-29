<?php if(isset($_GET['email-error'])): ?>
<div class="alert alert-danger fade in">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <strong><i class="icon-warning-sign"></i> The address you entered is invalid!</strong>  Please try again!
</div>
<?php endif; ?>

<?php if(isset($_GET['user-does-no-exists'])): ?>
<div class="alert alert-danger fade in">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <strong><i class="icon-warning-sign"></i> That user does not exist. </strong>  You can try again or <a class="alert-link" href="/users/signup/">register</a> as a new user.
</div>
<?php endif; ?>

<?php if(isset($_GET['password-reset'])): ?>
<div class="alert alert-success fade in">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <strong>Please check your email. </strong><br />We've sent you a link that will allow you to change your password.
</div>
<?php endif; ?>




<div class="jumbotron">

<form class="form-signin" method="POST" action='/password/p_reset'>

	<h2 class="form-signin-heading">Reset your Password</h2>
    
    <label><small>Enter in your Email Address</small></label>
    <input type="text" name="email" class="form-control" placeholder="Email address" autofocus="">
    	<br />
    <button class="btn btn-lg btn-primary btn-block" type="submit">Reset my Password</button>

</form>

</div>


    
</form>

