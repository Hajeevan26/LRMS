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
	$sqlCmd="INSERT into tbl_faculty (f_id,f_name,dean,tp_no) Values(
                                                                '".mysqli_real_escape_string($con,$_POST["f_id"])."',
                                                               '".mysqli_real_escape_string ($con,$_POST["f_name"])."',
                                                               '".mysqli_real_escape_string ($con,$_POST["dean"])."',
                                                               '".mysqli_real_escape_string ($con,$_POST["tp_no"])."')";
	$result= mysqli_query($con,$sqlCmd) or die("SQL Error".mysqli_error($con));
	if($result)
	{
		echo '<script>alert("your data added successfully");window.location.href="index1.php?pg=faculty.php&option=view";</script>';
		
	}
}
//start Update part in branch
if(isset($_POST['btnupdate']))
{
	$f_id=$_POST['f_id'];
	$sqlupdatefaculty="UPDATE tbl_faculty SET 
					
					f_name='".mysqli_real_escape_string ($con,$_POST["f_name"])."',
					dean='".mysqli_real_escape_string($con,$_POST['dean'])."',
					
					tp_no='".mysqli_real_escape_string($con,$_POST['tp_no'])."' where f_id='$f_id'";
		$resultfaculty=mysqli_query($con,$sqlupdatefaculty)or die("error in update vehicle part:".mysqli_error($con));
$action="Add Update vehicle";

//mail



//include('userlog.php');		
	if($resultfaculty)
	{
		echo'<script> alert("your data updated successfully");window.location.href="index1.php?pg=faculty.php&option=view";</script>';
		
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
        <h2>Faculty Information</h2>
        <form role="form" action="" method="post">
            <div class="card card-primary">
                <div class="card-header">
                </div>
                <div class="card-body">
                    <input type="hidden" id="household_id" name="household_id" value="<?php //echo $household_id; ?>">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Faculty ID</label>
                            <?php
                                $sql1 = "select f_id from tbl_faculty  order by f_id DESC";
                                $result1 = mysqli_query($con, $sql1) or die("error in insert Faculty Id:" . mysqli_error($con));
                                $row = mysqli_fetch_assoc($result1);
                                $f_id = $row['f_id'];
                                if (mysqli_num_rows($result1) > 0) 
                                {
                                    $f_id = ++$f_id;
                                } 
                                else 
                                {
                                // $SUFFIX = '0001 ';
                                    $f_id = "F001";
                                }
                                ?>
                            <div class="col-md-6"><input type="text" name="f_id" id="f_id" value="<?php echo $f_id; ?>"
                                    readonly class="form-control" />
                            </div>

                        </div>
                        <div class="col-md-6">
                            <label>Faculty name</label>

                            <div><input type="text" name="f_name" id="f_name" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Dean</label>

                            <div class="col-md-6"><input type="text" name="dean" id="dean" class="form-control" />
                            </div>

                        </div>
                        <div class="col-md-6">
                            <label>Contact No</label>
                            <div><input type="text" name="tp_no" id="tp_no" placeholder="0771234567" onblur="validatetp()" class="form-control" />
                            <font color="red"><div id="tperrormsg"></div></font>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                <a href="index1.php?pg=faculty.php&option=view"><button type="button" class="btn btn-danger"><i class="ace-icon glyphicon glyphicon-remove"></i>Cancel</button> </a>
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
                <div class="col-sm-3"> <a href="index1.php?pg=faculty.php&option=new">
                        <button type=button class="btn btn-block bg-gradient-success"><i
                                class="ace-icon fa fa-trash-o bigger-120"></i>new</button></a></div>
            </div>
            <br>
            <div class="card card-primary">
                <div class="card-header">
                    Faculty Information
                </div>
                <div class="card-body">


                    <?php  
                    $sqlview="SELECT * FROM tbl_faculty where status='active'";
                    $result=mysqli_query($con,$sqlview) or die("@error in view part:".mysqli_error($con));
                    //$row=mysqli_fetch_assoc($result);
  ?>

                    <input class="form-control" id="myInput" type="text" placeholder="Search..">
                    <br>
                    <table name="employeeTable" id="employeeTable"  class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Faculty ID</th>
                                <th>Faculty Name</th>
                                <th>Name of Dean</th>
                                <th>Contact Details</th>

                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="myTable">
                            <?php while($row=mysqli_fetch_assoc($result)) {
      echo '<tr> <td>'
      .$row['f_id'].'</td><td>'
      .$row['f_name'].'</td><td>'
      .$row['dean'].'</td><td>' 
    
      .$row['tp_no'].'</td>'; 
      echo'<td><a href="index1.php?pg=faculty.php&option=find&f_id='.$row['f_id'].'">
								<button type=button class="btn btn-xs btn-purple"><i class="ace-icon fa  fa-eye"></i>View</button></a>';
                echo'<a href="index1.php?pg=faculty.php&option=edit&f_id='.$row['f_id'].'">
								<button type=button class="btn btn-xs btn-primary"><i class="ace-icon fa fa-pencil-square-o bigger-120"></i>Edit</button></a>';
                echo'<a href="index1.php?pg=faculty.php&option=delete&f_id='.$row['f_id'].'">
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
	{   $f_id=$_GET['f_id'];
        $sqlview="SELECT * FROM tbl_faculty where f_id='$f_id'";
        $result=mysqli_query($con,$sqlview) or die("@error in view part:".mysqli_error($con));
        $row=mysqli_fetch_assoc($result);
      ?>
<div class="content">
    <div class="container-fluid">
        <h2>Faculty Information</h2>
        <form role="form" action="" method="post">
            <div class="card card-primary">
                <div class="card-header">
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-6">
                            <label>Faculty ID</label>

                            <div class="col-md-6"><input type="text" name="f_id" id="f_id"
                                    value="<?php echo $row['f_id']; ?>" readonly class="form-control" />
                            </div>

                        </div>
                        <div class="col-md-6">
                            <label>Faculty name</label>

                            <div><input type="text" name="f_name" id="f_name" value="<?php echo $row['f_name']; ?>"
                                    class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Dean</label>

                            <div class="col-md-6"><input type="text" name="dean" id="dean"
                                    value="<?php echo $row['dean']; ?>" class="form-control" />
                            </div>

                        </div>
                        <div class="col-md-6">
                            <label>Contact No</label>
                            <div><input type="text" name="tp_no" id="tp_no" value="<?php echo $row['tp_no']; ?>"
                                    class="form-control" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                <a href="index1.php?pg=faculty.php&option=view"><button type="button" class="btn btn-danger"><i class="ace-icon glyphicon glyphicon-remove"></i>Cancel</button> </a>
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
		$f_id=$_GET['f_id'];
		$sql3="select * from tbl_faculty where f_id='$f_id'";
		$result3=mysqli_query($con,$sql3)or die("error in Find faculty Id:".mysqli_error($con));
		$row=mysqli_fetch_assoc($result3);
		?>

<div class="content">
    <div class="container-fluid">

        <form role="form" action="" method="post">
            <div class="card card-primary">
                <div class="card-header"> Faculty Information </div>
                <div class="card-body">
                    <div class="col-xs-6">
                        <table class="table table-striped table-bordered table-hover">
                            <tr>
                                <td>faculty Id</td>
                                <td><?php echo $row['f_id'];?></td>
                            </tr>
                            <tr>
                                <td>Faculty Name</td>
                                <td><?php echo $row['f_name'];?></td>
                            </tr>
                            <tr>
                                <td>Name Of Dean</td>
                                <td><?php echo $row['dean'];?></td>
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
        $f_id=$row['f_id'];
		if($role_id=="R01")
		{  ?>
                        <a href="index1.php?pg=faculty.php&option=edit&f_id=<?php echo $f_id; ?>"><button type="button"
                                class="btn btn-primary btn-xs"><i class="ace-icon fa fa-pencil-square-o bigger-125"></i>
                                Edit</button></a>
                        <?php
		} ?>
                        <a href="index1.php?pg=faculty.php&option=view"><button type="button"
                                class="btn btn-pink btn-xs"><i class="ace-icon fa fa-undo bigger-125"></i> Go
                                Back</button></a>
                        <a href="print.php?pr=faculty.php&option=find&f_id=<?php echo $f_id; ?>"><button type="button"
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
		$f_id=$_GET['f_id'];
        $del="deteted";
        $sqlupdatefaculty="UPDATE tbl_faculty SET   
        status='".mysqli_real_escape_string($con,$del)."' where f_id='$f_id'";
$resultfaculty=mysqli_query($con,$sqlupdatefaculty)or die("error in Delete vehicle part:".mysqli_error($con));
$action="Faculty Deletion";

	if($resultfaculty)
	{
		
		echo'<script> alert("your data successfully deleted");window.location.href="index1.php?pg=faculty.php&option=view";</script>';
		
	}
	}
}
?>