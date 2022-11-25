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
    $password=md5($_POST["tp_no"]);
    if(isset($_POST['status'])) { $status="active"; } else { $status="inactive"; }
	$sqlCmd="INSERT into tbl_staff (s_id,s_name,s_email,tp_no,role_id,d_id,status) Values(
                                                                '".mysqli_real_escape_string($con,$_POST["s_id"])."',
                                                             '".mysqli_real_escape_string($con,$_POST["s_name"])."',
                                                             '".mysqli_real_escape_string($con,$_POST["email"])."',
                                                             '".mysqli_real_escape_string($con,$_POST["tp_no"])."',
                                                             '".mysqli_real_escape_string($con,$_POST["role_id"])."',
                                                             '".mysqli_real_escape_string($con,$_POST["d_id"])."',
                                                               '".mysqli_real_escape_string ($con,$status)."')";
	$result= mysqli_query($con,$sqlCmd) or die("SQL Error".mysqli_error($con));

    $sqluser="INSERT into user (user_id,password,role_id,user_name,email,tp_no) Values(
        '".mysqli_real_escape_string($con,$_POST["s_id"])."',
     '".mysqli_real_escape_string($con,$password)."',
     '".mysqli_real_escape_string($con,$_POST["role_id"])."',
     '".mysqli_real_escape_string($con,$_POST["s_name"])."',
     '".mysqli_real_escape_string($con,$_POST["email"])."', 
       '".mysqli_real_escape_string ($con,$_POST["tp_no"])."')";
    $resultuser= mysqli_query($con,$sqluser) or die("SQL Error".mysqli_error($con)); 

	if($result &&  $resultuser)
	{
		echo '<script>alert("Staff added successfully");window.location.href="index1.php?pg=staff.php&option=view";</script>';
		
	}
}
//start Update part in branch
if(isset($_POST['btnupdate']))
{
	$s_id=$_POST['s_id'];
    if(isset($_POST['status'])) { $status="active"; } else { $status="inactive"; }
    $password=md5($_POST["tp_no"]);
	$sqlupdatedepartment="UPDATE tbl_staff SET 
    d_id='".mysqli_real_escape_string($con,$_POST['d_id'])."',
    s_email='".mysqli_real_escape_string($con,$_POST['email'])."',
    tp_no='".mysqli_real_escape_string($con,$_POST['tp_no'])."',
    role_id='".mysqli_real_escape_string($con,$_POST['role_id'])."',
    status='".mysqli_real_escape_string($con,$status)."',
	s_name='".mysqli_real_escape_string($con,$_POST['s_name'])."' where s_id='$s_id'";
	$resultdepartment=mysqli_query($con,$sqlupdatedepartment)or die("error in update department part:".mysqli_error($con));

    $sqlupdateuser="UPDATE user SET 
    password='".mysqli_real_escape_string($con,$password)."',
    email='".mysqli_real_escape_string($con,$_POST['email'])."',
    tp_no='".mysqli_real_escape_string($con,$_POST['tp_no'])."',
    role_id='".mysqli_real_escape_string($con,$_POST['role_id'])."',
    status='".mysqli_real_escape_string($con,$status)."',
	user_name='".mysqli_real_escape_string($con,$_POST['user_name'])."' where user_id='$s_id'";
	$resultuser=mysqli_query($con,$sqlupdateuser)or die("error in update department part:".mysqli_error($con));

    $action="Update staff";
//include('userlog.php');		
	if($resultdepartment && $resultuser)
	{
		echo'<script> alert("Staff updated successfully");window.location.href="index1.php?pg=staff.php&option=view";</script>';
		
	}
}
//End Update part in department
if (isset($_GET['option']))
{
	//start insert Form in department
	if ($_GET['option']=="new")
	{?>
<div class="content">
    <div class="container-fluid">
        <h2>Staff Information</h2>
        <form role="form" action="" method="post">
            <div class="card card-primary">
                <div class="card-header">
                </div>
                <div class="card-body">
                    <input type="hidden" id="househols_id" name="househols_id" value="<?php //echo $househols_id; ?>">
                    <div class="row">


                        <?php
                                 $sql1 = "SELECT user_id FROM user WHERE user_id LIKE 'S%' order by user_id DESC";
                                $result1 = mysqli_query($con, $sql1) or die("error in insert department Id:" . mysqli_error($con));
                                $row = mysqli_fetch_assoc($result1);
                               
                                if (mysqli_num_rows($result1) > 0) 
                                {
                                    $s_id = $row['user_id'];
                                    $s_id = ++$s_id;
                                } 
                                else 
                                {
                                // $SUFFIX = '0001 ';
                                    $s_id = "S001";
                                }
                                ?>
                        <div><input type="hidden" name="s_id" id="s_id" value="<?php echo $s_id; ?>" readonly class="form-control" /> </div>
                        <div class="col-md-4">
                            <label>Department</label>
                            <div class="row">
                                <?php
								$sql2="select DISTINCT d_id ,d_name from tbl_department";
								$result2=mysqli_query($con,$sql2) or die("error in select tbl_faculty:".mysqli_error());
								echo'<select id="d_id" name="d_id" class="form-control" onChange="updateinstrument()">';
								//echo'<option value="select">Select Role</option>';
								while($row1=mysqli_fetch_assoc($result2))
								{
									echo'<option value="'.$row1['d_id'].'">'.$row1['d_name'].'</option>';
								}
								echo'</select>';
							?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Staff name</label>

                            <div><input type="text" name="s_name" id="s_name" class="form-control" />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label>email</label>
                            <div><input type="email" name="email" id="email" onblur="emailexist()" required class="form-control" /> </div>
                            <font color="red">
                        <div id="dividemail"></div>
                    </font>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Role</label>
                            <div class="row">
                                <?php
								$sql2="select DISTINCT role_id ,role_name from user_role";
								$result2=mysqli_query($con,$sql2) or die("error in select tbl_faculty:".mysqli_error());
								echo'<select id="role_id" name="role_id" class="form-control" onChange="updateinstrument()">';
								//echo'<option value="select">Select Role</option>';
								while($row1=mysqli_fetch_assoc($result2))
								{
									echo'<option value="'.$row1['role_id'].'">'.$row1['role_name'].'</option>';
								}
								echo'</select>';
							?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Mobile</label>
                            <div><input type="text" name="tp_no" placeholder="0771234567" required id="tp_no" onblur="validatetp()" class="form-control" /> 
                            <font color="red"><div id="tperrormsg"></div></font>
                        </div>
                        </div>
                        <div class="col-md-4">
                            <label>Active Status</label>
                            <div>
                                <!-- <input type="checkbox" name="my-checkbox" checked data-bootstrap-switch> -->
                                <input type="checkbox" name="status" id="status" checked data-bootstrap-switch
                                    data-off-color="danger" data-on-color="success">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-footer">
                <a href="index1.php?pg=staff.php&option=view"><button type="button" class="btn btn-danger"><i class="ace-icon glyphicon glyphicon-remove"></i>Cancel</button> </a>
                    <button type="reset" class="btn btn-default">Reset Button</button>
                    <button type="submit" name="btnsave" id="btnsave" class="btn btn-primary float-right">Save</button>
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
                <div class="col-sm-3"> <a href="index1.php?pg=staff.php&option=new">
                        <button type=button class="btn btn-block bg-gradient-success"><i
                                class="ace-icon fa fa-trash-o bigger-120"></i>new</button></a></div>
            </div>
            <br>
            <div class="card card-primary">
                <div class="card-header">
                    department Information
                </div>
                <div class="card-body">


                    <?php  
                    $sqlview="SELECT * FROM tbl_staff";
                    $result=mysqli_query($con,$sqlview) or die("@error in view part:".mysqli_error($con));
                    //$row=mysqli_fetch_assoc($result);
  ?>

                    <input class="form-control" id="myInput" type="text" placeholder="Search..">
                    <br>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Staff ID</th>
                                <th>Staff Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="myTable">
                            <?php while($row=mysqli_fetch_assoc($result)) {
                                    $role_idd=$row['role_id'];
                                 $sqlvieww="SELECT role_name FROM user_role where role_id='$role_idd'";
                                 $resultw=mysqli_query($con,$sqlvieww) or die("@error in view part:".mysqli_error($con));
                                 $roww=mysqli_fetch_assoc($resultw);
      echo '<tr> <td>'
      .$row['s_id'].'</td><td>'
      .$row['s_name'].'</td><td>'
      .$row['s_email'].'</td><td>'
      .$row['tp_no'].'</td><td>'
      .$roww['role_name'].'</td>'; 
      echo'<td><a href="index1.php?pg=staff.php&option=find&s_id='.$row['s_id'].'">
								<button type=button class="btn btn-xs btn-purple"><i class="ace-icon fa  fa-eye"></i>View</button></a>';
                echo'<a href="index1.php?pg=staff.php&option=edit&s_id='.$row['s_id'].'">
								<button type=button class="btn btn-xs btn-primary"><i class="ace-icon fa fa-pencil-square-o bigger-120"></i>Edit</button></a>';
                echo'<a href="index1.php?pg=staff.php&option=delete&s_id='.$row['s_id'].'">
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
	{   $s_id=$_GET['s_id'];
        $sqlview="SELECT * FROM tbl_staff where s_id='$s_id'";
        $result=mysqli_query($con,$sqlview) or die("@error in view part:".mysqli_error($con));
        $row=mysqli_fetch_assoc($result);
      ?>
<div class="content">
    <div class="container-fluid">
        <h2>Staff Information</h2>
        <form role="form" action="" method="post">
            <div class="card card-primary">
                <div class="card-header">
                </div>
                <div class="card-body">
                    <input type="text" id="s_id" name="s_id" value="<?php echo $row['s_id']; ?>"readonly class="form-control" />
                    <div class="row">


                        <?php
                                
                                ?>
                        <!-- <div><input type="hidden" name="s_id" id="s_id" value="<?php echo $row['s_id']; ?>" readonly class="form-control" /> </div> -->
                        <div class="col-md-4">
                            <label>Department</label>
                            <div class="row">
                                <?php
								$sql2="select DISTINCT d_id ,d_name from tbl_department";
								$result2=mysqli_query($con,$sql2) or die("error in select tbl_faculty:".mysqli_error());
								echo'<select id="d_id" name="d_id" class="form-control" onChange="updateinstrument()">';
								//echo'<option value="select">Select Role</option>';
								while($row1=mysqli_fetch_assoc($result2))
                                if($row['d_id']==$row1['d_id'])
								{
                                    echo'<option value="'.$row1['d_id'].'" selected>'.$row1['d_name'].'</option>';
                                }
                                else
                                {
                                    echo'<option value="'.$row1['d_id'].'">'.$row1['d_name'].'</option>';
                                }
								echo'</select>';
							?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Staff name</label>

                            <div><input type="text" name="s_name" id="s_name" value="<?php echo $row['s_name']; ?>" class="form-control" />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label>email</label>
                            <div><input type="email" name="email" id="email" value="<?php echo $row['s_email']; ?>"required class="form-control" /> </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Role</label>
                            <div class="row">
                                <?php
								$sql2="select DISTINCT role_id ,role_name from user_role";
								$result2=mysqli_query($con,$sql2) or die("error in select tbl_faculty:".mysqli_error());
								echo'<select id="role_id" name="role_id" class="form-control" onChange="updateinstrument()">';
								//echo'<option value="select">Select Role</option>';
								while($row1=mysqli_fetch_assoc($result2))
                                if($row['role_id']==$row1['role_id'])
								{
									echo'<option value="'.$row1['role_id'].'"selected>'.$row1['role_name'].'</option>';
								}
                                else
                                {
                                    echo'<option value="'.$row1['role_id'].'">'.$row1['role_name'].'</option>';
                                }
								echo'</select>';
							?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Mobile</label>
                            <div><input type="text" name="tp_no" required id="tp_no" value="<?php echo $row['tp_no']; ?>" class="form-control" /> </div>
                        </div>
                        <div class="col-md-4">
                            <label>Active Status</label>
                            <div>
                                <!-- <input type="checkbox" name="my-checkbox" checked data-bootstrap-switch> -->
                                <input type="checkbox" name="status" id="status" checked data-bootstrap-switch
                                    data-off-color="danger" data-on-color="success">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-footer">
                <a href="index1.php?pg=staff.php&option=view"><button type="button" class="btn btn-danger"><i class="ace-icon glyphicon glyphicon-remove"></i>Cancel</button> </a>
                    <button type="reset" class="btn btn-default">Reset Button</button>
                    <button type="submit" name="btnsave" id="btnsave" class="btn btn-primary float-right">Save</button>
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
		$s_id=$_GET['s_id'];
		$sql3="select S.*,UR.role_name,D.d_name from tbl_staff as S , user_role as UR ,tbl_department as D where s_id='$s_id' and UR.role_id=S.role_id and D.d_id=S.d_id";
		$result3=mysqli_query($con,$sql3)or die("error in Find department Id:".mysqli_error($con));
		$row=mysqli_fetch_assoc($result3);
		?>

<div class="content">
    <div class="container-fluid">

        <form role="form" action="" method="post">
            <div class="card card-primary">
                <div class="card-header"> department Information </div>
                <div class="card-body">
                    <div class="col-xs-6">
                        <table class="table table-striped table-bordered table-hover">
                            <tr>
                                <td>Staff Id</td>
                                <td><?php echo $row['s_id'];?></td>
                            </tr>
                            <tr>
                                <td>User Name</td>
                                <td><?php echo $row['s_name'];?></td>
                            </tr>
                            <tr>
                                <td>Department</td>
                                <td><?php echo $row['d_name'];?></td>
                            </tr>
                            <tr>
                                <td>Role Name</td>
                                <td><?php echo $row['role_name'];?></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td><?php echo $row['s_email'];?></td>
                            </tr>
                            <tr>
                                <td>Mobile</td>
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
        $s_id=$row['s_id'];
		if($role_id=="R01")
		{  ?>
                        <a href="index1.php?pg=staff.php&option=edit&s_id=<?php echo $s_id; ?>"><button type="button"
                                class="btn btn-primary btn-xs"><i class="ace-icon fa fa-pencil-square-o bigger-125"></i>
                                Edit</button></a>
                        <?php
		} ?>
                        <a href="index1.php?pg=staff.php&option=view"><button type="button"
                                class="btn btn-pink btn-xs"><i class="ace-icon fa fa-undo bigger-125"></i> Go
                                Back</button></a>
                        <a href="print.php?pr=staff.php&option=find&s_id=<?php echo $s_id; ?>"><button type="button"
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
		$s_id=$_GET['s_id'];
        $del="deteted";
        $sqlupdatedepartment="UPDATE tbl_staff SET   
        status='".mysqli_real_escape_string($con,$del)."' where s_id='$s_id'";
$resultdepartment=mysqli_query($con,$sqlupdatedepartment)or die("error in Delete department part:".mysqli_error($con));
$action="department Deletion";

	if($resultdepartment)
	{
		
		echo'<script> alert("your data successfully deleted");window.location.href="index1.php?pg=staff.php&option=view";</script>';
		
	}
	}
}
?>