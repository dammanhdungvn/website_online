<!-- ket noi den database -->
<?php
$servername = "localhost";
$username = "root";
$password = "";
$port = "3306";
$dbname = "BTL_WEB_HUMG";

// // Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname, $port);
// // Check connection
// if (!$conn) {
//   die("Connection failed: " . mysqli_connect_error());
// }
// echo "Connected successfully";
?>

