<!-- Check Authent -->
<?php include "../Helper/Authentication.php" ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "layouts/Head.php" ?>
    <title>Home Page</title>
    <style>
        #slide_img {
            max-height: 30rem;
            height: 30rem;
            width: 90%;
            max-width: 90%;
        }

        #slide_img img {
            height: 30rem;

            width: 80%;
            max-width: 80%;
            margin: auto;
            box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;
        }

        #btn_Pre,
        #btn_Next {
            color: black;
        }
    </style>
</head>


<body>
    <!-- Header -->
    <?php include "layouts/Header.php" ?>

    <div class="d-flex justify-content-center">
        <div id="slide_img" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="../public/imgs/SlideIMG_1.jpg" alt="First slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="../public/imgs/SlideIMG_2.jpg" alt="Second slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="../public/imgs/SlideIMG_3.jpg" alt="Third slide">
                </div>
            </div>
            <a class="carousel-control-prev" id="btn_Pre" href="#slide_img" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" id="btn_Next" href="#slide_img" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>

    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4">Equipment Management Website</h1>
            <p class="lead">This website provide a centralized platform for businesses to manage their equipment inventory and related maintenance tasks.</p>
        </div>
    </div>

</body>

</html>