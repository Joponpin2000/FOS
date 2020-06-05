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
    $sql = "SELECT * FROM categories WHERE id='$id'";
    $result = mysqli_query($db_connect, $sql);
    $check = mysqli_num_rows($result);
    if ($check > 0)
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


if(isset($_POST['submit']))
{
    $category = trim($_POST['category']);

    $result = mysqli_query($db_connect, "SELECT * FROM categories WHERE categories='$category'");
    $check = mysqli_num_rows($result);
    if ($check > 0)
    {
        if (isset($_GET['id']) && (trim($_GET['id']) != ''))
        {
            $getData = mysqli_fetch_assoc($result);
            if($id == $getData['id'])
            {

            }
            else
            {
                $msg = "Category already exist";
            }
        }
        else
        {
            $msg = "Category already exist";
        }
    }
    if ($msg == "")
    {
        if (isset($_GET['id']) && (trim($_GET['id']) != ''))
        {
            mysqli_query($db_connect, "UPDATE categories SET categories='$category' WHERE id='$id'");
        }
        else
        {
            $sql = "INSERT INTO categories(categories, status) VALUES('$category', '1')";
            mysqli_query($db, $sql);    
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
    <body onload="myFunction()">

        <div id="loader"></div>
        

        <div id="myDiv" class="animate-bottom">
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
                    </ul>
                </nav>
                <div id="content" style="padding-left: 20px; width: 100vw">
                    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                        <div class="container-fluid">
                            <button class="btn btn-info" type="button" id="sidebarCollapse" style="background: #7386D5;">&#9776;</button>
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
                                    <button type="submit" name="submit" class="btn btn-info btn-block">Submit</button>
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



        </div>


        <!-- ALL JS FILES -->
        <script src="../js/all.js"></script>
        <!-- ALL PLUGINS -->
        <script src="../js/custom.js"></script>
    </body>
</html>