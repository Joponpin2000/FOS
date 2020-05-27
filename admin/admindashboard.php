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
                                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Dashboards</a>
                                    <ul class="collapse list-unstyled" id="homeSubmenu">
                                        <li>
                                            <a href="">Change Username</a>
                                        </li>
                                        <li>
                                            <a href="">Change Password</a>
                                        </li>
                                        <li>
                                            <a href="">Logout</a>
                                        </li>
                                    </ul>
                                </li>
                                </ul>
                            </div>
                        <ul class="list-unstyled components">
                            <li class="active">
                                <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Dashboards</a>
                                <ul class="collapse list-unstyled" id="homeSubmenu">
                                    <li>
                                        <a href="">Dashboards</a>
                                    </li>
                                </ul>
                            </li>
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
                                <button type="button" id="sidebarCollapse" class="btn btn-info" style="background-color: white;">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                            </div>
                            <div class="center-block">
                                <h4>Food Ordering System!!</h4>
                            </div>
                            <div class="pull-right">
                                <a href="">Logout</a>
                            </div>
                        </nav>
                        <div class="container">
                           <div class="row">
                            <div class="col-sm-6 col-md-4 col-lg-4 box">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h5>TOTAL ORDER</h5>
                                    </div>
                                    <div class="panel-body">
                                        <h4>4</h4>
                                        <small>Total Order</small>
                                    </div>
                                </div>
                            </div> 
                            <div class="col-sm-6 col-md-4 col-lg-4 box">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h5>NEW ORDER</h5>
                                    </div>
                                    <div class="panel-body">
                                        <h4>2</h4>
                                        <small>New Order</small>
                                    </div>
                                </div>
                            </div> 
                            <div class="col-sm-6 col-md-4 col-lg-4 box">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h5>CONFIRMED ORDER</h5>
                                    </div>
                                    <div class="panel-body">
                                        <h4>0</h4>
                                        <small>Confirmed Order</small>
                                    </div>
                                </div>
                            </div>    
                           </div>
                           <div class="row">
                            <div class="col-sm-6 col-md-4 col-lg-4 box">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h5>TOTAL FOOD DELIVERED</h5>
                                    </div>
                                    <div class="panel-body">
                                        <h4>6</h4>
                                        <small>Total food delivered</small>
                                    </div>
                                </div>
                            </div> 
                            <div class="col-sm-6 col-md-4 col-lg-4 box">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h5>FOOD BEING PREPARED</h5>
                                    </div>
                                    <div class="panel-body">
                                        <h4>0</h4>
                                        <small>Food being prepared</small>
                                    </div>
                                </div>
                            </div> 
                            <div class="col-sm-6 col-md-4 col-lg-4 box">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h5>FOOD PICKUP</h5>
                                    </div>
                                    <div class="panel-body">
                                        <h4>1</h4>
                                        <small>Food pickup</small>
                                    </div>
                                </div>
                            </div>    
                           </div>
                           <div class="row">
                            <div class="col-sm-6 col-md-4 col-lg-4 box">
                                <div class="panel panel-info"  style="border: 5px thick #0f1a1d;">
                                    <div class="panel-heading">
                                        <h5>CANCELLED ORDER</h5>
                                    </div>
                                    <div class="panel-body">
                                        <h4>2</h4>
                                        <small>Cancelled Order</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-4 box">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h5>TOTAL REGD. USER</h5>
                                    </div>
                                    <div class="panel-body">
                                        <h4>5</h4>
                                        <small>Total regd. user</small>
                                    </div>
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
    



        <!-- ALL JS FILES -->
        <script src="../js/all.js"></script>
        <!-- ALL PLUGINS -->
        <script src="../js/custom.js"></script>
        <script src="../js/timeline.min.js"></script>
    </body>
</html>