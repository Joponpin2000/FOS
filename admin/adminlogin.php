<?php

// include function file
require_once "../functions.php";

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
        $sql = "SELECT id, username, password FROM admin WHERE username = ? AND password = ?";

        if($stmt = mysqli_prepare($db_connect, $sql))
        {
            //Bind variables to the prepared statemwnt as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);

            //set parameters
            $param_username = $username;
            $param_password = $password;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt))
            {
                // Store result
                mysqli_stmt_store_result($stmt);

                // Check if username and password exists
                if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt))
                    {
                        session_start();

                        // Store data in session
                        $_SESSION["loggedin"] = true;
                        $_SESSION["id"] = $id;
                        $_SESSION["admin"] = $username;

                        // Redirect user to home page
                        header("location: product.php");
                    }
                }
                else
                {
                    // Display an error message if username doesn't exist
                    $password_err = "Invalid username / password combination.";
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
    <link rel="shortcut icon" href="../images/logo_2.png" type="image/x-icon" />
    <link rel="apple-touch-icon" href="../images/apple-touch-icon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap-1.css">
    <!-- Site CSS -->
    <link rel="stylesheet" href="../style.css">
    <!-- ALL VERSION CSS -->
    <link rel="stylesheet" href="../css/versions.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="../css/responsive.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/custom.css">

    </head>
    <body>
            <div class="center-block" style="margin: 100px auto; width: 70%;">
                <div class="container">
                    <div class="row">
                            <div class="col-sm-12 col-md-6 col-md-6" style="padding: 10px;">
                                <h4><span style="color: #7386D5;">Food Ordering System</span> | Admin Login</h4>
                            </div>
                            <div class="col-sm-12 col-md-6 col-md-6" style="background-color: white; padding: 10px;">
                                <form role="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="username" value="<?php echo $username; ?>" required/>
                                        <span class="help-block" style="color:red;"><?php echo $username_err; ?></span>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="password" value="<?php echo $password; ?>" required/>
                                        <span class="help-block" style="color:red;"><?php echo $password_err; ?></span>
                                    </div>
                                    <button type="submit" style="background-color: #7386D5; border-color: #7386D5" class="btn btn-warning btn-block">Submit</button>
                                    <a href="" class="pull-left" style="color: red;">Forgot Password?</a>
                                </form>
                            </div>
                    </div>
                </div>    
            </div>

        <div class="copyrights">
            <div class="container">
                <div class="row">
                    <div class="center-block">
                        <p>All Rights Reserved. &copy; 2020 <b><a href="#">FOS</a></b> Developed by : <a href=""><b>Idowu Joseph</b></a></p>
                    </div>
                </div>
            </div><!-- end container -->
        </div><!-- end copyrights -->
    



        <!-- ALL JS FILES -->
        <script src="../js/all.js"></script>
        <!-- ALL PLUGINS -->
        <script src="../js/custom.js"></script>
        <script src="../js/timeline.min.js"></script>
    </body>
</html>