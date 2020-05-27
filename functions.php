<?php
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_database = "fos";
$app_name = "FOS";


$db_connect = mysqli_connect($db_host, $db_user, $db_pass, $db_database);
if ($db_connect === false)
{
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

if(isset($_SESSION["username"]) &&
$_SESSION["loggedin"] === true)
{
    $loggedin = TRUE;
}
else
{
    $loggedin = FALSE;
}

// function to create a table
function createTable($db_connect, $tablename, $tablevalues)
{
    $query = "CREATE TABLE IF NOT EXISTS $tablename($tablevalues)";
    $result = mysqli_query($db_connect, $query);
    if($result)
    {
        echo "Table '$tablename' created or already exists.<br />"; 
    }
    else {
        die("Error occured. " . mysqli_error($db_connect));
    }

}

?>