<?php
require_once "functions.php";

$msg = "";
$firstname = $lastname = $email = $username = $password = $rpassword = "";
$firstname_err = $lastname_err = $email_err = $username_err = $password_err = $rpassword_err = "";

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
    }

    //validate password
    if(empty(trim($_POST["password"])))
    {
        $password_err = "Please enter a password.";
    }
    elseif(strlen(trim($_POST["password"])) < 6)
    {
        $password_err = "Password must have at least 6 characters.";
    }
    else {
        $password = trim($_POST["password"]);
    }

    //validate repeat password
    if(empty(trim($_POST["rpassword"])))
    {
        $rpassword_err = "Please repeat password.";
    }
    else
    {
        $rpassword = trim($_POST["rpassword"]);
        if(empty($password_err) && ($password != $rpassword))
        {
            $rpassword_err = "Password did not match.";
        }
    }

    //Check input errors before inserting in databse
    if((empty($firstname_err) && empty($lastname_err)) 
        && (empty($username_err) && empty($email_err)) 
        && (empty($password_err) && empty($rpassword_err)))
    {
        $sql = "INSERT INTO users (username, password, firstname, lastname, email) VALUES (?, ?, ?, ?, ?)";
        if ($stmt = mysqli_prepare($db_connect, $sql))
        {
            mysqli_stmt_bind_param($stmt, "sssss", $param_username, $param_password, $param_firstname, $param_lastname, $param_email);
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT);
            $param_firstname = $firstname;
            $param_lastname = $lastname;
            $param_email = $email;

            if(mysqli_stmt_execute($stmt))
            {
                $msg = "You have successfully registered. Please proceed to login page.";
            }
            else {
                echo "Something went wrong. Please try again later.";
            }
            mysqli_stmt_close($stmt);
        }
    }
    mysqli_close($db_connect);

}

?><!DOCTYPE html>
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
                <nav class="navbar navbar-b navbar-trans navbar-expand-md fixed-top" style="background-color: #7386D5">
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
                                        <a class="active nav-link" href="signup.php">Sign Up</a>
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

        <!-- Breadcrumb -->
        <ul class="breadcrumb">
            <li><a href="home.php">Home</a></li>
            <li><a href="#">Signup Page</a></li>
            <li>Signup</li>

        </ul>


        <section>
            <div class="container signup">
                <div class="row">
                    <div class="col-sm-8 col-md-8 col-lg-8 form">
                        <p style="color: red;"><?php echo $msg;?></p>
                        <form method="post" action="<?php echo
                        htmlspecialchars($_SERVER["PHP_SELF"]); ?>" role="form" onsubmit="return(validate(this))">
                            <div class="form-group <?php echo (!empty($firstname_err)) ? 'has-error' : ''; ?>">
                                <label for="firstname">First Name</label>
                                <input type="text" name="firstname" class="form-control" value="<?php echo $firstname; ?>" />
                                <span class="help-block" style="color:red;"><?php echo $firstname_err; ?></span>
                            </div>
                            <div class="form-group <?php echo (!empty($lastname_err)) ? 'has-error' : ''; ?>">
                                <label for="lastname">Last Name</label>
                                <input type="text" name="lastname" class="form-control" value="<?php echo $lastname; ?>" />
                                <span class="help-block" style="color:red;"><?php echo $lastname_err; ?></span>
                            </div>
                            <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                                <label for="email">Email Address</label>
                                <input type="text" name="email" class="form-control" value="<?php echo $email; ?>" />
                                <span class="help-block" style="color:red;"><?php echo $email_err; ?></span>
                            </div>
                            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                                <label for="username">Username</label>
                                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>" />
                                <span class="help-block" style="color:red;"><?php echo $username_err; ?></span>
                            </div>
                            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                                <label for="password">Password</label>
                                <input type="text" name="password" class="form-control" value="<?php echo $password; ?>" />
                                <span class="help-block" style="color:red;"><?php echo $password_err; ?></span>
                            </div>
                            <div class="form-group <?php echo (!empty($rpassword_err)) ? 'has-error' : ''; ?>">
                                <label for="rpassword">Repeat Password</label>
                                <input type="text" name="rpassword" class="form-control" value="<?php echo $rpassword; ?>" />
                                <span class="help-block" style="color:red;"><?php echo $rpassword_err; ?></span>
                            </div>
                            <div class="form-group">
                                <div class="pull-left">
                                    <input type="submit" class="btn btn-info" value="Register">
                                </div>
                                <div class="pull-right">
                                    <a href="login.php" class="btn btn-info"  role="button">Login</a>
                                </div>    
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-4 col-md-4 col-lg-4">
                        <h5>Registration is fast, easy and free.</h5>
                        <img src="images/6.jpg" alt="food online order" />
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
                        <h6><a>Food Ordering System</a></h6>
                        <p><a>Order delivery</a></p>
                    </div>
                    <div class="col-sm-6 col-md-2">
                        <h6><a>About Us</a></h6>
                        <p><a href="about.php">About Us</a></p>
                        <p><a>Contact Us</a></p>
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