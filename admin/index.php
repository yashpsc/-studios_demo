<?php session_start();
require "database.php";
$sql ="SELECT logo, head_color from header";
$result = $conn->query($sql);
if($result->num_rows > 0)
{
   $header = $result->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
    <title>Havells Studio Admin Dashboard</title>
     <!-- <meta content="width=device-width, initial-scale=1.0" name="viewport" /> -->
     <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- GLOBAL STYLES -->
    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="assets/css/login.css" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <link rel="stylesheet" href="assets/plugins/Font-Awesome/css/font-awesome.css" />
    <!--END GLOBAL STYLES -->
	<script src="assets/plugins/jquery-2.0.3.min.js"></script>
    
	<script src="assets/plugins/bootstrap/js/bootstrap.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/jquery.redirect.js"></script>
    <!-- END GLOBAL SCRIPTS -->
</head>
<body style="max-height: 100vh; overflow: auto;">
<?php
if (isset($_SESSION['user']))
{
    $ipvalidation = 0;
    $sql = "SELECT * FROM ips";
    $result = $conn->query($sql);
    // if ($result->num_rows>0)
    // {
    //     $serial=1;
    //     while($ip = $result->fetch_assoc())
    //     {
    //         if ($_SERVER['REMOTE_ADDR'] == $ip['ip'])
    //         {
    //           $ipvalidation = 1;
    //         }
    //     }    
    // }
    // else
    // {
    //     echo "Error updating record: " . $conn->error;
    // }
    // if($ipvalidation)
    // {
        include "dashboard.php";
    // }
    // else
    // {
    //     die("Access Forbidden");
    // }
}
else
{
	include "login.php";
}

?>
</body>
</html>