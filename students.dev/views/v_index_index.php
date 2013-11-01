<!DOCTYPE html>
<html>
<body>

<div class="container">
<a href="/"><img src="/images/musings_logo.png" alt="Musings Logo—thought bubble"/></a>
<h1>Welcome to <?=APP_NAME?><?php if($user) echo ', '.$user->first_name; ?></h1><br>
<p>A place to conduct intelligent exchanges about interesting ideas.</p><br>
<br> 

<div class="buttonLinks">
<a href="/users/login"><img src="/images/logInButton.png" onmouseover="this.src='/images/logInHover.png'" onmouseout="this.src='/images/logInButton.png'"alt="Log In Button" width="150" height ="150"></a>
</div>

<div class="signup">
<?=$users_signup?>
</div>
</div>

</body>
</html>