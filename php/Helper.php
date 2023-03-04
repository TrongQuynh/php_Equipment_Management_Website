<?php
    function encryptPassword($password){
        return password_hash($password, PASSWORD_DEFAULT);
    }

    function verifyPassword($reqPassword, $dbPassword){
        // return "true" if Password Verified!
        return password_verify($reqPassword, $dbPassword);
    }
?>