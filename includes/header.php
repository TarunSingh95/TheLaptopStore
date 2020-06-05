<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>My Website</title>
    <style>
        p{
            padding: 0;
            margin: 0;
        }
        span, h6{
            color: grey;
        }
        .container{
            margin: 30px auto;
            text-align: center;
        }
        .my-col{
            border: 3px solid white;
            padding: 5px 0px;
        }
        .marked{
            text-decoration: line-through;
        }
        .jumbotron-img{
            background-image: url('img/background.jpg');
            background-size: cover;
            min-height: 300px;
            color: white;
            text-align: center;   
        }
        .page-header{
            text-align: center;
            color: grey;
        }
        .btn{
            background-color: grey;
            color: white;
        }
        .navbar {
        min-height: 80px;
        }

        .navbar-nav > li > a {
            padding-top: 0px;
            padding-bottom: 0px;
            line-height: 90px;
        }

        @media (max-width: 767px) {
            .navbar-nav > li > a {
            line-height: 20px;
            padding-top: 10px;
            padding-bottom: 10px;}
        }
        label{
            margin-top: 20px;
        }
        .details_para{
            padding-top: 20px;
        }
        form{
            text-align: center;
        }
        .jumbotron-details{
            margin-top: 100px;
            margin-bottom: 100px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-sm navbar-light bg-light">
    <a href="#" class="navbar-brand">|TheLaptopStore|</a>
    <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarMenu">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarMenu">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a href="index.php" class="nav-link">Home</a>
            </li>
            <li class="nav-item">
                <a href="products.php" class="nav-link">Products</a>
            </li>
            <li class="nav-item">
                <a href="cart.php" class="nav-link">Cart</a>
            </li>
        </ul>
    </div>
</nav>
