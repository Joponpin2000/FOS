<?php
//initialize the session
session_start();

//check if the user is already logged in, if yes then redirect him to welcome page
if($loggedin)
    {
        header("location: index.php");
        exit;
    }

// include function file
require_once "functions.php";

//Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST")
{
        //Check if username is empty
        if(empty(trim($_POST["username"])))
        {
            $username_err = "Please enter username.";
        }
        else
        {
            $username = trim($_POST["username"]);
        }
        //check if password is empty
        if(empty(trim($_POST["password"])))
        {
            $password_err = "Please enter your password.";
        }
        else
        {
            $password = trim($_POST["password"]);
        }
    
        //validate credentials
        if(empty($username_err) && empty($password_err))
        {
            
        }
}

?>
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
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>    
                            <div class="navbar-collapse collapse justify-content-end">
                                <ul class="navbar-nav">
                                    <li class="nav-item">
                                        <a class="active nav-link" href="index.php">Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="menu.php">Food Menu</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="signup.php">Sign Up</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Log in</a>
                                    </li>
                                    <?php
                                    if ($loggedin)
                                    {
                                        echo <<<_END
                                        <li class="nav-item">
                                        <a class="nav-link" href="trackorder.php">Track Order</a>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" id="dropdown-a" data-toggle="dropdown">My Account </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdown-a">
                                            <a class="dropdown-item" href="settings.php">Settings</a>
                                            <a class="dropdown-item" href="profile.php">Profile</a>
                                            <a class="dropdown-item" href="logout.php">Logout</a>
                                        </div>
                                    </li>
                                    _END;
                                    }
                                    ?>
                                    </ul>
                            </div>
                        </div>
                    </nav>
                </header>
            </div>
        </div>

        <!-- Breadcrumb -->
        <ul class="breadcrumb">
            <li><a href="index.php">Home</a></li>
            <li><a href="#">login Page</a></li>
            <li>Login</li>

        </ul>
        

        <section>
            <div class="container signup">
                <div class="row">
                    <div class="col-sm-4 col-md-8 col-lg-8 form">
                        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" role="form" onsubmit="return(validateLogin(this))">
                            <div class="form-group loginform <?php echo
                            (!empty($username_err)) ? 'has-error' : ''; ?>">
                                <label for="username">Username</label>
                                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>" placeholder="Username" required/>
                                <span class="help-block"><?php echo $username_err; ?></span>
                            </div>
                            <div class="form-group loginform <?php echo
                            (!empty($password_err)) ? 'has-error' : ''; ?>">
                                <label for="password">Password</label>
                                <input type="text" name="password" class="form-control" value="<?php echo $password; ?>" placeholder="Password" required/>
                                <span class="help-block"><?php echo $password_err; ?></span>
                            </div>
                            <div class="form-group loginform">
                                <div class="pull-left">
                                    <input type="submit" class="btn btn-danger" value="Login" />
                                </div>
                                <div class="pull-right">
                                    <a href="signup.php" class="btn btn-danger" role="button">Register</a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-4">
                        <h5>Registration is fast, easy and free.</h5>
                        <img src="images/3.png" alt="food online order" />
                        <h5>Contact Customer Support</h5>
                        <p>If you are looking for more help or have a question to ask, please..</p>
                    </div>
                </div>
            </div>
        </section>










        


        <section id="bottom-section">
            <div class="container">
                <div class="row" id="second-row">
                    <div class="col-sm-6 col-md-2">
                        <h6><a href="#">Food Ordering System</a></h6>
                        <p><a href="#">Order delivery</a></p>
                    </div>
                    <div class="col-sm-6 col-md-2">
                        <h6><a>About Us</a></h6>
                        <p><a href="#">About Us</a></p>
                        <p><a href="#">Contact Us</a></p>
                    </div>
                    <?php
                        if($loggedin){
                            echo <<<_END
                            <div class="col-sm-6 col-md-2">
                            <h6><a>My Account</a></h6>
                            <p><a href="profile.php">My Profile</a></p>
                            <p><a href="cart.php">My Cart</a></p>
                             
                        </div>
                        <div class="col-sm-6 col-md-2">
                            <h6><a>Track Order</a></h6>
                            <p><a href="trackorder.php">Track Order</a></p>
                        </div>
                        _END;            
                        }
                        ?>
                    <div class="col-sm-6 col-md-2">
                        <h6><a>Admin</a></h6>
                        <p><a href="admin/adminlogin.php">Admin</a></p>
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
    </body>>
</html>