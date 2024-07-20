<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$database = "minor-project";
$ip=$_SERVER['REMOTE_ADDR'];
$conn = mysqli_connect($servername, $username, $password,$database);

if (!$conn) {
   echo "Connection failed.... ";
}
else{
  // echo "Connected";

}
?>