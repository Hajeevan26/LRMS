<?php
	date_default_timezone_set("Asia/Colombo");
	include('connection/config.php');
	if(!isset($_SESSION))
	{
		session_start();
	}

    if (isset($_GET['option']))
	{
		if ($_GET['option'] == "email_check") 
		{
            $emailex=$_GET['email'];
			$sql="SELECT email FROM user where email='$emailex'";
			$sqlresult=mysqli_query($con,$sql) or die("error in select email".mysqli_error());			
			if(mysqli_num_rows($sqlresult)>0)
			{ 
				echo 'This Email account already exist Try Diffrent or Reset';
			}
			else
			{
				echo "Allowed";
			}			
		}
    }

 ?>

