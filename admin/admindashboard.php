<?php
session_start();
require_once '../functions.php';
if(!isset($_SESSION['admin']))
{
	header("location:admin.php");
	
}
else
{
	$admin_username=$_SESSION['admin'];
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
    <link rel="stylesheet" href="../style.css">
    <!-- ALL VERSION CSS -->
    <link rel="stylesheet" href="../css/versions.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="../css/responsive.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/custom.css">

    </head>
    <body>
        <!--Loader-->
        

        <div class="animate-bottom" id="loadbody">
            <div class="wrapper">
                <div id="sidebar">
                    <nav>
                        <div class="sidebar-header">
                            <div style=" background-color: #110707; border-radius: 50px;">
                                <i class="fa fa-user fa-5x"></i>
                            </div>
                            <ul class="list-unstyled components">
                                <li class="active">
                                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Admin</a>
                                    <ul class="collapse list-unstyled" id="homeSubmenu">
                                        <li>
                                            <a href="">Change Password</a>
                                        </li>
                                        <li>
                                            <a href="logout.php">Logout</a>
                                        </li>
                                    </ul>
                                </li>
                                </ul>
                            </div>
                        <ul class="list-unstyled components">
                            <li>
                                <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Reg Users</a>
                                <ul class="collapse list-unstyled" id="pageSubmenu">
                                    <li>
                                        <a href="">Reg Users</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#foodSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Food Category</a>
                                <ul class="collapse list-unstyled" id="foodSubmenu">
                                    <li>
                                        <a href="">Food Category</a>
                                    </li>
                                    <li>
                                        <a href="">Manage Food Category</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#menuSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Food Menu</a>
                                <ul class="collapse list-unstyled" id="menuSubmenu">
                                    <li>
                                        <a href="">Add Food</a>
                                    </li>
                                    <li>
                                        <a href="">Manage Food</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#orderSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Orders</a>
                                <ul class="collapse list-unstyled" id="orderSubmenu">
                                    <li>
                                        <a href="">Not Confirmed Yet</a>
                                    </li>
                                    <li>
                                        <a href="">Orders Confirmed</a>
                                    </li>
                                    <li>
                                        <a href="">Food Being Prepared</a>
                                    </li>
                                    <li>
                                        <a href="">Food Pickup</a>
                                    </li>
                                    <li>
                                        <a href="">Food Delivered</a>
                                    </li>
                                    <li>
                                        <a href="">Cancelled</a>
                                    </li>
                                    <li>
                                        <a href="">All Orders</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#reportSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Reports</a>
                                <ul class="collapse list-unstyled" id="reportSubmenu">
                                    <li>
                                        <a href="">B/W Dates</a>
                                    </li>
                                    <li>
                                        <a href="">Order Count</a>
                                    </li>
                                    <li>
                                        <a href="">Sales Reports</a>
                                    </li>
                                    <li>
                                        <a href="">Home3</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#searchSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Search</a>
                                <ul class="collapse list-unstyled" id="searchSubmenu">
                                    <li>
                                        <a href="">Search</a>
                                    </li>
                                    <li>
                                        <a href="">Home1</a>
                                    </li>
                                    <li>
                                        <a href="">Home2</a>
                                    </li>
                                    <li>
                                        <a href="">Home3</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </nav>

                </div>
                    <div id="content" style="width: 100%;">
                        <nav class="navbar navbar-expand-lg navbar-light bg-light">
                            <div class="pull-left">
                                <button type="button" class="navbar-toggler btn btn-info" style="background-color: white;" data-toggle="collapse" data-target="" aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                            </div>
                            <div class="center-block">
                                <h4>Food Ordering System!!</h4>
                            </div>
                            <div class="pull-right">
                                <a href="logout.php">Logout</a>
                            </div>
                        </nav>

                        <div class="wrapper">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="page-header clearfix">
                                        <h2 class="pull-left">Registered Users Details</h2>
                                        </div>
                                        <?php
                                        //Include config file
                                        require_once "../functions.php";

                                        // Attempt select query execution
                                        $sql = "SELECT * FROM users";
                                        if ($result = mysqli_query($db_connect, $sql))
                                        {
                                            if (mysqli_num_rows($result) > 0)
                                            {
                                                echo "<table class='table table-bordered table-striped'>";
                                                echo "<thead><tr><th>#</th><th>Name</th><th>Email</th><th>Registered Date</th></tr><thead><tbody>";
                                                while ($row = mysqli_fetch_array($result))
                                                {
                                                    echo "<tr><td>" . $row['id'] . "</td>";
                                                    echo "<td>" . $row['firstname'] . ' ' . $row['lastname'] . "</td>";
                                                    echo "<td>" . $row['email'] . "</td>";
                                                    echo "<td>" . $row['created_at'] . "</td></tr>";
                                                }
                                                echo "</tbody></table>";

                                                // Free result Set
                                                mysqli_free_result($result);
                                            }
                                            else {
                                                echo "<p class='lead'><em>No records were found.</em></p>";
                                            }
                                        }
                                        else {
                                            echo "ERROR: Try again later" . mysqli_error($link);
                                        }

                                        // Close Connection
                                        mysqli_close($db_connect);
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
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
    
        <a href="#" id="scroll-to-top" class="dmtop global-radius"><i class="fa fa-angle-up"></i></a>



        <!-- ALL JS FILES -->
        <script src="../js/all.js"></script>
        <!-- ALL PLUGINS -->
        <script src="../js/custom.js"></script>
        <script src="../js/timeline.min.js"></script>
    </body>
</html>