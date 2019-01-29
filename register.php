<?php
    include("includes/classes/Account.php");
    include("includes/config.php");
    include("includes/classes/Constants.php");
    
    $account = new Account($con );
    
    include("includes/handlers/register-handler.php");
    include("includes/handlers/login-handler.php");
 
    function getInputValue($name) {
        if(isset($_POST[$name])) {
            echo $_POST[$name];
        }
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
           <?php echo $account->getError(Constants::$usernameLength); ?>
           <?php echo $account->getError(Constants::$usernameTaken); ?>
                <label for="signUpUsername">Username</label>
           <input id="signUpUsername" name="signUpUsername" type="text" placeholder="e.g. HomerJSimpson" value="<?php getInputValue('signUpUsername') ?>" required>
           </p>
            <p>
            <?php echo $account->getError(Constants::$firstNameLength); ?>
                <label for="firstName">First Name</label>
                <input id="firstName" name="firstName" type="text" placeholder="Homer" value="<?php getInputValue('firstName') ?>" required>
           </p>
           <p>
           <?php echo $account->getError(Constants::$lastNameLength); ?>
                <label for="lastName">Last Name</label>
                <input id="lastName" name="lastName" type="text" placeholder="Simpson" value="<?php getInputValue('lastName') ?>" required>
           </p>
           <p>
           <?php echo $account->getError(Constants::$emailsDoNotMatch); ?>
           <?php echo $account->getError(Constants::$emailInvalid); ?>
           <?php echo $account->getError(Constants::$emailTaken); ?>
                <label for="email">Email</label>
                <input id="email" name="email" type="email" placeholder="homer@gmail.com" value="<?php getInputValue('email') ?>" required>
           </p>
           <p>
                <label for="email2">Confirm Email</label>
                <input id="email2" name="email2" type="email" placeholder="homer@gmail.com" value="<?php getInputValue('email2') ?>" required>
           </p>
           <p>
           <?php echo $account->getError(Constants::$passwordsDoNotMatch); ?>
           <?php echo $account->getError(Constants::$passwordNotAlphanumeric); ?>
           <?php echo $account->getError(Constants::$passwordLength); ?>
                <label for="pw">Password</label>
                <input id="pw" name="pw" type="password" required> 
            </p>
            <p>
                <label for="pw2">Confirm Password</label>
                <input id="pw2" name="pw2" type="password" required> 
            </p>

            <button type="submit" name="signUpButton">Sign Up</button>
        </form>
    <div>
</body>
</html>