<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname='test';
$con= mysqli_connect($host,$username,$password,$dbname);
if(!$con){
	echo "not connected";
}
?>
