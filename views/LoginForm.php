<?php
    session_start();
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']){
        header('Location:/views/HomePage.php');
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body {
            background-image: url("https://images.wallpaperscraft.com/image/single/mountains_lake_sunset_117525_1920x1200.jpg");
            background-repeat: no-repeat;
            background-size: cover;
            box-sizing: border-box;
            margin: 0;
            width: 100%;
        }

        .bodyImage {
            margin: 0;
            width: 100%;
            height: 100vh;
            background-color: rgba(52, 52, 52, 0.4);
            position: relative;
        }

        .container {
            background-color: rgba(86, 86, 86, 0.682);
            position: relative;
            top: 50%;
            transform: translateY(-50%);
            width: 30rem;
            padding: 2rem;
        }
    </style>
    <style>
        #btn_Submit{
            margin: auto;
        }
        .button-group{
            text-align: center;
        }
        .container{
            box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;
        }
    </style>
</head>

<body>
    <div class="bodyImage">
        <div class="container rounded">
            <h2 class="text-center text-light">Login</h2>
            <form action="../php/Login.php" method="POST">
                <div class="form-group">
                    <label for="uname" class="text-light font-weight-bold">Username:</label>
                    <input type="text" class="form-control" id="username" placeholder="Enter username" name="username"
                        required>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>
                <div class="form-group">
                    <label for="uname" class="text-light font-weight-bold">Password:</label>
                    <input type="password" class="form-control" id="password" placeholder="Enter Password" name="password"
                        required>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>
                <div class="form-group">
                    <?php 
                        if(isset($_GET["error"])){
                            echo '
                                <div class="alert alert-danger" role="alert">
                                    Username or Password wrong!
                                </div>
                            ';
                        }
                    ?>
                </div>
                <div class="button-group">
                    <button type="submit" id="btn_Submit" class="btn btn-outline-success">Submit</button>
                </div>
                
            </form>
        </div>
    </div>
</body>

</html>