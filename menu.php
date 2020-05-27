<?php
session_start();
include_once 'functions.php';


?>

<!DOCTYPE html>
<html>
    <head>
    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">   
   
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
     <!-- Site Metas -->
    <title>Food Ordering System</title>  
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Site Icons -->
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap-1.css">
    <!-- Site CSS -->
    <link rel="stylesheet" href="style.css">
    <!-- ALL VERSION CSS -->
    <link rel="stylesheet" href="css/versions.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/custom.css">

    <!-- Modernizer for Portfolio -->
    <script src="js/modernizer.js"></script>
    </head>
    <body>
        <!--Loader-->
        

        <div class="animate-bottom" id="loadbody">
            
        <!--Navigation-->        
        <div class="container" id="header-con">
            <div class="row">
                <header class="top-navbar">
                    <nav class="navbar navbar-b navbar-trans navbar-expand-md fixed-top navbar-dark bg-light">
                        <div class="container-fluid">
                            <a class="navbar-brand" style="color: white;">Food Ordering System</a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbars-host" aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>    
                            <div class="navbar-collapse collapse justify-content-end" id="navbars-host">
                                <ul class="navbar-nav">
                                    <li class="nav-item">
                                        <a class="nav-link" href="home.php">Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="active nav-link" href="menu.php">Food Menu</a>
                                    </li>
                                    <?php
                                    if($loggedin)
                                    {
                                        echo <<<END
                                        <li class="nav-item">
                                        <a class="nav-link" href="trackorder.php">My Orders</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="cart.php">Cart</a>
                                        </li>
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" id="dropdown-a" data-toggle="dropdown">My Account </a>
                                            <div class="dropdown-menu" aria-labelledby="dropdown-a">
                                                <a class="dropdown-item" href="settings.php">Settings</a>
                                                <a class="dropdown-item" href="profile.php">Profile</a>
                                                <a class="dropdown-item" href="logout.php">Logout</a>
                                            </div>
                                        </li>
                                        END;

                                    
                                    }
                                    else
                                    {
                                        echo <<<END
                                        <li class="nav-item">
                                        <a class="nav-link" href="signup.php">Sign Up</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="login.php">Login</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="login.php">Track Order</a>
                                        </li>
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" id="dropdown-a" data-toggle="dropdown">My Account </a>
                                            <div class="dropdown-menu" aria-labelledby="dropdown-a">
                                                <a class="dropdown-item" href="login.php">Settings</a>
                                                <a class="dropdown-item" href="login.php">Profile</a>
                                                <a class="dropdown-item" href="logout.php">Logout</a>
                                            </div>
                                        </li> 
                                        END;
                                    }?>                                   
                                    </ul>
                            </div>
                        </div>
                    </nav>
                </header>
            </div>
        </div>

        <div id="demo" class="carousel slide" data-ride="carousel" style="height:400px;">
            <ul class="carousel-indicators">
                <li data-target="#demo" data-slide-to="0" class="active"></li>
                <li data-target="#demo" data-slide-to="1"></li>
                <li data-target="#demo" data-slide-to="2"></li>
            </ul>
            <div class="carousel-inner" style="height:100%;">
                <div class="carousel-item active" style="height:100%;">
                    <img src="images/28.jpg" alt="Pizza" class="d-block w-100" style="height:100%;">
                    <div class="carousel-caption" style="height:70%;">
                        <h2 style="color:black; font-family: 'Lobster', cursive; font-weight:light;  font-size:25px;"">Find your favorite delicious hot food!</h2>
                        <p>
                            <input type="text" name="food-search" class="form-control" id="food-search" placeholder="I would like to eat..." title="Type in a food" />
                        </p>
                        <div id="result" style="position:fixed;top:300; right:500;z-index: 3000;width:350px;background:white;"></div>
                        <a href="menu.php" role="button" class="btn btn-danger">Search</a>
                    </div>
                </div>
                <div class="carousel-item" style="height:100%;">
                    <img src="images/30.png" alt="Pizza" class="d-block w-100" style="height:100%;">
                    <div class="carousel-caption" style="height:70%;">
                        <h2 style="color:black; font-family: 'Lobster', cursive; font-weight:light;  font-size:25px;"">Search by food name!</h2>
                        <p>
                            <input type="text" name="food-search" class="form-control" id="food-search" placeholder="I would like to eat..." title="Type in a food" />
                        </p>
                        <div id="result" style="position:fixed;top:300; right:500;z-index: 3000;width:350px;background:white;"></div>
                        <a href="menu.php" role="button" class="btn btn-danger">Search</a>
                    </div>
                </div>
                <div class="carousel-item" style="height:100%;">
                    <img src="images/33.jpg" alt="Pizza" class="d-block w-100" style="height:100%;">
                    <div class="carousel-caption" style="height:70%;">
                        <h2 style="color:black; font-family: 'Lobster', cursive; font-weight:light;  font-size:25px;"">Search food!</h2>
                        <p>
                            <input type="text" name="food-search" class="form-control" id="food-search" placeholder="I would like to eat..." title="Type in a food" />
                        </p>
                        <div id="result" style="position:fixed;top:300; right:500;z-index: 3000;width:350px;background:white;"></div>
                        <a href="menu.php" role="button" class="btn btn-danger">Search</a>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#demo" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#demo" data-slide="next">
                <span class="carousel-control-next-icon"></span>
            </a>
        </div>


        <!-- Breadcrumb -->
        <ul class="breadcrumb">
            <li><a href="home.php" style="color: red;">Home</a></li>
            <li><a href="#">Menu</a></li>
            <li>Food Details</li>

        </ul>


        <section>
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-md-3 col-lg-3">
                        <div class="sidenav">
                            <p class="navbar-text">Search Food</p>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search your favourite food" />
                                <span class="input-group-btn">
                                    <button type="submit"><i class="fa fa-search"></i></button>
                                </span>
                            </div>
                            <p class="navbar-text">Food Category</p>
                            <a href="">Italian</a>
                            <a href="">Thai</a>
                            <a href="">South Italian</a>
                            <a href="">North Indian</a>
                            <a href="">Desserts</a>
                            <a href="">Starters</a>
                            <a href="">Chinese</a>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-9 col-lg-9">
                        <div class="row">
                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <div class="thumbnail">
                                    <img src="images/18.jpg" alt="Pizza" />
                                </div>
                                <h5>
                                <a href="p">Corn Pizza</a></h5>
                            <p>Sprinkle with salt and pepper</p>
                                <div class="pull-left">
                                    <h5><b>Rs. 90</b></h5>
                                </div>
                                <div class="pull-right">
                                    <a href="#" class="btn btn-danger order-button" role="button">
                                        Order Now
                                    </a>    
                                </div>

                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <div class="thumbnail">
                                    <img src="images/16.jpg" alt="Pizza" />
                                </div>
                                <h5><a href="menu.php">Vada</a></h5>
                                <p>Medu vada served with hot shambhar and c</p>
                                <div class="pull-left">
                                    <h5><b>Rs. 90</b></h5>
                                </div>
                                <div class="pull-right">
                                    <a href="#" class="btn btn-danger order-button" role="button">
                                        Order Now
                                    </a>    
                                </div>

                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <div class="thumbnail">
                                    <img src="images/16.jpg" alt="Pizza" />
                                </div>
                                <h5><a href="menu.php">Vada</a></h5>
                                <p>Medu vada served with hot shambhar and c</p>
                                <div class="pull-left">
                                    <h5><b>Rs. 90</b></h5>
                                </div>
                                <div class="pull-right">
                                    <a href="#" class="btn btn-danger order-button" role="button">
                                        Order Now
                                    </a>    
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <div class="thumbnail">
                                    <img src="images/16.jpg" alt="Pizza" />
                                </div>
                                <h5><a href="menu.php">Vada</a></h5>
                                <p>Medu vada served with hot shambhar and c</p>
                                <div class="pull-left">
                                    <h5><b>Rs. 90</b></h5>
                                </div>
                                <div class="pull-right">
                                    <a href="#" class="btn btn-danger order-button" role="button">
                                        Order Now
                                    </a>    
                                </div>

                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <div class="thumbnail">
                                    <img src="images/16.jpg" alt="Pizza" />
                                </div>
                                <h5><a href="menu.php">Vada</a></h5>
                                <p>Medu vada served with hot shambhar and c</p>
                                <div class="pull-left">
                                    <h5><b>Rs. 90</b></h5>
                                </div>
                                <div class="pull-right">
                                    <a href="#" class="btn btn-danger order-button" role="button">
                                        Order Now
                                    </a>    
                                </div>

                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <div class="thumbnail">
                                    <img src="images/16.jpg" alt="Pizza" />
                                </div>
                                <h5><a href="menu.php">Vada</a></h5>
                                <p>Medu vada served with hot shambhar and c</p>
                                <div class="pull-left">
                                    <h5><b>Rs. 90</b></h5>
                                </div>
                                <div class="pull-right">
                                    <a href="#" class="btn btn-danger order-button" role="button">
                                        Order Now
                                    </a>    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="container">
                <div class="row food-margin">
                    <div class="col-sm-8 col-md-9 col-lg-9 box">
                        <div class="form-group">
                            <select class="form-control input-lg" style="border: none; background-color: rgb(240, 240, 240);">
                                <option value="">Corn Pizza</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-md-3">
                                <div class="thumbnail">
                                    <img src="images/18.jpg" alt="Pizza" />
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="caption">
                                    <h5>Corn Pizza</h5>
                                    <p>Sprinkle with salt and pepper: let stand 20 minutes. Place pizza crust on a parchment paper-lined baking sheet</p>
                                </div>            
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3 col-md-2 col-md-2 box" style="text-align: center;">
                        <h6>Total</h6>
                        <h5><b>Rs. 220</b></h5>
                        <p>Free shipping</p>
                        <a href="#" class="btn btn-danger order-button" role="button">
                            Order Now
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <section id="bottom-section">
            <div class="container">
                <div class="row" id="second-row">
                    <div class="col-sm-6 col-md-2">
                        <h6><a >Food Ordering System</a></h6>
                        <p><a >Order delivery</a></p>
                    </div>
                    <div class="col-sm-6 col-md-2">
                        <h6><a>About Us</a></h6>
                        <p><a href="about.php">About Us</a></p>
                        <p><a >Contact Us</a></p>
                    </div>
                    <div class="col-sm-6 col-md-2">
                            <h6><a>My Account</a></h6>
                            <p><a href="
                            <?php
                            if($loggedin)
                            {
                                echo 'profile.php';
                            }
                            else
                            {
                                echo 'login.php';
                            }
                            ?>">My Profile</a></p>
                            <p><a href="
                            <?php
                            if($loggedin)
                            {
                                echo 'cart.php';
                            }
                            else
                            {
                                echo 'login.php';
                            }
                            ?>">My Cart</a></p>
                             
                        </div>
                        <div class="col-sm-6 col-md-2">
                            <h6><a>Track Order</a></h6>
                            <p><a href="
                            <?php
                            if($loggedin)
                            {
                                echo 'trackorder.php';
                            }
                            else
                            {
                                echo 'login.php';
                            }
                            ?>">Track Order</a></p>
                        </div>
                    <div class="col-sm-6 col-md-2">
                        <h6><a>Admin</a></h6>
                        <p><a href="
                            <?php
                            if($loggedin)
                            {
                                echo 'admin/adminlogin.php';
                            }
                            else
                            {
                                echo 'login.php';
                            }
                            ?>">Admin</a></p>
                    </div>
                </div>
            </div>
        </section>

        <div class="copyrights">
            <div class="container">
                <div class="row">
                    <div class="center-block">
                        <p>All Rights Reserved. &copy; 2020 <b><a href="#">FOS</a></b> Developed by : <a href=""><b>Idowu Joseph</b></a></p>
                    </div>
                </div>
            </div><!-- end container -->
        </div><!-- end copyrights -->
    







        
        <a href="#" id="scroll-to-top" class="dmtop global-radius"><i class="fa fa-angle-up"></i></a>

        <!-- ALL JS FILES -->
        <script src="js/all.js"></script>
        <!-- ALL PLUGINS -->
        <script src="js/custom.js"></script>
        <script src="js/timeline.min.js"></script>
    </body>
</html>