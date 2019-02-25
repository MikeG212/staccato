<?php
    if(isset($_POST['demoLogin'])) {
        echo "HELLO";
        $result = $account->login('HarryPotter', 'starwars');
        if($result) {
            $_SESSION['userLoggedIn'] = 'HarryPotter';
            header("Location: index.php");
        }
    }
?>