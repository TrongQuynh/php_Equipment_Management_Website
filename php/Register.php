<?php
    require "../Helper/Helper.php";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recei Data From Form
        $name = $_POST["username"];
        $password = $_POST["password"];

        // Connect DB
        require_once "../connectDB.php";

        $query_select = "SELECT * FROM accounts WHERE account_name = '$name'";
        // Excute Query
        $result = mysqli_query($connectDB, $query_select );
        if(mysqli_num_rows($result) == 0){
            $password = encryptPassword($password);
            // Query Statement
            $query_insert = "INSERT INTO accounts (account_name ,password) VALUES ('$name','$password')";
            // Excute Query
            mysqli_query($connectDB, $query_insert);
        }
    }
?>  