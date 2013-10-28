<div id="indexcontent">

  <div id="welcomediv">
    <h1> Welcome to <span class="appname"> Small Talk </span> </h1>
    <ul>
        <li>
            <h3> Create a platform to voice your opinions. </h3>
        </li>
        <li>
            <h3> Take a stance, make an impact. </h3>
        </li>
        <li>
            <h3> Rally together for a cause. </h3>
        </li>
        <li>
            <h3> Learn from each other. </h3>
        </li>
        <li>
            <h3> Provide status updates. </h3>
        </li>
        <li>
            <h3> And above all have fun! </h3>
        </li>
    </ul>
  </div>

  <div id="signupdiv">
    <form method='POST' action='/users/p_signup'>

        First Name<br>
        <input type='text' name='first_name'>
        <br><br>

        Last Name<br>
        <input type='text' name='last_name'>
        <br><br>

        Email<br>
        <input type='text' name='email'>
        <br><br>

        Password<br>
        <input type='password' name='password'>
        <br><br>

        <input type='submit' value='Sign up'>
        
        <input type='hidden' name='timezone'>

    </form>
  </div>
</div>