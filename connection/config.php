<?php
$con=mysqli_connect("localhost","root","");
if(!$con)
{
	die("server connection error ".mysqli_error($con));
}
$db=mysqli_select_db($con,"lrms");
if(!$db)
{
	die("database error ".mysqli_error($con));
}
?>