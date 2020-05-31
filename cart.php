<?php
session_start();
include_once 'functions.php';

// Define variables and initialize with empty values
$building = $street = $area = $landmark = $city = "";
$building_err = $street_err = $area_err = $landmark_err = $city_err = "";

// Check if user is logged in
if($loggedin)
{
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if (empty(trim($_POST["building"])))
        {
            $building_err = "Please enter building number.";
        }
        else
        {
            $building = trim($_POST["building"]);
        }

        if (empty(trim($_POST["street"])))
        {
            $street_err = "Please enter street address.";
        }
        else
        {
            $street = trim($_POST["street"]);
        }

        if (empty(trim($_POST["area"])))
        {
            $area_err = "Please enter address area.";
        }
        else
        {
            $area = trim($_POST["area"]);
        }

        if (empty(trim($_POST["city"])))
        {
            $city_err = "Please enter city.";
        }
        else
        {
            $city = trim($_POST["city"]);
        }

        $landmark = trim($_POST["landmark"]);

        if((isset($_POST["building"]) && empty($building_err))
        && (isset($_POST["street"]) && empty($street_err))
        && (isset($_POST["area"]) && empty($area_err))
        && (isset($_POST["city"]) && empty($city_err)))
        {
            $_SESSION['building'] = $building;
            $_SESSION['street'] = $street;
            $_SESSION['area'] = $area;
            $_SESSION['landmark'] = $landmark;
            $_SESSION['city'] = $city;
            header("location: orderstatus.php");
            exit;
        }
    }








}

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
                                        <a class="nav-link" href="index.php">Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="menu.php">Food Menu</a>
                                    </li>
                                    <?php
                                    if($loggedin)
                                    {
                                        echo <<<END
                                        <li class="nav-item">
                                        <a class="nav-link" href="trackorder.php">My Orders</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="active nav-link" href="cart.php">Cart</a>
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



        <div id="demo" class="carousel slide" data-ride="carousel" style="height:200px;">
            <ul class="carousel-indicators">
                <li data-target="#demo" data-slide-to="0" class="active"></li>
                <li data-target="#demo" data-slide-to="1"></li>
                <li data-target="#demo" data-slide-to="2"></li>
            </ul>
            <div class="carousel-inner" style="height:100%;">
                <div class="carousel-item active" style="height:100%;">
                    <img src="images/33.jpg" alt="Pizza" class="d-block w-100" style="height:100%;">
                    <div class="carousel-caption" style="height:70%;">
                        <h1 style="color:white; text-transform: uppercase; font-family: 'Lobster', cursive; font-weight:bold;  font-size:25px;">Better dining experience!</h1>
                    </div>
                </div>
                <div class="carousel-item" style="height:100%;">
                    <img src="images/28.jpg" alt="Pizza" class="d-block w-100" style="height:100%;">
                    <div class="carousel-caption" style="height:70%;">
                        <h1 style="color:white; text-transform: uppercase; font-family: 'Lobster', cursive; font-weight:bold;  font-size:25px;">Build amazing experience around dining!</h1>
                    </div>
                </div>
                <div class="carousel-item" style="height:100%;">
                    <img src="images/30.png" alt="Pizza" class="d-block w-100" style="height:100%;">
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
            <li><a href="index.php" style="color: red;">Home</a></li>
            <li><a href="#">Cart</a></li>
            <li>Cart Details</li>
        </ul>



        
        <section class="cart">
            <div class="row">
                <div class="col-sm-6 col-md-3 col-lg-3">
                    <div class="sidenav">
                        <h5 style="background-color: red; height: auto; text-align: center; margin: 0 auto;">Food Categories</h5>
                        <a href="">Italian</a>
                        <a href="">Thai></a>
                        <a href="">South Italian</a>
                        <a href="">North Indian</a>
                        <a href="">Desserts</a>
                        <a href="">Starters</a>
                        <a href="">Chinese</a>
                    </div>
                </div>
                <?php
                $total = 0;

    if(isset($_SESSION["orders"]) && count($_SESSION["orders"]) > 0)
    {
        ?>

                <div class="col-sm-6 col-md-6 col-lg-6 inner-section">
                    <h2>Your Orders for delicious foods</h2>
                <div class="row">
                    <div class="col-sm-12 col-md-8 col-lg-8">
            <form method="post" action="cart.php">

        <?php
            foreach($_SESSION["orders"] as $food_id)
            {
                $query = 'SELECT * FROM foods WHERE id = ' . $food_id . '';
                $result = mysqli_query($db_connect, $query);
                while($row=mysqli_fetch_array($result))
                {
                    $product_name = $row['foodname'];
                    $product_price = $row['price'];
                    $product_code = $row['id'];
                    $product_description = $row['description'];
                    $product_file = $row['filepath'];
        ?>
                        <div class="row">
                            <div class="col-sm-12 col-lg-8 col-md-8">
                                <div class="row">
                                    <div class="col-sm-4 col-md-4 col-lg-4">
                                        <img src="<?php echo $product_file; ?>" alt="<?php echo $product_name; ?> image" style="height:60%;" />
                                    </div>
                                    <div class="col-sm-5 col-md-5 col-lg-5">
                                        <h5><?php echo $product_name; ?></h5>
                                        <p><?php echo $product_description; ?></p>
                                    </div>
                                    <div class="col-sm-3 col-md-3 col-lg-3">
                                        <p><?php echo '$ ' . $product_price; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    $total = ($total + $product_price);    
                }
            }
        ?>
        </form>
        </div>

                    </div>
            </div>
            <div class="col-sm-6 col-md-3 col-lg-3 flo" style="width:100%;">
                        <div class="sidenav">
                            <p class="navbar-text" style="background-color: rgba(231, 238, 243, 0.4);">Your Shopping Cart</p>
                            <form role="form" action="<?php echo
                            htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="cart" onsubmit=" <?php $_SESSION['order_num'] = rand(); $_SESSION['order_date'] = date('l F jS, Y - g:ia', time());   ?>alert('Order has been placed. Your order number is ' + $_SESSION['order_num']);">
                                <div class="form-group">
                                    <input type="text" name="building" value="<?php echo $building; ?>" class="form-control" placeholder="Flat or Building Number"/>
                                    <span class="help-block" style="color:red;"><?php echo $building_err; ?></span>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="street" value="<?php echo $street; ?>" class="form-control" placeholder="Street Name"/>
                                    <span class="help-block" style="color:red;"><?php echo $street_err; ?></span>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="area" value="<?php echo $area; ?>" class="form-control" placeholder="Area"/>
                                    <span class="help-block" style="color:red;"><?php echo $area_err; ?></span>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="landmark" value="<?php echo $landmark; ?>" class="form-control" placeholder="Landmark if any"/>
                                    <span class="help-block" style="color:red;"><?php echo $landmark_err; ?></span>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="city" value="<?php echo $city; ?>" class="form-control" placeholder="City"/>
                                    <span class="help-block" style="color:red;"><?php echo $city_err; ?></span>
                                </div>
                                    <hr />
                                <div class="center-block">
                                    <p>TOTAL</p>
                                    <p><b>$ <?php echo $total; ?></b></p>
                                    <small>Free Shipping</small>
                                    <button type="submit" class="btn btn-danger">Place Order</button>    
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php

                    }
                    else {
                    ?>
                    <div class="col-sm-6 col-md-9 col-lg-9 inner-section">
                    <h2>Your Orders for delicious foods</h2>

                    <input type="text" style="width:50%; background-color: white; padding-left: 20px;" placeholder="Your cart is empty!" disabled>
                    </div>
                    <?php
                    }

                    ?>

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