<?php if(isset($_GET['empty-password'])): ?>
<div class="alert alert-danger fade in">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <strong><i class="icon-warning-sign"></i> The password you entered is empty!</strong>  Please try again!
</div>
<?php endif; ?>

<?php if(isset($_GET['password-match'])): ?>
<div class="alert alert-danger fade in">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <strong><i class="icon-warning-sign"></i> Your passwords don't match! </strong>  You can try again.
</div>
<?php endif; ?>

<?php if(isset($_GET['password-reset'])): ?>
<div class="alert alert-success fade in">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <strong><i class="icon-warning-sign"></i> Your user password has been changed!</strong>  Login to continue. 
</div>
<?php endif; ?>




<div class="jumbotron">

	<form class="form-signin" method="POST" action='/password/p_set/<?php echo $token; ?>'>
	
		<h2 class="form-signin-heading">Set Your New Password</h2>
	    
	    <label><small>New Password</small></label>
	    <input type="password" name="password" class="form-control" placeholder="Your New Password" autofocus="">
	
		<label><small>Confirm New Password</small></label>
	    <input type="password" name="password_check" class="form-control" placeholder="Confirm Your New Password"><br />
	    <button class="btn btn-lg btn-primary btn-block" type="submit">Reset My Password</button>
	
	</form>

</div>

