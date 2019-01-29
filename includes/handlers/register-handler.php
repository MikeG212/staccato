<?php

function sanitizePassword($inputText) {
    $inputText = strip_tags($inputText);
    return $inputText;
}

function sanitizeFormUsername($inputText) {
    $inputText = strip_tags($inputText);
    $inputText = str_replace(" ", "", $inputText);
    return $inputText;
}

function sanitizeFormString($inputText) {
    $inputText = strip_tags($inputText);
    $inputText = str_replace(" ", "", $inputText);
    $inputText = ucfirst(strtolower($inputText));
    return $inputText;
}


if(isset($_POST['signUpButton'])) {
    echo "sign up button was pressed";
    $username = sanitizeFormUsername($_POST['signUpUsername']);
    $firstName = sanitizeFormString($_POST['firstName']);    
    $lastName = sanitizeFormString($_POST['lastName']);    
    $email = sanitizeFormString($_POST['email']);    
    $email2 = sanitizeFormString($_POST['email2']);    
    $password = sanitizePassword($_POST['pw']);    
    $password2 = sanitizePassword($_POST['pw2']);

    $wasSuccessful = $account->register($username, $firstName, $lastName, $email, $email2, $password, $password2);

    if($wasSuccessful) {
        header("Location: index.php");
    }
}

?>