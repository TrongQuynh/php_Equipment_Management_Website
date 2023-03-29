<?php
    session_start();
    if (!isset($_SESSION['loggedin']) || empty($_SESSION['loggedin']) || !$_SESSION['loggedin']){
        header('Location:/views/LoginForm.php');
    }
?>