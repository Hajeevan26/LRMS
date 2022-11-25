<?php
// Include the database connection file
include('connection/config.php');

if (isset($_POST['f_id']) && !empty($_POST['f_id'])) {

	// Fetch state name base on country id
	$f_id=$_POST['f_id'];
	$query = "SELECT * FROM tbl_department WHERE f_id = '$f_id'";
	$result = $con->query($query);

	if ($result->num_rows > 0) {
		echo '<option value="">Select Department</option>'; 
		while ($row = $result->fetch_assoc()) {
			echo '<option value="'.$row['d_id'].'">'.$row['d_name'].'</option>'; 
		}
	} else {
		echo '<option value="">Department not available</option>'; 
	}

} if(isset($_POST['dep_id']) && !empty($_POST['dep_id'])) {

	// Fetch city name base on state id
	$dep_id=$_POST['dep_id'];
	echo '<script> alert($dep_id);</script>';
	$query = "SELECT * FROM tbl_instruments WHERE d_id = '$dep_id'";
	$result = $con->query($query);

	if ($result->num_rows > 0) {
		echo '<option value="">Select Instruments</option>'; 
		while ($row = $result->fetch_assoc()) {
			echo '<option value="'.$row['id'].'">'.$row['name'].'</option>'; 
		}
	} else {
		echo '<option value="">Instruments not available</option>'; 
	}
}

// edit
if (isset($_POST['f_ide']) && !empty($_POST['f_ide'])) {

	// Fetch state name base on country id
	$f_ide=$_POST['f_ide'];
	$txtd_id=$_POST['txtd_id'];
	//$txtd_ide=$_POST['txtd_id'];
	
		$query = "SELECT * FROM tbl_department WHERE f_id = '$f_ide'";

	
	$result = $con->query($query);

	if ($result->num_rows > 0) 
	{
		//echo '<option value="">Select Department</option>'; 
		while ($row = $result->fetch_assoc()) 
		{
			if($txtd_id==$row['d_id']) 
			{
				echo'<option selected value="'.$row['d_id'].'">'.$row['d_name'].'</option>';

			}
			else {
				echo '<option value="'.$row['d_id'].'">'.$row['d_name'].'</option>'; 
			}
			
		}
	} 
	
	else 
	{
		echo '<option value="">Department not available</option>'; 
	}
	
} if(isset($_POST['dep_ide']) && !empty($_POST['dep_ide'])) {

	// Fetch city name base on state id
	 $dep_ide=$_POST['dep_ide'];
	$txti_id=$_POST['txti_id'];
	
		$query = "SELECT * FROM tbl_instruments WHERE d_id = '$dep_ide'";
	
	$result = $con->query($query);

	if ($result->num_rows > 0) {
		echo '<option value="">Select Instruments</option>'; 
		while ($roww = $result->fetch_assoc()) 
		{
			if($txti_id==$roww['id']) 
	 		{
	 			echo '<option selected value="'.$roww['id'].'">'.$roww['name'].'</option>'; 
	 		}
			else 
	 		{
	 			echo '<option value="'.$roww['id'].'">'.$roww['name'].'</option>'; 
	 		}
	 	}
	 } 
	 else {
		echo '<option value="">Instruments not available</option>'; 
	 }
}

if(isset($_POST['d_idei']) && !empty($_POST['d_idei'])) {

	// Fetch city name base on state id
	$d_idei=$_POST['d_idei'];
	//$txti_id=$_POST['txti_id'];
	
		$query = "SELECT * FROM tbl_instruments WHERE d_id = '$d_idei'";
	
	$result = $con->query($query);

	if ($result->num_rows > 0) {
		//echo '<option value="">Select Instruments</option>'; 
		while ($roww = $result->fetch_assoc()) 
		{
			//if($txti_id==$roww['id']) 
			//{
				//echo '<option selected value="'.$roww['id'].'">'.$roww['name'].'</option>'; 
			//}
			//else 
			//{
				echo '<option value="'.$roww['id'].'">'.$roww['name'].'</option>'; 
			//}
		}
	} else {
		echo '<option value="">Instruments not available</option>'; 
	}
}


?>