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
	$sqlCmd="INSERT into tbl_department (d_id,d_name,f_id,head) Values(
                                                                '".mysqli_real_escape_string($con,$_POST["d_id"])."',
                                                             '".mysqli_real_escape_string($con,$_POST["d_name"])."',
                                                             '".mysqli_real_escape_string($con,$_POST["f_id"])."',
                                                               '".mysqli_real_escape_string ($con,$_POST["head"])."')";
	$result= mysqli_query($con,$sqlCmd) or die("SQL Error".mysqli_error($con));
	if($result)
	{
		echo '<script>alert("your data added successfully");window.location.href="index1.php?pg=department.php&option=view";</script>';
		
	}
}
//start Update part in branch
if(isset($_POST['btnupdate']))
{
	$d_id=$_POST['d_id'];
	$sqlupdatedepartment="UPDATE tbl_department SET 
    head='".mysqli_real_escape_string($con,$_POST['head'])."',
     f_id='".mysqli_real_escape_string($con,$_POST['f_id'])."',
					d_name='".mysqli_real_escape_string($con,$_POST['d_name'])."' where d_id='$d_id'";
		$resultdepartment=mysqli_query($con,$sqlupdatedepartment)or die("error in update department part:".mysqli_error($con));
$action="Add Update department";
//include('userlog.php');		
	if($resultdepartment)
	{
		echo'<script> alert("your data updated successfully");window.location.href="index1.php?pg=department.php&option=view";</script>';
		
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
        <h2>department Information</h2>
        <form role="form" action="" method="post">
            <div class="card card-primary">
                <div class="card-header">
                </div>
                <div class="card-body">
                    <input type="hidden" id="household_id" name="household_id" value="<?php //echo $household_id; ?>">
                    <div class="row">
                        <div class="col-md-4">
                            <label>department ID</label>
                            <?php
                                $sql1 = "select d_id from tbl_department  order by d_id DESC";
                                $result1 = mysqli_query($con, $sql1) or die("error in insert department Id:" . mysqli_error($con));
                                $row = mysqli_fetch_assoc($result1);
                                $d_id = $row['d_id'];
                                if (mysqli_num_rows($result1) > 0) 
                                {
                                    $d_id = ++$d_id;
                                } 
                                else 
                                {
                                // $SUFFIX = '0001 ';
                                    $d_id = "D001";
                                }
                                ?>
                            <div class="col-md-6"><input type="text" name="d_id" id="d_id" value="<?php echo $d_id; ?>"
                                    readonly class="form-control" />
                            </div>

                        </div>
                        <div class="col-md-4">
                            <label>department name</label>

                            <div><input type="text" name="d_name" id="d_name" class="form-control" />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label>Head</label>

                            <div class="col-md-6"><input type="text" name="head" id="head" class="form-control" />
                            </div>

                        </div>
                    </div>
                    <div class="row">
                    <div class="col-md-4">
                            <label>Faculty name</label>
                            <div class="row">
                                <?php
								$sql2="select DISTINCT f_id ,f_name from tbl_faculty";
								$result2=mysqli_query($con,$sql2) or die("error in select tbl_faculty:".mysqli_error());
								echo'<select id="f_id" name="f_id" class="form-control col-md-10" onChange="updateinstrument()">';
								echo'<option value="select">Select Faculty</option>';
								while($row1=mysqli_fetch_assoc($result2))
								{
									echo'<option value="'.$row1['f_id'].'">'.$row1['f_name'].'</option>';
								}
								echo'</select>';
							?>
                            </div>
                        </div>
                    </div>
                   
                </div>
                <div class="card-footer">
                <a href="index1.php?pg=department.php&option=view"><button type="button" class="btn btn-danger"><i class="ace-icon glyphicon glyphicon-remove"></i>Cancel</button> </a>
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
<div class="col-sm-3"> <a href="index1.php?pg=department.php&option=new">
								<button type=button class="btn btn-block bg-gradient-success" ><i class="ace-icon fa fa-trash-o bigger-120"></i>new</button></a></div>
            </div>
       <br>
            <div class="card card-primary">
                <div class="card-header">
                    department Information
                </div>
                <div class="card-body">


                    <?php  
                    $sqlview="SELECT * FROM tbl_department where status='active'";
                    $result=mysqli_query($con,$sqlview) or die("@error in view part:".mysqli_error($con));
                    //$row=mysqli_fetch_assoc($result);
  ?>

                    <input class="form-control" id="myInput" type="text" placeholder="Search..">
                    <br>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>department ID</th>
                                <th>department Name</th>
                                <th>Name of Head</th>
                                <th>Faculty of</th>

                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="myTable">
                            <?php while($row=mysqli_fetch_assoc($result)) {
                                    $f_id=$row['f_id'];
                                 $sqlvieww="SELECT f_name FROM tbl_faculty where f_id='$f_id'";
                                 $resultw=mysqli_query($con,$sqlvieww) or die("@error in view part:".mysqli_error($con));
                                 $roww=mysqli_fetch_assoc($resultw);
      echo '<tr> <td>'
      .$row['d_id'].'</td><td>'
      .$row['d_name'].'</td><td>'
    
      .$row['head'].'</td><td>'
      .$roww['f_name'].'</td>'; 
      echo'<td><a href="index1.php?pg=department.php&option=find&d_id='.$row['d_id'].'">
								<button type=button class="btn btn-xs btn-purple"><i class="ace-icon fa  fa-eye"></i>View</button></a>';
                echo'<a href="index1.php?pg=department.php&option=edit&d_id='.$row['d_id'].'">
								<button type=button class="btn btn-xs btn-primary"><i class="ace-icon fa fa-pencil-square-o bigger-120"></i>Edit</button></a>';
                echo'<a href="index1.php?pg=department.php&option=delete&d_id='.$row['d_id'].'">
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
	{   $d_id=$_GET['d_id'];
        $sqlview="SELECT * FROM tbl_department where d_id='$d_id'";
        $result=mysqli_query($con,$sqlview) or die("@error in view part:".mysqli_error($con));
        $row=mysqli_fetch_assoc($result);
      ?>
<div class="content">
    <div class="container-fluid">
        <h2>department Information</h2>
        <form role="form" action="" method="post">
            <div class="card card-primary">
                <div class="card-header">
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-4">
                            <label>department ID</label>

                            <div class="col-md-6"><input type="text" name="d_id" id="d_id"
                                    value="<?php echo $row['d_id']; ?>" readonly class="form-control" />
                            </div>

                        </div>
                        <div class="col-md-4">
                            <label>department name</label>

                            <div><input type="text" name="d_name" id="d_name" value="<?php echo $row['d_name']; ?>"
                                    class="form-control" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Head</label>

                            <div class="col-md-6"><input type="text" name="head" id="head"
                                    value="<?php echo $row['head']; ?>" class="form-control" />
                            </div>

                        </div>

                    </div>
                    
                </div>
                <div class="card-footer">

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
		$d_id=$_GET['d_id'];
		$sql3="select * from tbl_department where d_id='$d_id'";
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
                                <td>department Id</td>
                                <td><?php echo $row['d_id'];?></td>
                            </tr>
                            <tr>
                                <td>department Name</td>
                                <td><?php echo $row['d_name'];?></td>
                            </tr>
                            <tr>
                                <td>Name Of Dean</td>
                                <td><?php echo $row['head'];?></td>
                            </tr>
                            
                            <tr>
                                <td>Status</td>
                                <td><?php echo $row['status'];?></td>
                            </tr>
                        </table>
                        <?php
	if(!isset($_GET['pr']))
	{
        $d_id=$row['d_id'];
		if($role_id=="R01")
		{  ?>
                        <a href="index1.php?pg=department.php&option=edit&d_id=<?php echo $d_id; ?>"><button type="button"
                                class="btn btn-primary btn-xs"><i class="ace-icon fa fa-pencil-square-o bigger-125"></i>
                                Edit</button></a>
                        <?php
		} ?>
                        <a href="index1.php?pg=department.php&option=view"><button type="button"
                                class="btn btn-pink btn-xs"><i class="ace-icon fa fa-undo bigger-125"></i> Go
                                Back</button></a>
                        <a href="print.php?pr=department.php&option=find&d_id=<?php echo $d_id; ?>"><button type="button"
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
		$d_id=$_GET['d_id'];
        $del="deteted";
        $sqlupdatedepartment="UPDATE tbl_department SET   
        status='".mysqli_real_escape_string($con,$del)."' where d_id='$d_id'";
$resultdepartment=mysqli_query($con,$sqlupdatedepartment)or die("error in Delete department part:".mysqli_error($con));
$action="department Deletion";

	if($resultdepartment)
	{
		
		echo'<script> alert("your data successfully deleted");window.location.href="index1.php?pg=department.php&option=view";</script>';
		
	}
	}
}
?>