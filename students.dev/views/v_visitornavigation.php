<!-- Menu options for users who are not logged in -->
<form action='/users/p_login' method='POST'>
    <fieldset >
        <legend>Sign In</legend>
        <input type='hidden' name='timezone' value='' >
        <ul>
            <li>
                <label for="email-login" >Email address</label>
                <input type='text' name='email' value='' id='email-login' autofocus tabindex='1' size='20'>
            </li>
            <li>
                <label for="password-login" >Password</label>
                <input type='password' name='password' value='' id='password-login' tabindex='2' size='20'>
            </li>
            <li>
                <input type='submit' name ='log-in' value='Log in' id='log-in' tabindex="3">
            </li>
        </ul>
    </fieldset>
</form>