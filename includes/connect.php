
<!-- ket noi den database -->
<?php
// $servername = "localhost";
// $username = "root";
// $password = "";
// $port = "3306";
// $dbname = "BTL_WEB_HUMG";

$servername = "sql211.infinityfree.com";
$username = "if0_38101093";
$password = "yrKlCIa3q1SpcTX";
$dbname = "if0_38101093_tracnghiemonline";
$port = 3306;

// // Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname, $port);
// // Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
mysqli_set_charset($conn, "utf8mb4");
// Thiết lập mã hóa ký tự cho MySQLi

?>

