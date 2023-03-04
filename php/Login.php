<?php
    require "Helper.php";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recei Data From Form
        $name = $_POST["username"];
        $password = $_POST["password"];

        // Connect DB
        require_once "../connectDB.php";

        // Query Statement
        $query_select = "SELECT * FROM accounts WHERE account_name = '$name'";

        // Test Query
        //echo $query_inser t; exit();

        // Excute Query
        $result = mysqli_query($connectDB, $query_select);
        
        if(mysqli_num_rows($result) > 0){
            $row=mysqli_fetch_assoc($result);
            if(verifyPassword($password, $row["password"])){
                session_start();
                $_SESSION['loggedin'] = true;
                header('Location:/views/HomePage.php');
            }else{
                header('Location:/views/LoginForm.php');
            }
            
        }
        
        mysqli_free_result($result);
        

    }
?>  