<?php

if(isset($_POST['loginButton'])) {
    echo "login button was pressed";
}

if(isset($_POST['signUpButton'])) {
    echo "sign up button was pressed";
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome to Stacatto</title>
</head>
<body>
    <div id="inputContainer">
        <form id="loginForm" action="register.php" method="POST">
            <h2>Login to your account<h2>
           <p>
                <label for="loginUsername">Username</label>
           <input id="loginUsername" name="loginUsername" type="text" placeholder="e.g. HomerSimpson" required>
           </p>
           <p>
                <label for="loginPassword">Password</label>
           <input id="loginPassword" name="loginPassword" type="password" required> 
            </p>

            <button type="submit" name="loginButton">LOG IN</button>
        </form>

        <form id="registerForm" action="register.php" method="POST">
            <h2>Create your free account<h2>
           <p>
                <label for="signUpUsername">Username</label>
           <input id="signUpUsername" name="signUpUsername" type="text" placeholder="e.g. HomerJSimpson" required>
           </p>
            <p>
                <label for="firstName">First Name</label>
                <input id="firstName" name="firstName" type="text" placeholder="Homer" required>
           </p>
           <p>
                <label for="lastName">Last Name</label>
                <input id="lastName" name="lastName" type="text" placeholder="Simpson" required>
           </p>
           <p>
                <label for="email">Email</label>
                <input id="email" name="email" type="email" placeholder="homer@gmail.com" required>
           </p>
           <p>
                <label for="email2">Confirm Email</label>
                <input id="email2" name="email2" type="email" placeholder="homer@gmail.com" required>
           </p>
           <p>
                <label for="signUpPassword">Password</label>
                <input id="signUpPassword" name="signUpPassword" type="password" required> 
            </p>
            <p>
                <label for="signUpPassword2">Confirm Password</label>
                <input id="signUpPassword2" name="signUpPassword2" type="password" required> 
            </p>

            <button type="submit" name="signUpBottom">Sign Up</button>
        </form>
    <div>
</body>
</html>