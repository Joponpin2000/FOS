<?php
session_start();
require_once '../functions.php';
if(!isset($_SESSION['admin']))
{
	header("location:adminlogin.php");
	
}

if (isset($_GET['type']) && trim($_GET['type']) != '')
{
    $type = trim($_GET['type']);

    if ($type == 'status')
    {
        $operation = trim($_GET['operation']);
        $id = trim($_GET['id']);

        if ($operation == 'active')
        {
            $status = '1';
        }
        else
        {
            $status = '0';
        }
        //prepare a select statement
        $sql = "UPDATE foods SET status = ? WHERE id = ? ";
        if($stmt = mysqli_prepare($db_connect, $sql))
        {
            //Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ii", $param_status, $param_id);

            //set parameters
            $param_status = $status;
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

    if ($type == 'delete')
    {
        $id = trim($_GET['id']);
        
        //prepare a select statement
        $sql = "DELETE FROM foods WHERE id = ?";
        if($stmt = mysqli_prepare($db_connect, $sql))
        {
            //Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);

            //set parameters
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

}

$sql = "SELECT * FROM foods ORDER BY id";
$result = mysqli_query($db_connect, $sql);
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
                            <a class="active">Product</a>
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
                    <div class="title">
                        <h3>Products</h3>
                        <h5><a href="manage_product.php" style="text-decoration: underline; color: #7386D5;">Add Products</a></h5>
                    </div>
                    <div class="table" style="width: 100%;">
                        <table style="width: 100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ID</th>
                                    <th>Foodname</th>
                                    <th>Description</th>
                                    <th>Image</th>
                                    <th>Price</th>
                                    <th></th>
                                    </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                while ($row = mysqli_fetch_assoc($result))
                                {
                                ?>
                                    <tr>
                                        <td><?php echo $i ?></td>
                                        <td><?php echo $row['id'] ?></td>
                                        <td><?php echo $row['foodname'] ?></td>
                                        <td><?php echo $row['description'] ?></td>
                                        <td><img src="<?php echo PRODUCT_IMAGE_SITE_PATH . $row['filepath']?>" style="width: 40px; height: 30px"/></td>
                                        <td><?php echo $row['price'] ?></td>
                                        <td style="text-align: right;">
                                            <?php
                                            if ($row['status'] == 1)
                                            {
                                                echo "<span class='sett complete'><a href='?type=status&operation=deactive&id=" . $row['id'] .  "'>Active</a></span>&nbsp;";
                                            }
                                            else 
                                            {
                                                echo "<span class='sett pending'><a href='?type=status&operation=active&id=" . $row['id'] .  "'>Deactive</a></span>&nbsp;";
                                            }
                                            echo "<span class='sett edit'><a href='manage_product.php?id=" . $row['id'] .  "'>Edit</a></span>";

                                            echo "&nbsp;<span class='sett delete'><a href='?type=delete&id=" . $row['id'] .  "'>Delete</a><span>";
                                            ?>
                                        </td>
                                    </tr>
                                <?php
                                ++$i;
                                }
                                ?>
                            </tbody>
                        </table>
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
</html