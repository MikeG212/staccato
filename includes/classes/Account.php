<?php
    class Account {

        private $con;
        private $errorArray;

        public function __construct($con) {
            $this->errorArray = array();
            $this->con = $con;
        }

        public function register($un, $fn, $ln,  $em, $em2, $pw, $pw2) {
            $this->validateUsername($un);
            $this->validateFirstName($fn);
            $this->validateLastName($ln);
            $this->validateEmails($em, $em2);
            $this->validatePasswords($pw, $pw2);

            if(empty($this->errorArray)) {
                //TODO: add to database
                return $this->insertUserDetails($un, $fn, $ln, $em, $pw);
            }
            else {
                return false;
            }
        }

        public function getError($error) {
            if(!in_array($error, $this-> errorArray)) {
                $error = "";
            }

            return "<span class='errorMessage'>$error</span>";
        }

        private function insertUserDetails($un, $fn, $ln, $em, $pw) {
            $passwordDigest = md5($pw);
            $profilePic = "assets/images/profile-pics/homer-silhouette.png";
            $date = date("Y-m-d");

            $result = mysqli_query($this->con, "INSERT INTO users VALUES ('', '$un', '$fn', '$ln', '$em', '$passwordDigest', '$date', '$profilePic')");
            return $result;
        }

        private function validateUsername($un) {
            // echo "username function called";

            if(strlen($un) > 25 || strlen($un) < 5) {
                array_push($this->errorArray, Constants::$usernameLength);
                return;
            }

            //TODO: check if username already exists in table
        }
        
        private function validateFirstName($fn) {
            if(strlen($fn) > 25 || strlen($fn) < 2) {
                array_push($this->errorArray, Constants::$firstNameLength);
                return;
            }

        }
        
        private function validateLastName($ln) {
            if(strlen($ln) > 25 || strlen($ln) < 2) {
                array_push($this->errorArray, Constants::$lastNameLength);
                return;
            }

        }
        
        private function validateEmails($em, $em2) {
            if($em != $em2) {
                array_push($this->errorArray, Constants::$emailsDoNotMatch);
                return;
            }

            if(!filter_var($em, FILTER_VALIDATE_EMAIL)) {
                array_push($this->errorArray, Constants::$emailInvalid);
                return;
            }

            //TODO: Check that it hasn't already been used

        }
        
        private function validatePasswords($pw, $pw2) {
            if($pw != $pw2) {
                array_push($this->errorArray, Constants::$passwordsDoNotMatch);
                return;
            }

            if(preg_match('/[^A-Za-z0-9]/', $pw)) {
               array_push($this->errorArray, Constants::$passwordNotAlphanumeric);
               return; 
            }

            if(strlen($pw) > 30 || strlen($pw) < 5) {
                array_push($this->errorArray, Constants::$passwordLength);
                return;
            }
        }

    }
?>