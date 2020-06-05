<?php
session_start();
require_once '../functions.php';


if(!isset($_SESSION['admin']))
{
	header("location:adminlogin.php");
}

$categories_id = "";
$name = "";
$mrp = "";
$price = "";
$qty = "";
$image = "";
$short_desc = "";
$description = "";
$meta_title = "";
$meta_desc = "";
$meta_keyword = "";

$msg = "";
$image_required = 'required';

if (isset($_GET['id']) && (trim($_GET['id']) != ''))
{
    // Prepare an update statement
    $sql = "SELECT * FROM product WHERE id = ? ";
    if ($stmt = mysqli_prepare($db_connect, $sql))
    {
        $image_required = '';
        $id = trim($_GET['id']);
    
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
                $categories_id = $row['categories_id'];    
                $name = $row['name'];    
                $mrp = $row['mrp'];    
                $price = $row['price'];    
                $qty = $row['qty'];    
                $image = $row['image'];    
                $short_desc = $row['short_desc'];    
                $description = $row['description'];    
                $meta_title = $row['meta_title'];    
                $meta_desc = $row['meta_desc'];    
                $meta_keyword = $row['meta_keyword'];    
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
    $categories_id = trim($_POST['categories_id']);
    $name = trim($_POST['name']);
    $mrp = trim($_POST['mrp']);
    $price = trim($_POST['price']);
    $qty = trim($_POST['qty']);
    $short_desc = trim($_POST['short_desc']);
    $description = trim($_POST['description']);
    $meta_title = trim($_POST['meta_title']);
    $meta_desc = trim($_POST['meta_description']);
    $meta_keyword = trim($_POST['meta_keyword']);


    // Prepare an update statement
    $sql = "SELECT * FROM product WHERE name = ?";
    if ($stmt = mysqli_prepare($db_connect, $sql))
    {
        // SET parameters
        mysqli_stmt_bind_param($stmt, "s", $param_name);
        $param_name = $name;
        
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
                        $msg = "Product already exist";
                    }
                }
                else
                {
                    $msg = "Product already exist";
                }
            }
        }
        else
        {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
    mysqli_stmt_close($stmt);


    if ($_FILES['image']['type'] != '' && $_FILES['image']['type'] != 'image/png' && $_FILES['image']['type'] != 'image/jpg' && $_FILES['image']['type'] != 'image/jpeg')
    {
        $msg = "Please select only png, jpg and jpeg formats.";
    }


    if ($msg == "")
    {
        if (isset($_GET['id']) && (trim($_GET['id']) != ''))
        {
            if ($_FILES['image']['name'] != '')
            {
                $image = rand(111111111, 999999999) . '_' . $_FILES['image']['name'];
                move_uploaded_file($_FILES['image']['tmp_name'],PRODUCT_IMAGE_SERVER_PATH . $image);

                //prepare a select statement
                $sql = "UPDATE product SET categories_id = ?, name = ?, mrp = ?, price = ?,
                qty = ?, short_desc = ?, description = ?, meta_title = ?, meta_desc = ?,
                meta_keyword = ?, image = ? WHERE id=? ";
                
                if($stmt = mysqli_prepare($db_connect, $sql))
                {
                    //Bind variables to the prepared statement as parameters
                    mysqli_stmt_bind_param($stmt, "isddissssssi", $param_cat, $param_name, $param_mrp, $param_price, $param_qty,
                $param_short_desc, $param_description, $param_meta_title, $param_meta_desc, $param_meta_keyword, $param_image,
                $param_id);

                    //set parameters
                    $param_cat = $categories_id;
                    $param_name = $name;
                    $param_mrp = $mrp;
                    $param_price = $price;
                    $param_qty = $qty;
                    $param_short_desc = $short_desc;
                    $param_description = $description;
                    $param_meta_title = $meta_title;
                    $param_meta_desc = $meta_desc;
                    $param_meta_keyword = $meta_keyword;
                    $param_image = $image;
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
                $sql = "UPDATE product SET categories_id = ?, name = ?, mrp = ?, price = ?,
                qty = ?, short_desc = ?, description = ?, meta_title = ?, meta_desc = ?,
                meta_keyword = ? WHERE id=? ";
                
                if($stmt = mysqli_prepare($db_connect, $sql))
                {
                    //Bind variables to the prepared statement as parameters
                    mysqli_stmt_bind_param($stmt, "isddisssssi", $param_cat, $param_name, $param_mrp, $param_price, $param_qty,
                $param_short_desc, $param_description, $param_meta_title, $param_meta_desc, $param_meta_keyword, 
                $param_id);

                    //set parameters
                    $param_cat = $categories_id;
                    $param_name = $name;
                    $param_mrp = $mrp;
                    $param_price = $price;
                    $param_qty = $qty;
                    $param_short_desc = $short_desc;
                    $param_description = $description;
                    $param_meta_title = $meta_title;
                    $param_meta_desc = $meta_desc;
                    $param_meta_keyword = $meta_keyword;
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
        else
        {
            $image = rand(111111111, 999999999) . '_' . $_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'],PRODUCT_IMAGE_SERVER_PATH . $image);
            
            //prepare a select statement
            $sql = "INSERT INTO product(categories_id, name, mrp, price, qty, short_desc, description, meta_title,
             meta_desc, meta_keyword, status, image)
             VALUES(?, ?, ?, ?, ?, ?, ?, ?,
              ?, ?, ?, ?)";
            
            if($stmt = mysqli_prepare($db_connect, $sql))
            {
                //Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "isddisssssis", $param_cat, $param_name, $param_mrp, $param_price, $param_qty,
                $param_short_desc, $param_description, $param_meta_title, $param_meta_desc, $param_meta_keyword, 
                $param_status, $param_image);

                //set parameters
                $param_cat = $categories_id;
                $param_name = $name;
                $param_mrp = $mrp;
                $param_price = $price;
                $param_qty = $qty;
                $param_short_desc = $short_desc;
                $param_description = $description;
                $param_meta_title = $meta_title;
                $param_meta_desc = $meta_desc;
                $param_meta_keyword = $meta_keyword;
                $param_status = 1;
                $param_image = $image;

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
        header("location: product.php");
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
                            <a href="categories.php">Categories</a>
                        </li>
                        <li>
                            <a href="product.php" class="active">Product</a>
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
                            <button class="btn btn-info" type="button" id="sidebarCollapse" style="background: #7386D5;">&#9776;</button>
                        </div>
                    </nav>
                    <div class="container">
                    <div class="title">
                        <h5>Add Product</h5>
                    </div>

                        <div class="col-sm-12 col-md-12 col-lg-12 cat-block">
                            <div class="form-block">
                            <form method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="category" class="form-control-label">Product</label>
                                    <select class="form-control" name="categories_id">
                                        <option>Select Category</option>
                                        <?php
                                            $res = mysqli_query($db_connect, "SELECT id,categories FROM categories ORDER BY categories ASC");
                                            while($row = mysqli_fetch_assoc($res))
                                            {
                                                if ($row['id'] == $categories_id)
                                                {
                                                    echo "<option selected value=" .$row['id'] . ">" . $row['categories'] . "</option>";
                                                }
                                                else
                                                {
                                                    echo "<option value=" .$row['id'] . ">" . $row['categories'] . "</option>";
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="form-control-label">Product Name</label>
                                    <input type="text" name="name" class="form-control" value="<?php echo $name ?>" placeholder="Enter product name" required/>
                                </div>
                                <div class="form-group">
                                    <label for="mrp" class="form-control-label">MRP</label>
                                    <input type="text" name="mrp" class="form-control" value="<?php echo $mrp ?>" placeholder="Enter product mrp" required/>
                                </div>
                                <div class="form-group">
                                    <label for="price" class="form-control-label">Price</label>
                                    <input type="text" name="price" class="form-control" value="<?php echo $price ?>" placeholder="Enter product price" required/>
                                </div>
                                <div class="form-group">
                                    <label for="qty" class="form-control-label">Qty</label>
                                    <input type="text" name="qty" class="form-control" value="<?php echo $qty ?>" placeholder="Enter qty" required/>
                                </div>
                                <div class="form-group">
                                    <label for="image" class="form-control-label">Image</label>
                                    <input type="file" name="image" class="form-control" <?php echo $image_required ?>/>
                                </div>
                                <div class="form-group">
                                    <label for="short_desc" class="form-control-label">Short Description</label>
                                    <textarea name="short_desc" class="form-control" placeholder="Enter product short description" required><?php echo $short_desc ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="description" class="form-control-label">Description</label>
                                    <textarea name="description" class="form-control" placeholder="Enter product description"><?php echo $description ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="meta_title" class="form-control-label">Meta Title</label>
                                    <textarea name="meta_title" class="form-control" placeholder="Enter product meta_title"><?php echo $meta_title ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="meta_description" class="form-control-label">Meta Description</label>
                                    <textarea name="meta_description" class="form-control" placeholder="Enter product meta description"><?php echo $meta_desc ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="meta_keyword" class="form-control-label">Meta Keyword</label>
                                    <textarea name="meta_keyword" class="form-control" placeholder="Enter product meta keyword"><?php echo $meta_keyword ?></textarea>
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




        <!-- ALL JS FILES -->
        <script src="../js/all.js"></script>
        <!-- ALL PLUGINS -->
        <script src="../js/custom.js"></script>
    </body>
</html>