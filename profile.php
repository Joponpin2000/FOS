<?php

session_start();
// Include config file
require_once 'functions.php';

// Check if the user is logged in, if not then redirect to login page
if(!isset($loggedin) || $_SESSION['loggedin'] !== true)
{
    header("location:login.php");
    exit;
}
$msg = "We will never share your details to anyone.";
$username = $firstname = $lastname = $email = $created_at = "";

//prepare a select statement
$sql = "SELECT username, firstname, lastname, email, created_at FROM users WHERE username = ?";

if($stmt = mysqli_prepare($db_connect, $sql))
{
    //Bind variables to the prepared statemwnt as parameters
    mysqli_stmt_bind_param($stmt, "s", $param_username);

    //set parameters
    $param_username = $_SESSION['username'];

    // Attempt to execute the prepared statement
    if(mysqli_stmt_execute($stmt))
    {
        // Store result
        mysqli_stmt_store_result($stmt);

        // Check if username exists
        if(mysqli_stmt_num_rows($stmt) == 1)
        {
            // Bind result variables
            mysqli_stmt_bind_result($stmt, $busername, $bfirstname, $blastname, $bemail, $bcreated_at);
            if (mysqli_stmt_fetch($stmt))
            {
                $username = $busername;
                $firstname = $bfirstname;
                $lastname = $blastname;
                $email = $bemail;
                $created_at = $bcreated_at;

            }
        }
    }
    else
    {
        die("Oops! Something went wrong. Please try again later.");
    }
}
else
{
    die("Oops! Something went wrong. Please try again later.");
}

// Close statement
mysqli_stmt_close($stmt);


// Define variables and initialize with empty values
$new_firstname = $new_lastname = $new_email = $new_username = "";
$new_firstname_err = $new_lastname_err = $new_email_err = $new_username_err = "";

if ($_SERVER["REQUEST_METHOD"] =="POST")
{
    if (empty(trim($_POST["firstname"])))
    {
        $firstname_err = "Please enter firstname.";
    }
    else {
        $firstname = trim($_POST["firstname"]);
    }

    if (empty(trim($_POST["lastname"])))
    {
        $lastname_err = "Please enter lastname.";
    }
    else {
        $lastname = trim($_POST["lastname"]);
    }

    //validate email
    if (empty(trim($_POST["email"])))
    {
        $email_err = "Please enter email.";
    }
    else {
        //SANITIZE EMAIL
        $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    }

    //VALIDATE USERNAME
    if (empty(trim($_POST["username"])))
    {
        $username_err = "Please enter username.";
    }
    else
    {
        $sql = "SELECT id FROM users WHERE username = ?";
    

        if($stmt = mysqli_prepare($db_connect, $sql))
        {
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            $param_username = trim($_POST["username"]);

            if (mysqli_stmt_execute($stmt))
            {
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    $username_err = "This username is already taken.";
                }
                else
                {
                    $username = trim($_POST["username"]);
                }
            }
            else
            {
                echo "Oops something went wrong. Please try again later.";
            }

            mysqli_stmt_close($stmt);
        }
        else
            {
                echo "Oops something went wrong. Please try again later.";
            }
    }
    
    //Check input errors before inserting in databse
    if((empty($new_firstname_err) && empty($new_lastname_err)) 
        && (empty($new_username_err) && empty($new_email_err)) )
    {

        // Prepare an update statement
        $sql = "UPDATE users SET username = ?, firstname = ?, lastname = ?, email = ? WHERE id = ?";
        if ($stmt = mysqli_prepare($db_connect, $sql))
        {
            // SET parameters
            mysqli_stmt_bind_param($stmt, "ssssi", $param_username, $param_firstname, $param_lastname, $param_email, $param_id);
            $param_username = $new_username;
            $param_firstname = $new_firstname;
            $param_lastname = $new_lastname;
            $param_email = $new_email;
            $param_id = $_SESSION['id'];

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt))
            {
                // Password updated successfully.
                // Destroy the session and redirect to login page.
                session_destroy();
                header("location: login.php");
                exit();
            }
            else {
                echo "Something went wrong. Please try again later.";
            }
            mysqli_stmt_close($stmt);
        }
    }
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
                                                <a class="active dropdown-item" href="profile.php">Profile</a>
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


        <div id="demo" class="carousel slide" data-ride="carousel" style="height:300px;">
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
                    <div class="carousel-caption" style="height:70%;">
                        <h1 style="color:white; text-transform: uppercase; font-family: 'Lobster', cursive; font-weight:bold;  font-size:25px;">Build amazing experience around dining!</h1>
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
            <li><a href="index.php" style="color: red;">Home</a></li>
            <li>Profile</li>

        </ul>


        <section>
            <div class="container signup">
                <div class="row">
                    <div class="col-sm-8 col-md-8 col-lg-8 form">
                    <p style="color: red;"><?php echo $msg;?></p>
                    <form>
                        <div class="form-group">
                            <label for="firstname">First Name</label>
                            <input type="text" name="firstname" class="form-control" value="<?php echo $firstname;?>" disabled/>
                        </div>
                        <div class="form-group">
                            <label for="lastname">Last Name</label>
                            <input type="text" name="lastname" class="form-control" value="<?php echo $lastname; ?>" disabled/>
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="text" name="email" class="form-control" value="<?php echo $email;?>" disabled/>
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" class="form-control" value="<?php echo $username;?>" disabled/>
                        </div>
                        <div class="form-group">
                            <label for="regdate">Registration Date</label>
                            <input type="text" id="" name="regdate" class="form-control"  value="<?php echo $created_at; ?>" disabled/>
                        </div>
                        </form>
                    </div>
                    <div class="col-sm-4 col-md-4 col-lg-4">
                        <h5>Profile.</h5>
                        <img src="images/7.jpg" alt="food online order" />
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