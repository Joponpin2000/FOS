<?php
//initialize the session
session_start();

// include function file
require_once "functions.php";


//check if the user is already logged in, if yes then redirect him to welcome page
if($loggedin)
    {
        header("location: home.php");
        exit;
    }

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
        //prepare a select statement
        $sql = "SELECT id, username, password FROM users WHERE username = ?";

        if($stmt = mysqli_prepare($db_connect, $sql))
        {
            //Bind variables to the prepared statemwnt as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            //set parameters
            $param_username = $username;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt))
            {
                // Store result
                mysqli_stmt_store_result($stmt);

                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt))
                    {
                        if(password_verify($password, $hashed_password))
                        {
                            // Password is correct, so start a new session
                            session_start();

                            // Store data in session
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;

                            // Redirect user to home page
                            header("location: home.php");
                        }
                        else
                        {
                            $loggedin = false;
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                }
                else
                {
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                }
            }
        }
        else
        {
            echo "Oops! Something went wrong. Please try again later.";
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }
}

// Close connection
mysqli_close($db_connect);
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
                                            <a class="active nav-link" href="login.php">Login</a>
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

            <!-- Breadcrumb -->
            <ul class="breadcrumb">
                <li><a href="home.php">Home</a></li>
                <li><a href="#">login Page</a></li>
                <li>Login</li>

            </ul>
            

            <section>
                <div class="container signup">
                    <div class="row">
                        <div class="col-sm-8 col-md-8 col-lg-8 form">
                            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" role="form" onsubmit="return(validateLogin(this))">
                                <div class="form-group loginform <?php echo
                                (!empty($username_err)) ? 'has-error' : ''; ?>">
                                    <label for="username">Username</label>
                                    <input type="text" name="username" class="form-control" value="<?php echo $username; ?>" placeholder="Username" />
                                    <span class="help-block" style="color:red;"><?php echo $username_err; ?></span>
                                </div>
                                <div class="form-group loginform <?php echo
                                (!empty($password_err)) ? 'has-error' : ''; ?>">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" class="form-control" value="<?php echo $password; ?>" placeholder="Password" />
                                    <span class="help-block" style="color:red;"><?php echo $password_err; ?></span>
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
                        <div class="col-sm-4 col-md-4 col-lg-4">
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
                        </div>
        <!-- ALL JS FILES -->
        <script src="js/all.js"></script>
        <!-- ALL PLUGINS -->
        <script src="js/custom.js"></script>
        <script src="js/timeline.min.js"></script>
    </body>>
    </html>