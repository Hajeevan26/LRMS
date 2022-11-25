<?php
	if(!isset($_SESSION))
	{
		session_start();
	}
	
	include("connection/config.php");
	$msg="";
	
	if(isset($_POST["btnlogin"]))
	{
		$username=$_POST["txtusername"];
		$password=md5($_POST["txtpassword"]);
		
		$sqlcheckuser="SELECT * FROM user WHERE email='$username'";
		
		$sqllogin="SELECT * FROM user WHERE email='$username'";
		$resultcheckuser=mysqli_query($con,$sqllogin) or die("sql error in sqllogin ".mysqli_error());
		$n=mysqli_num_rows($resultcheckuser);
		if($n==1)
		{
			$row=mysqli_fetch_assoc($resultcheckuser);
			$sqllogin="SELECT * FROM user WHERE email='$username' and password='$password'"; 
            $resultlogin=mysqli_query($con,$sqllogin)or die("Error in login:".mysqli_error());
            $m=mysqli_num_rows($resultlogin);
			if($m==1)
            {
                $row=mysqli_fetch_assoc($resultlogin);
                $status=$row['status'];
                if($status=="active")
                {
                    $_SESSION['user_id']=$row['user_id'];
                    $_SESSION['role_id']=$row['role_id'];
					$_SESSION['email']=$row['email'];
					$_SESSION['user_name']=$row['user_name'];
					
					
                    $sql2="UPDATE user SET attempt = 0 WHERE email='$username'";
                    $result2=mysqli_query($con,$sql2)or die("Error_in_checkuser:".mysqli_error()); 
					$action="Login";
					include("userlog.php");
					
					if( $_SESSION['role_id']=="R01"){
						header('location:./index1.php?pg=content.php');
					}
					else {
						header('location:index1.php?pg=reservation.php&option=view');
					}
						
				
					
				}
                else if($status=="deleted")
                {
					
					echo'<script> alert("your Acoount is deleted please contact Servive station");
					window.location.href="index.php?pguest=errorpage.php&option=deleted";</script>';
				}
                else if($status=="pending")
                {
					echo'<script> alert("your Acoount is pending please contact Servive station");
					window.location.href="index.php?pguest=errorpage.php&option=pending";</script>';
					
				}
				else if($status=="blocked")
				{
					echo'<script> alert("your Acoount is blocked please contact Servive station");
					window.location.href="index.php?pguest=errorpage.php&option=blocked";</script>';
					
				}   
			}
            else
            { 
				$attempt= $row['attempt'];
				if($attempt<=3)
				{
					$msg='<font color="red">Your Password Incorrect, Please try again</font>';
					
					$sql2="UPDATE user SET attempt = attempt+1 Where email='$username'";
					$result2=mysqli_query($con,$sql2)or die("Error_in_checkuser:".mysqli_error()); 
				}
				else
				{
					$msg='<font color="red">Your attempt exceed 3 times</font>';					
					header('location:forgetpassword.php');
				}
			}
			
		}
		else
		{
			$msg='<font color="red">Your Username not registered in our database</font>';   
			
			echo '<script>alert("There is no such username");</script>';
		}
	}
	if(!isset($_SESSION['user_id'])) {

	
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Leave Request Management System</title>


</head>

<body>
    <!-- partial:index.partial.html -->
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <!-- Design by foolishdeveloper.com -->
        <title>Login</title>

        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
        <!--Stylesheet-->
        <style media="screen">

        </style>
        <link rel="stylesheet" href="dist/css/login.css">
    </head>

    <body>
        <div class="background">
            <div class="shape"></div>
            <div class="shape"></div>
        </div>
        <form action="#" method="post">
            <h3>Login Here</h3>

            <label for="username">Email</label>
            <input type="text" placeholder="Email" name="txtusername" id="txtusername">

            <label for="password">Password</label>
            <input type="password" placeholder="Password" name="txtpassword" id="txtpassword">

            <button name="btnlogin" id="btnlogin">Log In</button>

            <!-- <div class="social">
						<div class="go"><i class="fab fa-google"></i>  Google</div>
						<div class="fb"><i class="fab fa-facebook"></i>  Facebook</div>
					</div> -->
            <br>
            <hr>
            <div class="social"></div>
            <div>
                <a href="signup.php">
                    <h4 style="text-align:center;"> Create an account </h4>
                </a>
            </div>
        </form>
    </body>

    </html>
    <?php  } 
		else {

			if( $_SESSION['role_id']=="R01"){
						header('location:index1.php?pg=content.php');
					}
					else {
						header('location:index1.php?pg=reservation.php&option=view');
					}
		}
		?>