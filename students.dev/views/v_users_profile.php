<!-- Start Notices -->
<?php if(isset($_GET['profile-updated'])): ?>
<div class="alert alert-success fade in">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<strong><i class="icon-warning-sign"></i> Your profile has been successfully updated!</strong>
</div>
<?php endif; ?>
<?php if(isset($_GET['password-updated'])): ?>
<div class="alert alert-success fade in">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<strong><i class="icon-warning-sign"></i> Your password has been successfully updated!</strong>
</div>
<?php endif; ?>
<?php if(isset($_GET['password-match'])): ?>
<div class="alert alert-warning fade in">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<strong><i class="icon-warning-sign"></i> Your passwords don't match!</strong> Please try again.
</div>
<?php endif; ?>
<?php if(isset($_GET['empty-password'])): ?>
<div class="alert alert-warning fade in">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<strong><i class="icon-warning-sign"></i> Your Password is empty!</strong> Please try again, but this time fill something in.
</div>
<?php endif; ?>
<?php if(isset($_GET['login-success'])): ?>
<div class="alert alert-success fade in">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<strong><i class="icon-warning-sign"></i> You have successfully Logged in!</strong>
</div>
<?php endif; ?>
<?php if(isset($_GET['partial-form'])): ?>
<div class="alert alert-danger fade in">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<strong><i class="icon-warning-sign"></i> I was unable to update your profile!</strong> Please fill in all the appropriate information.
</div>
<?php endif; ?>
<!-- End Notices -->



<! -- Start Profile -->
<?php foreach ($user as $value): ?>

<h1>Welcome, <?php echo $value['first_name']; ?> <?php echo $value['last_name']; ?></h1>
<form method='POST' action='/users/p_profile'>
	<label><small>Your First Name</small></label>
	<input type="text" name="first_name" class="form-control" placeholder="Your First Name" value="<?php echo $value['first_name']; ?>">
	<label><small>Your Last Name</small></label>
	<input type="text" name="last_name" class="form-control" placeholder="Your Last Name" value="<?php echo $value['last_name']; ?>">
	<label><small>Your Email Address</small></label>
	<input type="text" name="email" class="form-control" placeholder="Your Email Address" value="<?php echo $value['email']; ?>" disabled><br />
	<button class="btn btn-primary" type="submit">Update My Profile</button> <a data-toggle="modal" href="#reset-password" class="btn btn-success " type="submit">Reset Password</a> 
</form>



	<!-- Start Password Reset Modal -->
	<div class="modal fade" id="reset-password">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Reset your password, <?php echo $value['first_name']; ?></h4>
				</div>
				<div class="modal-body">
					<form method="POST" action="/users/p_profile_password">
						<div class="form-group">
							<label for="password">New Password</label>
							<input type="password" name="password" required class="form-control">
						</div>
						<div class="form-group">
							<label for="password">Confirm New Password</label>
							<input type="password" name="password_check" required class="form-control">
						</div>
						<button class="btn btn-lg btn-primary btn-block" type="submit"><i class="icon-lock"></i> Change my Password</button>
					</form>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->


<?php endforeach; ?>
<! -- End Profile -->