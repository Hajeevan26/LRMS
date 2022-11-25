<?php
include('connection/config.php');
if(!isset($_SESSION))
{
	session_start();
}
$role_id=$_SESSION['role_id'];
$user_id=$_SESSION['user_id'];
if(isset($_POST["btnsave"]))
{
    if(isset($_POST["gender"])){
        $gender=$_POST["gender"];
        if($gender == "male")
        {
            $gender="male";
        }
        else if ($gender == "female")
        {
            $gender="female";
        }
    }
    $password=md5($_POST["password"]);
    if(isset($_POST['status'])) { $status="active"; } else {  $status="inactive"; }
	$sqlCmd="INSERT into tbl_researchers (c_id,c_name,email,password,nic,status,gender,tp_no) Values(
                                                                '".mysqli_real_escape_string($con,$_POST["c_id"])."',
                                                               '".mysqli_real_escape_string ($con,$_POST["c_name"])."',
                                                               '".mysqli_real_escape_string ($con,$_POST["email"])."',
                                                               '".mysqli_real_escape_string ($con,$password)."',
                                                               '".mysqli_real_escape_string ($con,$_POST["nic"])."',
                                                               '".mysqli_real_escape_string ($con,$status)."',
                                                               '".mysqli_real_escape_string ($con,$gender)."', 
                                                               '".mysqli_real_escape_string ($con,$_POST["tp_no"])."')";
	$result= mysqli_query($con,$sqlCmd) or die("SQL Error".mysqli_error($con));

    $sqluser="INSERT into user (user_id,password,role_id,user_name,email,tp_no) Values(
        '".mysqli_real_escape_string($con,$_POST["c_id"])."',
     '".mysqli_real_escape_string($con,$password)."',
     '".mysqli_real_escape_string($con,"R04")."',
     '".mysqli_real_escape_string($con,$_POST["c_name"])."',
     '".mysqli_real_escape_string($con,$_POST["email"])."', 
       '".mysqli_real_escape_string ($con,$_POST["tp_no"])."')";
    $resultuser= mysqli_query($con,$sqluser) or die("SQL Error".mysqli_error($con)); 

	if($result && $resultuser)
	{
		echo '<script>alert("your data added successfully");window.location.href="index1.php?pg=researchers.php&option=view";</script>';
		
	}
}
//start Update part in branch
if(isset($_POST['btnupdate']))
{
	$c_id=$_POST['c_id'];
    if(isset($_POST["gender"])){
        $gender=$_POST["gender"];
        if($gender == "male")
        {
            $gender="male";
        }
        else if ($gender == "female")
        {
            $gender="female";
        }
    }
    $password=md5($_POST["password"]);
    if(isset($_POST['status'])) { $status="active"; } else {  $status="inactive"; }
	$sqlupdatefaculty="UPDATE tbl_researchers SET 
					
					c_name='".mysqli_real_escape_string ($con,$_POST["c_name"])."',
					email='".mysqli_real_escape_string($con,$_POST['email'])."',
					password='".mysqli_real_escape_string($con,$password)."',
                    nic='".mysqli_real_escape_string($con,$_POST['nic'])."',
                    tp_no='".mysqli_real_escape_string($con,$_POST['tp_no'])."',
                    gender='".mysqli_real_escape_string($con,$gender)."',

					status='".mysqli_real_escape_string($con,$status)."' where c_id='$c_id'";
		$resultfaculty=mysqli_query($con,$sqlupdatefaculty)or die("error in update vehicle part:".mysqli_error($con));
$action="Add Update Reserachers";

$sqlupdatefaculty="UPDATE user SET 
					
					user_name='".mysqli_real_escape_string ($con,$_POST["c_name"])."',
					email='".mysqli_real_escape_string($con,$_POST['email'])."',
					password='".mysqli_real_escape_string($con,$password)."',
                   
                    tp_no='".mysqli_real_escape_string($con,$_POST['tp_no'])."',
                   

					status='".mysqli_real_escape_string($con,$status)."' where user_id='$c_id'";
		$resultfaculty=mysqli_query($con,$sqlupdatefaculty)or die("error in update user part:".mysqli_error($con));
$action="Add Update Reserachers";


//include('userlog.php');		
	if($resultfaculty)
	{
		echo'<script> alert("your data updated successfully");window.location.href="index1.php?pg=researchers.php&option=view";</script>';
		
	}
}
//End Update part in vehicle
if (isset($_GET['option']))
{
	//start insert Form in vehicle
	if ($_GET['option']=="new")
	{?>
<div class="content">
    <div class="container-fluid">
        <h2>Researchers Information</h2>
        <form role="form" action="" method="post">
            <div class="card card-primary">
                <div class="card-header">
                </div>
                <div class="card-body">
                    <input type="hidden" id="household_id" name="household_id" value="<?php //echo $household_id; ?>">
                    <div class="row">
                        <div class="col-md-6">
                            <label>User ID</label>
                            <?php
                                 $sql1 = "SELECT user_id FROM user WHERE user_id LIKE 'C%' order by user_id DESC";
                                $result1 = mysqli_query($con, $sql1) or die("error in insert Faculty Id:" . mysqli_error($con));
                                $row = mysqli_fetch_assoc($result1);
                                // $c_id = $row['user_id'];
                                if (mysqli_num_rows($result1) > 0) 
                                {
                                    $c_id = $row['user_id'];
                                    $c_id = ++$c_id;
                                } 
                                else 
                                {
                                // $SUFFIX = '0001 ';
                                    $c_id = "C001";
                                }
                                ?>
                            <div class="col-md-6"><input type="text" name="c_id" id="c_id" value="<?php echo $c_id; ?>"
                                    readonly class="form-control" />
                            </div>

                        </div>
                        <div class="col-md-6">
                            <label>Faculty name</label>

                            <div><input type="text" name="c_name" id="c_name" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Email</label>
                            <div class="col-md-6"><input type="email" name="email" id="email" class="form-control" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Password</label>
                            <div><input type="text" name="password" id="password" placeholder="Password"
                                    class="form-control" />

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>NIC</label>
                            <div class="col-md-6"><input type="text" name="nic" id="nic" class="form-control" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Contact No</label>
                            <div><input type="text" name="tp_no" id="tp_no" placeholder="0771234567"
                                    onblur="validatetp()" class="form-control" />
                                <font color="red">
                                    <div id="tperrormsg"></div>
                                </font>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" checked>
                                <label class="form-check-label">Male</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender">
                                <label class="form-check-label">Female</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Status</label>
                            <div>
                                <!-- <input type="checkbox" name="my-checkbox" checked data-bootstrap-switch> -->
                                <input type="checkbox" name="status" id="status" checked data-bootstrap-switch
                                    data-off-color="danger" data-on-color="success">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-footer">
                    <a href="index1.php?pg=researchers.php&option=view"><button type="button" class="btn btn-danger"><i
                                class="ace-icon glyphicon glyphicon-remove"></i>Cancel</button> </a>
                    <button type="reset" class="btn btn-default">Reset Button</button>
                    <button type="submit" name="btnsave" id="btnsave" class="btn btn-primary float-right">Submit
                        Button</button>
                </div>
        </form>
    </div>
</div>
</div>
</div>
<?php
	}

	if ($_GET['option']=="view")
	{?>
<div class="content">
    <div class="container-fluid">
        <form role="form" action="" method="post">
            <div class="row">
                <div class="col-sm-9"></div>
                <div class="col-sm-3"> <a href="index1.php?pg=researchers.php&option=new">
                        <button type=button class="btn btn-block bg-gradient-success"><i
                                class="ace-icon fa fa-trash-o bigger-120"></i>new</button></a></div>
            </div>
            <br>
            <div class="card card-primary">
                <div class="card-header">
                Researchers Information
                </div>
                <div class="card-body">


                    <?php  
                    $sqlview="SELECT * FROM tbl_researchers ";
                    $result=mysqli_query($con,$sqlview) or die("@error in view part:".mysqli_error($con));
                    //$row=mysqli_fetch_assoc($result);
  ?>

                    <input class="form-control" id="myInput" type="text" placeholder="Search..">
                    <br>
                    <table name="employeeTable" id="employeeTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Password</th>
                                <!-- <th>NIC</th> -->
                                <th>Mobile</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="myTable">
                            <?php while($row=mysqli_fetch_assoc($result)) {
      echo '<tr> <td>'
      .$row['c_id'].'</td><td>'
      .$row['c_name'].'</td><td>'
      .$row['email'].'</td><td>' 
      .$row['password'].'</td><td>' 
    //   .$row['nic'].'</td><td>' 
      .$row['tp_no'].'</td><td>' 
      .$row['status'].'</td>'; 
      echo'<td><a href="index1.php?pg=researchers.php&option=find&c_id='.$row['c_id'].'">
								<button type=button class="btn btn-xs btn-purple"><i class="ace-icon fa  fa-eye"></i>View</button></a>';
                echo'<a href="index1.php?pg=researchers.php&option=edit&c_id='.$row['c_id'].'">
								<button type=button class="btn btn-xs btn-primary"><i class="ace-icon fa fa-pencil-square-o bigger-120"></i>Edit</button></a>';
                echo'<a href="index1.php?pg=researchers.php&option=delete&c_id='.$row['c_id'].'">
								<button type=button class="btn btn-xs btn-danger" onClick="return deleteconfirm()"><i class="ace-icon fa fa-trash-o bigger-120"></i>Delete</button></a></td></tr>';
							}
              ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </form>
    </div>
</div>
</div>
</div>
<?php
	}

	if ($_GET['option']=="edit")
	{   $c_id=$_GET['c_id'];
        $sqlview="SELECT * FROM tbl_researchers where c_id='$c_id'";
        $result=mysqli_query($con,$sqlview) or die("@error in view part:".mysqli_error($con));
        $row=mysqli_fetch_assoc($result);
      ?>
<div class="content">
    <div class="container-fluid">
        <h2>Researchers Information</h2>
        <form role="form" action="" method="post">
            <div class="card card-primary">
                <div class="card-header">
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-6">
                            <label> ID</label>

                            <div class="col-md-6"><input type="text" name="c_id" id="c_id"
                                    value="<?php echo $row['c_id']; ?>" readonly class="form-control" />
                            </div>

                        </div>
                        <div class="col-md-6">
                            <label>Name</label>
                            <div><input type="text" name="c_name" id="c_name" value="<?php echo $row['c_name']; ?>"
                                    class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Email</label>
                            <div class="col-md-6"><input type="email" name="email" id="email" class="form-control" value="<?php echo $row['email']; ?>" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Password</label>
                            <div><input type="text" name="password" id="password" required placeholder="Password" 
                                    class="form-control" />

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>NIC</label>
                            <div class="col-md-6"><input type="text" name="nic" id="nic" class="form-control" value="<?php echo $row['nic']; ?>"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Contact No</label>
                            <div><input type="text" name="tp_no" id="tp_no" placeholder="0771234567" value="<?php echo $row['tp_no']; ?>"
                                    onblur="validatetp()" class="form-control" />
                                <font color="red">
                                    <div id="tperrormsg"></div>
                                </font>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" <?=$row['gender']=="male" ? "checked" : ""?> value="male">
                                <label class="form-check-label">Male</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" <?=$row['gender']=="female" ? "checked" : ""?> value="female">
                                <label class="form-check-label">Female</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Status</label>
                            <div>
                                <!-- <input type="checkbox" name="my-checkbox" checked data-bootstrap-switch> -->
                                <input type="checkbox" name="status" id="status" <?=$row['status']=="active" ? "checked" : ""?> data-bootstrap-switch
                                    data-off-color="danger" data-on-color="success">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="index1.php?pg=researchers.php&option=view"><button type="button" class="btn btn-danger"><i
                                class="ace-icon glyphicon glyphicon-remove"></i>Cancel</button> </a>
                    <button type="reset" class="btn btn-default">Reset Button</button>
                    <button type="submit" name="btnupdate" id="btnupdate" class="btn btn-primary float-right">Submit
                        Button</button>
                </div>
        </form>
    </div>
</div>
</div>
</div>
<?php
	}
	if ($_GET['option']=="find")
	{
		$c_id=$_GET['c_id'];
		$sql3="select * from tbl_researchers where c_id='$c_id'";
		$result3=mysqli_query($con,$sql3)or die("error in Find faculty Id:".mysqli_error($con));
		$row=mysqli_fetch_assoc($result3);
		?>

<div class="content">
    <div class="container-fluid">

        <form role="form" action="" method="post">
            <div class="card card-primary">
                <div class="card-header"> Researchers Information </div>
                <div class="card-body">
                    <div class="col-xs-6">
                        <table class="table table-striped table-bordered table-hover">
                            <tr>
                                <td>Researcher Id</td>
                                <td><?php echo $row['c_id'];?></td>
                            </tr>
                            <tr>
                                <td>Researcher Name</td>
                                <td><?php echo $row['c_name'];?></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td><?php echo $row['email'];?></td>
                            </tr>
                            <tr>
                                <td>NIC</td>
                                <td><?php echo $row['nic'];?></td>
                            </tr>
                            <tr>
                                <td>Gender</td>
                                <td><?php echo $row['gender'];?></td>
                            </tr>
                            <tr>
                                <td>Contact</td>
                                <td><?php echo $row['tp_no'];?></td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td><?php echo $row['status'];?></td>
                            </tr>
                        </table>
                        <?php
	if(!isset($_GET['pr']))
	{
        $c_id=$row['c_id'];
		if($role_id=="R01")
		{  ?>
                        <a href="index1.php?pg=researchers.php&option=edit&c_id=<?php echo $c_id; ?>"><button type="button"
                                class="btn btn-primary btn-xs"><i class="ace-icon fa fa-pencil-square-o bigger-125"></i>
                                Edit</button></a>
                        <?php
		} ?>
                        <a href="index1.php?pg=researchers.php&option=view"><button type="button"
                                class="btn btn-pink btn-xs"><i class="ace-icon fa fa-undo bigger-125"></i> Go
                                Back</button></a>
                        <a href="print.php?pr=researchers.php&option=find&c_id=<?php echo $c_id; ?>"><button type="button"
                                class="btn btn-purple btn-xs"><i
                                    class="ace-icon fa fa-print  align-top bigger-125 icon-on-right"></i>
                                Print</button></a>
                        <?php
	} ?>
                    </div>
                </div>
            </div>
    </div>
</div>
</div>
<?php
	}
	if ($_GET['option']=="delete")
	{
		$c_id=$_GET['c_id'];
        $del="deteted";
        $sqlupdatefaculty="UPDATE tbl_researchers SET   
        status='".mysqli_real_escape_string($con,$del)."' where c_id='$c_id'";
$resultfaculty=mysqli_query($con,$sqlupdatefaculty)or die("error in Delete vehicle part:".mysqli_error($con));
$action="Faculty Deletion";

	if($resultfaculty)
	{
		
		echo'<script> alert("your data successfully deleted");window.location.href="index1.php?pg=researchers.php&option=view";</script>';
		
	}
	}
}
?>