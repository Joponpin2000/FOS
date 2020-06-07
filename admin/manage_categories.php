<?php
session_start();
require_once '../functions.php';


$category = "";
$msg = "";


if(!isset($_SESSION['admin']))
{
	header("location:adminlogin.php");
}

if (isset($_GET['id']) && (trim($_GET['id']) != ''))
{


    $id = trim($_GET['id']);

    // Prepare an update statement
    $sql = "SELECT * FROM categories WHERE id = ? ";
    if ($stmt = mysqli_prepare($db_connect, $sql))
    {
        // SET parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        $param_id = $id;
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt))
        {
            $result = mysqli_stmt_get_result($stmt);
            if (mysqli_num_rows($result) == 1)
            {
                $row = mysqli_fetch_assoc($result);
                $category = $row['categories'];
            }
            else
            {
                header("location: categories.php");
                die();            
            }
        }
        else
        {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
    mysqli_stmt_close($stmt);
}


if(isset($_POST['submit']))
{
    $category = trim($_POST['category']);

    // Prepare an update statement
    $sql = "SELECT * FROM categories WHERE categories = ?";
    if ($stmt = mysqli_prepare($db_connect, $sql))
    {
        // SET parameters
        mysqli_stmt_bind_param($stmt, "s", $param_cat);
        $param_cat = $category;
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt))
        {
            $result = mysqli_stmt_get_result($stmt);
            if (mysqli_num_rows($result) == 1)
            {
                if (isset($_GET['id']) && (trim($_GET['id']) != ''))
                {
                    $row = mysqli_fetch_assoc($result);
                    if($id != $row['id'])
                    {
                        $msg = "Category already exist";
                    }
                }
                else
                {
                    $msg = "Category already exist";
                }
            }
        }
        else
        {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
    mysqli_stmt_close($stmt);

    if ($msg == "")
    {
        if (isset($_GET['id']) && (trim($_GET['id']) != ''))
        {
            
            //prepare a select statement
            $sql = "UPDATE categories SET categories=? WHERE id=? ";
            if($stmt = mysqli_prepare($db_connect, $sql))
            {
                //Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "si", $param_cat, $param_id);

                //set parameters
                $param_cat = $category;
                $param_id = $id;

                // Execute the prepared statement
                mysqli_stmt_execute($stmt);
            }
            else
            {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
        
        else
        {
            //prepare a select statement
            $sql = "INSERT INTO categorieS(categories, status) VALUES(?, ?)";
            if($stmt = mysqli_prepare($db_connect, $sql))
            {
                //Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "si", $param_cat, $param_status);

                //set parameters
                $param_cat = $category;
                $param_status = '1';

                // Execute the prepared statement
                mysqli_stmt_execute($stmt);
            }
            else
            {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
        header("location: categories.php");
        die();        
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
    <link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" href="../images/apple-touch-icon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap-1.css">

    <!-- Site CSS -->
    <link rel="stylesheet" href="style.css">
    <!-- ALL VERSION CSS -->
    <link rel="stylesheet" href="../css/versions.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="../css/responsive.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/custom.css">
    </head>
    <body>
            <div class="wrapper">
                <nav id="sidebar">
                    <div class="sidebar-header">
                        <h3 style="color: white">Admin Panel</h3>
                    </div>
                    <ul class="list-unstyled components">
                        <li>
                            <a class="active">Categories</a>
                        </li>
                        <li>
                            <a href="product.php">Product</a>
                        </li>
                        <li>
                            <a href="users.php">Users</a>
                        </li>
                        <li>
                            <a href="contact_us.php">Contact Us</a>
                        </li>
                        <li>
                            <a href="logout.php">Logout</a>
                        </li>
                    </ul>
                </nav>
                <div id="content" style="padding-left: 20px; width: 100vw">
                    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                        <div class="container-fluid">
                            <button class="btn btn-warning" type="button" id="sidebarCollapse" style="background: #7386D5;">&#9776;</button>
                        </div>
                    </nav>
                    <div class="container">
                    <div class="title">
                        <h5>Add Categories</h5>
                    </div>

                        <div class="col-sm-12 col-md-12 col-lg-12 cat-block">
                            <div class="form-block">
                                <form method="post">
                                    <div class="form-group">
                                        <label for="category" class="form-control-label">Category</label>
                                        <input type="text" name="category" class="form-control" value="<?php echo $category ?>" placeholder="Enter Category name" required/>
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-warning btn-block">Submit</button>
                                    <span class="help-block" style="color:red;"><?php echo $msg; ?></span>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="copyrights">
                    <div class="container">
                        <div class="row">
                            <div style="margin: 0 auto">
                                <p>All Rights Reserved. &copy; 2020 <b><a href="#">FOS</a></b> Developed by : <a href=""><b>Idowu Joseph</b></a></p>
                            </div>
                        </div>
                    </div><!-- end container -->
                </div><!-- end copyrights -->

                </div>
            </div>


            <a href="#" id="scroll-to-top" class="dmtop global-radius"><i class="fa fa-angle-up"></i></a>


        <!-- ALL JS FILES -->
        <script src="../js/all.js"></script>
        <!-- ALL PLUGINS -->
        <script src="../js/custom.js"></script>
    </body>
</html>