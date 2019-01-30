<?php
    include("includes/classes/Account.php");
    include("includes/config.php");
    include("includes/classes/Constants.php");
    
    $account = new Account($con);
    
    include("includes/handlers/register-handler.php");
    include("includes/handlers/login-handler.php");
 
    function getInputValue($name) {
        if(isset($_POST[$name])) {
            echo $_POST[$name];
        }
    }
?>

<html>
<head>
    <title>Welcome to Stacatto!</title>

    <link rel="stylesheet" href="assets/css/register.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="assets/js/register.js"></script>
</head>
<body>
    <?php
        if (isset($_POST['registerButton'])) {
            echo '<script>
                    $(document).ready(function() {
                        $("#registerForm").hide();
                        $("#loginForm").show(); 
                    });
                </script>';
            
        }
        else {
            echo '<script>
                    $(document).ready(function() {
                        $("#registerForm").show();
                        $("#loginForm").hide(); 
                    });
                </script>';
        }
    ?>
    

    <div id="background">

        <div id="loginContainer">

            <div id="inputContainer">

                <form id="loginForm" action="register.php" method="POST">
                    <h2>Login to your account</h2>
                    <p>
                        <?php echo $account->getError(Constants::$loginFailed); ?>
                        <label for="loginUsername">Username</label>
                        <input id="loginUsername" name="loginUsername" type="text" placeholder="e.g. HomerJSimpson" required>
                    </p>
                    <p>
                        <label for="loginPassword">Password</label>
                        <input id="loginPassword" name="loginPassword" type="password" placeholder="Your password" required> 
                    </p>
                    <button type="submit" name="loginButton">LOG IN</button>
                    <div class="hasAccountText">
                        <span id=hideLogin>Don't have an account yet? Signup here.</span>
                    </div>
                </form>

                <form id="registerForm" action="register.php" method="POST">
                    <h2>Create your free account</h2>
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
                        <input id="email" name="email" type="email" placeholder="e.g. homer@gmail.com" value="<?php getInputValue('email') ?>" required>
                    </p>
                
                    <p>
                        <label for="email2">Confirm Email</label>
                        <input id="email2" name="email2" type="email" placeholder="e.g. homer@gmail.com" value="<?php getInputValue('email2') ?>" required>
                    </p>
                
                    <p>
                        <?php echo $account->getError(Constants::$passwordsDoNotMatch); ?>
                        <?php echo $account->getError(Constants::$passwordNotAlphanumeric); ?>
                        <?php echo $account->getError(Constants::$passwordLength); ?>
                        <label for="pw">Password</label>
                        <input id="pw" name="pw" type="password" placeholder="Your password" required> 
                    </p>

                    <p>
                        <label for="pw2">Confirm Password</label>
                        <input id="pw2" name="pw2" type="password" placeholder="Your password" required> 
                    </p>

                    <button type="submit" name="signUpButton">Sign Up</button>

                    <div class="hasAccountText">
                        <span id=hideRegister>Already have an account? Log in here</span>
                    </div>

                </form>

            </div>

            <div id="loginText">
                <h1>Get great music, right now</h1>
                <h2>Listen to loads of songs for free</h2>

                <ul>
                    <li>Discover music you'll fall in love with</li>
                    <li>Create your own playlists</li>
                    <li>Keep up to date with hot artists</li>
                </ul>

        </div>

    </div>

</body>
</html>