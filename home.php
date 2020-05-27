<?php
session_start();
include_once 'functions.php';

if ($loggedin)
{
    // Process order when button is clicked
    if($_SERVER["REQUEST_METHOD"] =="POST")
    {
        $_SESSION['orders'][] = $_POST['id'];
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
                                        <a class="active nav-link" href="home.php">Home</a>
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
                    <img src="images/33.jpg" alt="Pizza" class="d-block w-100" style="height:100%;">
                    <div class="carousel-caption" style="height:70%;">
                        <h2 style="color:black; font-family: 'Lobster', cursive; font-weight:light;  font-size:25px;">Find your favorite delicious hot food!</h2>
                        <p>
                            <input type="text" name="food-search" class="form-control" id="food-search" placeholder="I would like to eat..." title="Type in a food" />
                        </p>
                        <div id="result" style="position:fixed;top:300; right:500;z-index: 3000;width:350px;background:white;"></div>
                        <a href="menu.php" role="button" class="btn btn-danger">Search</a>
                    </div>
                </div>
                <div class="carousel-item" style="height:100%;">
                    <img src="images/28.jpg" alt="Pizza" class="d-block w-100" style="height:100%;">
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
                    <img src="images/30.png" alt="Pizza" class="d-block w-100" style="height:100%;">
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



        <!--slider ends-->


        <div id="p">
            <p>Popular Delicious Foods Here: <a href="menu.php">All Over America</a></p>
        </div><hr />
        

        <section>
            <div class="container">
                <div class="center-block">
                    <h4>Popular This Month In Your City</h4>
                    <p>The easiest way to get your favorite food</p>
                </div>
                <div class="row">
                    <?php
                        //prepare a select statement
                        $sql = "SELECT * FROM foods";
                        $query = mysqli_query($db_connect, $sql);
                        while($row=mysqli_fetch_array($query))
                        {
                            ?>
                            <div class="col-sm-8 col-md-4 col-lg-4" style="margin-bottom:10px;">
                                <form method="POST" action="<?php echo
                                htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                    <div class="thumbnail center-block">
                                        <img class="res" src="<?php echo $row['filepath']; ?>" alt="Pizza" />
                                    </div>
                                    <div class="caption">
                                        <h5>
                                            <a href="menu.php"><?php echo $row['foodname']; ?></a></h5>
                                        <p><?php echo $row['description']; ?></p>
                                        <div class="pull-left">
                                            <h5><b>Rs. <?php echo $row['price']; ?></b></h5>
                                        </div>
                                        <div class="pull-right">
                                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
                                            <input type="submit" onclick="alert('<?php if($loggedin){echo 'Food item has been added to cart';} else{echo 'Please Login to proceed.';}?>')" class="btn btn-danger order-button" value="Order now" role="button" />
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <?php
                                }
                            ?>


                    

                </div>
            </div>
        </section>
        <section id="bottom-section">
            <div class="container">
                <div class="center-block">
                    <h5>Easy 3 Step Order</h5>
                </div>
                <div class="row" id="first-row">
                    <div class="col-sm-12 col-md-4">
                        <h6>Choose a tasty dish</h6>
                        <p>We've got you covered with menus from over 107 delicious foods online</p>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <h6>Fill your location</h6>
                        <p>We've got you covered with menus from over 107 delicious foods online</p>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <h6>Food Delivery</h6>
                        <p>We've got you covered with menus from over 107 delicious foods online</p>
                    </div>
                </div>
                <p>Pay by Cash on delivery</p>
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
                        <p>All Rights Reserved. &copy; 2020 <b><a href="#">FOS</a></b> Developed by : <a><b>Idowu Joseph</b></a></p>
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