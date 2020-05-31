<?php
session_start();
// Include config file
require_once 'functions.php';

// Check if the user is logged in, if not redirect to login page
if(!isset($loggedin) || $_SESSION["loggedin"] !== true)
{
    header("location: login.php");
    exit;
}

// Define variables and initialize with empty values
$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    // Validate new password
    if(empty(trim($_POST["newpassword"])))
    {
        $new_password_err = "Please enter the new password.";
    }
    elseif(strlen(trim($_POST["newpassword"])) < 6)
    {
        $new_password_err = "Password must have at least 6 characters.";
    }
    else {
        $new_password = trim($_POST["newpassword"]);
    }

    // Validate confirm password
    if(empty(trim($_POST["conpassword"])))
    {
        $confirm_password_err = "Please confirm the password.";
    }
    else
    {
        $confirm_password = trim($_POST["conpassword"]);

        if(empty($new_password_err) && ($new_password != $confirm_password))
        {
            $confirm_password_err  = "Password did not match.";
        }
    }

    // Check input errors before updating the database
    if(empty($new_password_err) && empty($confirm_password_err))
    {
        // Prepare an update statement
        $query = "UPDATE users SET password = ? WHERE id = ?";
        if($stmt = mysqli_prepare($db_connect, $query))
        {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id);
            
            // Set parameters
            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_id = $_SESSION["id"];

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt))
            {
                // Password updated successfully. Destroy the session, and redirect to login page.
                session_destroy();
                header("location: login.php");
                exit();
            }
            else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Close connection
    mysqli_close($db_connect);
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
    <body">
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
                                                <a class="active dropdown-item" href="login.php">Settings</a>
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

        <!-- Breadcrumb -->
        <ul class="breadcrumb">
            <li><a href="index.php" style="color: red;">Home</a></li>
            <li>Change Password</li>

        </ul>

    </section>



    <section>
        <div class="container signup">
            <div class="row">
                <div class="col-sm-8 col-md-8 col-lg-8 form">
                    <form method="POST" action="<?php
                     echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" role="form" onsubmit="return(validateSettings(this))">
                        <div class="form-group loginform <?php
                         echo (!empty($new_password_err)) ? 'has-error' : ''; ?>">
                            <label for="newpassword">New Password</label>
                            <input type="text" name="newpassword" value="<?php
                             echo $new_password; ?>" class="form-control" required/>
                            <span class="help-block"><?php
                             echo $new_password_err; ?></span>
                        </div>
                        <div class="form-group loginform <?php
                         echo (!empty($new_password_err)) ? 'has-error' : ''; ?>">
                            <label for="conpassword">Confirm Password</label>
                            <input type="text" name="conpassword" value="<?php
                             echo $confirm_password; ?>" class="form-control" required/>
                            <span class="help-block"><?php
                             echo $confirm_password_err; ?></span>
                        </div>
                        <div class="form-group loginform">
                            <div>
                                <button type="submit" class="btn btn-danger">Change</button>
                            </div>
                        </div>
                    </form>
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