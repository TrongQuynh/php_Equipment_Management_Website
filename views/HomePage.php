<?php
    session_start();
    if (!isset($_SESSION['loggedin']) || empty($_SESSION['loggedin']) || !$_SESSION['loggedin']){
        header('Location:/views/LoginForm.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "layouts/Head.php" ?>
    <title>Home Page</title>
</head>
<body>
    <!-- Header -->
    <?php include "layouts/Header.php" ?>
    
    <h5>Welcome to home page</h5>
    <?php 
        echo $_SESSION['loggedin']; 
    ?>
    <a href="/php/Logout.php">Logout</a>
    <script>
       
    </script>
</body>
</html>