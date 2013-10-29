<?php if(isset($_GET['partial-registration'])): ?>
<div class="alert alert-danger fade in">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <strong><i class="icon-warning-sign"></i> I am unable to process your registration!</strong>  Please enter in all the appropriate information to continue. 
</div>
<?php endif; ?>

<?php if(isset($_GET['email-error'])): ?>
<div class="alert alert-danger fade in">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <strong><i class="icon-warning-sign"></i> I am unable to process your registration.  Your E-mail Address is not correct!</strong>  <br />Please used a standard email convention. i.e: name@domain.com
</div>
<?php endif; ?>

<?php if(isset($_GET['user-created'])): ?>
<div class="alert alert-success fade in">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <strong><i class="icon-warning-sign"></i> Your user has been created!</strong>  Login to continue. 
</div>
<?php endif; ?>

<?php if(isset($_GET['password-match'])): ?>
<div class="alert alert-danger fade in">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <strong><i class="icon-warning-sign"></i> Your password don't match!</strong>  Please try your registration again.
</div>
<?php endif; ?>


<div class="jumbotron">


<h2 class="form-signin-heading">Register for a <?=APP_NAME;?> Account</h2>

<form method='POST' action='/users/p_signup'>

	<label><small>Your First Name</small></label>
    <input type="text" name="first_name" class="form-control" placeholder="First Name" autofocus="">

	<label><small>Your Last Name</small></label>
    <input type="text" name="last_name" class="form-control" placeholder="Last Name">

	<label><small>Your Email Address</small></label>
    <input type="text" name="email" class="form-control" placeholder="Last Name" >

	<label><small>Your Password</small></label>
    <input type="password" name="password" class="form-control" placeholder="Your Password">

	<label><small>Confirm Your Password</small></label>
    <input type="password" name="password_check" class="form-control" placeholder="Your Password"><br />


	<button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>

</form>

</div>