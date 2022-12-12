<?php
	date_default_timezone_set("Asia/Colombo");
	include('connection/config.php');
	if(!isset($_SESSION))
	{
		session_start();
	}
	$role_id=$_SESSION['role_id'];
	
	$user_id=$_SESSION['user_id'];
	
	if (isset($_GET['option']))
	{
		if ($_GET['option'] == "viewinstruments") 
		{
           
            $f_id = $_GET['f_id'];
			$d_id = $_GET['d_id'];

            $sql1 = "select * from tbl_instruments where d_id='$d_id'and f_id='$f_id'";
           
			$result = mysqli_query($con,$sql1) or die("error part:" . mysqli_error($con));
          //echo'  <label>Select Instrumentd</label>';
			echo' <select id="instrument_id" name="instrument_id" class="form-control">';
            echo'<option value="select">Select Instruments</option>';

            while($row1=mysqli_fetch_assoc($result))
            {
                echo'<option value="'.$row1['id'].'">'.$row1['name'].'</option>';
            }
            echo'</select>'; 
        }

		else if ($_GET['option'] == "viewdepartment") 
		{
           
            $f_id = $_GET['f_id'];
			//$d_id = $_GET['d_id'];

            $sql1 = "select * from tbl_department where f_id='$f_id'";
           
			$result = mysqli_query($con,$sql1) or die("error part:" . mysqli_error($con));
          //echo'  <label>Name of the Department</label>';
		  echo'<select id="d_idd" name="d_idd" class="chosen-select form-control">';
            //echo'<option value="select">Select Instruments</option>';

            while($row1=mysqli_fetch_assoc($result))
            {
                echo'<option value="'.$row1['d_id'].'">'.$row1['d_name'].'</option>';
            }
            echo'</select>'; 
        }
		else if ($_GET['option'] == "viewdepartment1") 
		{
           
            $f_id = $_GET['f_id'];
			//$d_id = $_GET['d_id'];

            $sql1 = "select * from tbl_department where f_id='$f_id'";
           
			$result = mysqli_query($con,$sql1) or die("error part:" . mysqli_error($con));
       
		
		 echo'<select id="d_idd" name="d_idd" class="selectpicker" data-show-subtext="true" data-live-search="true">';
            

            while($row1=mysqli_fetch_assoc($result))
			if($row['d_id']==$row1['d_id'])
			{
				echo'<option value="'.$row1['d_id'].'" selected>'.$row1['d_name'].'</option>';
			}
			else
			{
				echo'<option value="'.$row1['d_id'].'">'.$row1['d_name'].'</option>';
			}
			
            echo'</select>'; 
        }

		else if ($_GET['option'] == "viewdepartmentren") 
		{
           
            $f_id = $_GET['f_id'];
			//$d_id = $_GET['d_id'];

            $sql2="select DISTINCT d_id ,d_name from tbl_department where f_id='$f_id'";
			$result2=mysqli_query($con,$sql2) or die("error in select tbl_department:".mysqli_error());
			echo'<select id="d_idd" name="d_idd" class="chosen-select form-control col-md-10" onChange="updateinstrument()">';
			//echo'<option value="select">Select Department</option>';
			while($row1=mysqli_fetch_assoc($result2))
			{
				echo'<option value="'.$row1['d_id'].'">'.$row1['d_name'].'</option>';
			}
			echo'</select>';
        }
		
       
    }

 ?>