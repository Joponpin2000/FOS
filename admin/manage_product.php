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
    $image_required = '';
    $id = trim($_GET['id']);
    $sql = "SELECT * FROM product WHERE id='$id'";
    $result = mysqli_query($db_connect, $sql);
    $check = mysqli_num_rows($result);
    if ($check > 0)
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
        header("location: product.php");
        die();    
    }
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


    $result = mysqli_query($db_connect, "SELECT * FROM product WHERE name='$name'");
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
                $msg = "Product already exist";
            }
        }
        else
        {
            $msg = "Product already exist";
        }
    }

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
                $update_sql = "UPDATE product SET 
                categories_id='$categories_id', name='$name', mrp='$mrp', price='$price', qty='$qty', short_desc='$short_desc',
                 description='$description', meta_title='$meta_title', meta_desc='$meta_desc', meta_keyword='$meta_keyword', image='$image'
                 WHERE id='$id' ";
            }
            else
            {
                $update_sql = "UPDATE product SET 
                categories_id='$categories_id', name='$name', mrp='$mrp', price='$price', qty='$qty', short_desc='$short_desc',
                 description='$description', meta_title='$meta_title', meta_desc='$meta_desc', meta_keyword='$meta_keyword'
                 WHERE id='$id' ";
            }
            mysqli_query($db_connect, $update_sql);
        }
        else
        {
            $image = rand(111111111, 999999999) . '_' . $_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'],PRODUCT_IMAGE_SERVER_PATH . $image);
            $sql = "INSERT INTO product(categories_id, name, mrp, price, qty, short_desc, description, meta_title,
             meta_desc, meta_keyword, status, image)
             VALUES('$categories_id', '$name', '$mrp', '$price', '$qty', '$short_desc', '$description', '$meta_title',
              '$meta_desc', '$meta_keyword', 1, '$image')";
            mysqli_query($db_connect, $sql);    
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