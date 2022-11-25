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
    if(isset($_POST['w_condition'])) { $w_condition="YES"; } else {  $w_condition="NO"; }
    if(isset($_POST['to'])) { $to="YES"; } else { $to="NO"; }
	$sqlCmd="INSERT into tbl_Instruments (id,name,description,manufactured_year,tech_off,w_condition,f_id,d_id) Values(
                                                                '".mysqli_real_escape_string($con,$_POST["id"])."',
                                                             '".mysqli_real_escape_string($con,$_POST["name"])."',
                                                             '".mysqli_real_escape_string($con,$_POST["description"])."',
                                                             '".mysqli_real_escape_string($con,$_POST["manufactured_year"])."',
                                                             '".mysqli_real_escape_string($con,$to)."',
                                                             '".mysqli_real_escape_string($con,$w_condition)."',
                                                             '".mysqli_real_escape_string($con,$_POST["f_id"])."',
                                                               '".mysqli_real_escape_string ($con,$_POST["d_idd"])."')";
	$result= mysqli_query($con,$sqlCmd) or die("SQL Error".mysqli_error($con));
	if($result)
	{
		echo '<script>alert("your data added successfully");window.location.href="index1.php?pg=Instruments.php&option=view";</script>';
		
	}
}
//start Update part in branch
if(isset($_POST['btnupdate']))
{
	$id=$_POST['id'];
    if(isset($_POST['w_condition'])) { $w_condition="YES"; } else {  $w_condition="NO"; }
    if(isset($_POST['to'])) { $to="YES"; } else { $to="NO"; }

	$sqlupdateInstruments="UPDATE tbl_Instruments SET 
    name='".mysqli_real_escape_string($con,$_POST['name'])."',
    description='".mysqli_real_escape_string($con,$_POST['description'])."',
    manufactured_year='".mysqli_real_escape_string($con,$_POST['manufactured_year'])."',
    tech_off='".mysqli_real_escape_string($con,$to)."',
    w_condition='".mysqli_real_escape_string($con,$w_condition)."',
    f_id='".mysqli_real_escape_string($con,$_POST['f_id'])."',
    d_id='".mysqli_real_escape_string($con,$_POST['d_id'])."' where id='$id'";
		$resultInstruments=mysqli_query($con,$sqlupdateInstruments)or die("error in update Instruments part:".mysqli_error($con));
$action="Add Update Instruments";
//include('userlog.php');		
	if($resultInstruments)
	{
		echo'<script> alert("your data updated successfully");window.location.href="index1.php?pg=Instruments.php&option=view";</script>';
		
	}
}
//End Update part in Instruments
if (isset($_GET['option']))
{
	//start insert Form in Instruments
	if ($_GET['option']=="new")
	{?>
<div class="content">
    <div class="container-fluid">
        <h2>Instruments Information</h2>
        <form role="form" action="" method="post" onsubmit="return check_submission()">
            <div class="card card-primary">
                <div class="card-header">
                </div>
                <div class="card-body">
                    <input type="hidden" id="householid" name="householid" value="<?php //echo $householid; ?>">
                    <div class="row">
                        <div class="col-md-4">
                            <label class="col-md-6">Instruments ID</label>
                            <?php
                                $sql1 = "select id from tbl_Instruments  order by id DESC";
                                $result1 = mysqli_query($con, $sql1) or die("error in insert Instruments Id:" . mysqli_error($con));
                                $row = mysqli_fetch_assoc($result1);
                                $id = $row['id'];
                                if (mysqli_num_rows($result1) > 0) 
                                {
                                    $id = ++$id;
                                }  
                                else 
                                {
                                // $SUFFIX = '0001 ';
                                    $id = "IE001";
                                }
                                ?>
                            <div class="col-md-6"><input type="text" name="id" id="id" value="<?php echo $id; ?>"
                                    readonly class="form-control" />
                            </div>

                        </div>
                        <div class="col-md-4">
                            <label>Instruments name</label>

                            <div><input type="text" name="name" id="name" required class="form-control" />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label>Description</label>

                            <div class="form-group">
                                <textarea class="form-control" rows="3" placeholder="Enter ..." name="description"
                                    id="description"></textarea>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Manufactured year</label>
                            <div> <input type="number" min="1900" max="2099" required step="1" placeholder="2016"
                                    name="manufactured_year" id="manufactured_year" class="form-control" /> </div>
                        </div>
                        <div class="col-md-4">
                            <label>Availablity of Technical Officer</label>
                            <div>
                                <!-- <input type="checkbox" name="my-checkbox" checked data-bootstrap-switch> -->
                                <input type="checkbox" name="to" id="to" checked data-bootstrap-switch
                                    data-off-color="danger" data-on-color="success">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Working condition</label>
                            <div>
                                <!-- <input type="checkbox" name="my-checkbox" checked data-bootstrap-switch> -->
                                <input type="checkbox" name="w_condition" checked data-bootstrap-switch
                                    data-off-color="danger" data-on-color="success">
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Name of the Faculty</label>
                            <div>
                                <?php
								$sql2="select DISTINCT f_id ,f_name from tbl_faculty";
								$result2=mysqli_query($con,$sql2) or die("error in select tbl_faculty:".mysqli_error());
								echo'<select id="f_id" name="f_id" class="form-control" onChange="updateDepartment()" >';
								echo'<option value="select">Select Faculty</option>';
								while($row1=mysqli_fetch_assoc($result2))
								{
									echo'<option value="'.$row1['f_id'].'">'.$row1['f_name'].'</option>';
								}
								echo'</select>';
							?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Name of the Departmentt</label>
                            <div id="div_department"> </div>

                            <div> <?php
								// $sql2="select DISTINCT d_id ,d_name from tbl_department";
								// $result2=mysqli_query($con,$sql2) or die("error in select tbl_department:".mysqli_error());
								// echo'<select id="d_id" name="d_id" class="chosen-select form-control" onChange="updateinstrument()">';
								//echo'<option value="select">Select Department</option>';
								// while($row1=mysqli_fetch_assoc($result2))
								// {
								// 	echo'<option value="'.$row1['d_id'].'">'.$row1['d_name'].'</option>';
								// }
								// echo'</select>';
							?>
                            </div>
                        </div>
                        <div class="col-md-4">


                        </div>
                    </div>

                

                </div>
                <div class="card-footer">
                <a href="index1.php?pg=instruments.php&option=view"><button type="button" class="btn btn-danger"><i class="ace-icon glyphicon glyphicon-remove"></i>Cancel</button> </a>
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
                <div class="col-sm-3"> <a href="index1.php?pg=Instruments.php&option=new">
                        <button type=button class="btn btn-block bg-gradient-success"><i
                                class="ace-icon fa fa-trash-o bigger-120"></i>new</button></a></div>
            </div>
            <br>
            <div class="card card-primary">
                <div class="card-header">
                    Instruments Information
                </div>
                <div class="card-body">


                    <?php  
                    $sqlview="SELECT i.*,f.f_name,d.d_name FROM tbl_Instruments as i,tbl_faculty as f,tbl_department as d where i.status='active' and f.f_id=i.f_id and d.d_id=i.d_id";
                    $result=mysqli_query($con,$sqlview) or die("@error in view part:".mysqli_error($con));
                    //$row=mysqli_fetch_assoc($result);
  ?>

                    <input class="form-control" id="myInput" type="text" placeholder="Search..">
                    <br>
                    <table class="table table-bordered table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Instruments Name</th>
                                <!-- <th>Description</th> -->
                                <th>Tech Officer</th>
                                <th>Condition</th>
                                <th>Faculty</th>
                                <th>Department</th>
                                <th style="width:18%">Action</th>
                            </tr>
                        </thead>
                        <tbody id="myTable">
                            <?php while($row=mysqli_fetch_assoc($result)) {
                             
      echo '<tr> <td>'
      .$row['id'].'</td><td>'
      .$row['name'].'</td><td>'
    //   .$row['description'].'</td><td>'
      .$row['tech_off'].'</td><td>'
      .$row['w_condition'].'</td><td>'
      .$row['f_name'].'</td><td>'
    
      .$row['d_name'].'</td>'; 
      echo'<td><a href="index1.php?pg=Instruments.php&option=find&id='.$row['id'].'">
								<button type=button class="btn btn-xs btn-purple"><i class="ace-icon fa  fa-eye"></i>View</button></a>';
                echo'<a href="index1.php?pg=Instruments.php&option=edit&id='.$row['id'].'">
								<button type=button class="btn btn-xs btn-primary"><i class="ace-icon fa fa-pencil-square-o bigger-120"></i>Edit</button></a>';
                echo'<a href="index1.php?pg=Instruments.php&option=delete&id='.$row['id'].'">
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
	{   $id=$_GET['id'];
        $sqlview="SELECT * FROM tbl_Instruments where id='$id'";
        $result=mysqli_query($con,$sqlview) or die("@error in view part:".mysqli_error($con));
        $row=mysqli_fetch_assoc($result);
      ?>
<div class="content">
    <div class="container-fluid">
        <h2>Instruments Information</h2>
        <form role="form" action="" method="post" onsubmit="return check_submission()">
            <div class="card card-primary">
                <div class="card-header">
                </div>
                <div class="card-body">
                    <input type="hidden" id="householid" name="householid" value="<?php //echo $householid; ?>">
                    <div class="row">
                        <div class="col-md-4">
                            <label class="col-md-6">Instruments ID</label>

                            <div class="col-md-6"><input type="text" name="id" id="id" value="<?php echo $row['id']; ?>"
                                    readonly class="form-control" />
                            </div>

                        </div>
                        <div class="col-md-4">
                            <label>Instruments name</label>

                            <div><input type="text" name="name" id="name" value="<?php echo $row['name']; ?>"
                                    class="form-control" />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label>Description</label>
                            <div class="form-group">
                                <textarea class="form-control" rows="3" placeholder="Enter ..." name="description"
                                    id="description"><?php echo htmlspecialchars($row['description']);?></textarea>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Manufactured year</label>
                            <div> <input type="number" min="1900" max="2099" step="1"
                                    value="<?php echo $row['manufactured_year']; ?>" name="manufactured_year"
                                    id="manufactured_year" class="form-control" /> </div>
                        </div>
                        <div class="col-md-4">
                            <label>Availablity of Technical Officer</label>
                            <div>
                                <!-- <input type="checkbox" name="my-checkbox" checked data-bootstrap-switch> -->
                                <input type="checkbox" name="to" id="to" <?php if($row['tech_off']=="YES") {?> checked
                                    <?php } else {} ?> data-bootstrap-switch data-off-color="danger"
                                    data-on-color="success">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Working condition</label>
                            <div>
                                <!-- <input type="checkbox" name="my-checkbox" checked data-bootstrap-switch> -->
                                <input type="checkbox" name="w_condition" <?php if($row['w_condition']=="YES") {?>
                                    checked <?php } else {} ?> data-bootstrap-switch data-off-color="danger"
                                    data-on-color="success">
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Name of the Faculty</label>
                            <div>
                                <?php
								$sql2="select DISTINCT f_id ,f_name from tbl_faculty";
								$result2=mysqli_query($con,$sql2) or die("error in select tbl_faculty:".mysqli_error());
								echo'<select id="f_id" name="f_id" class="form-control" onChange="updateDepartmentren()">';
								echo'<option value="select">Select Faculty</option>';
								while($row1=mysqli_fetch_assoc($result2))
								if($row['f_id']==$row1['f_id'])
                                {
                                    echo'<option value="'.$row1['f_id'].'" selected>'.$row1['f_name'].'</option>';
                                }
                                else
                                {
                                    echo'<option value="'.$row1['f_id'].'">'.$row1['f_name'].'</option>';
                                }
								echo'</select>';
							?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Name of the Department</label>
                            <div id="div_departmentren"> <?php
								//$sql2="select DISTINCT d_id ,d_name from tbl_department";
								//$result2=mysqli_query($con,$sql2) or die("error in select tbl_department:".mysqli_error());
								//echo'<select id="d_id" name="d_id" class="chosen-select form-control" onChange="updateinstrument()">';
								//echo'<option value="select">Select Department</option>';
								//while($row1=mysqli_fetch_assoc($result2))
								// if($row['d_id']==$row1['d_id'])
                                // {
                                //     echo'<option value="'.$row1['d_id'].'" selected>'.$row1['d_name'].'</option>';
                                // }
                                // else
                                // {
                                //     echo'<option value="'.$row1['d_id'].'">'.$row1['d_name'].'</option>';
                                // }
								// echo'</select>';
							?></div>
                        </div>
                        <div class="col-md-4">


                        </div>
                    </div>

                </div>
                <div class="card-footer">
                <a href="index1.php?pg=instruments.php&option=view"><button type="button" class="btn btn-danger"><i class="ace-icon glyphicon glyphicon-remove"></i>Cancel</button> </a>
                    <button type="reset" class="btn btn-default">Reset Button</button>
                    <button type="submit" name="btnupdate" id="btnupdate"
                        class="btn btn-primary float-right">Update</button>
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
		$id=$_GET['id'];
		$sql3="SELECT i.*,f.f_name,d.d_name FROM tbl_Instruments as i,tbl_faculty as f,tbl_department as d where i.status='active' and f.f_id=i.f_id and d.d_id=i.d_id and i.id='$id'";
		$result3=mysqli_query($con,$sql3)or die("error in Find Instruments Id:".mysqli_error($con));
		$row=mysqli_fetch_assoc($result3);
		?>

<div class="content">
    <div class="container-fluid">

        <form role="form" action="" method="post">
            <div class="card card-primary">
                <div class="card-header"> Instruments & Equipments Information </div>
                <div class="card-body">
                    <div class="col-xs-6">
                        <table class="table table-striped table-bordered table-hover">
                            <tr>
                                <td class="col-sm-3">Instruments Id</td>
                                <td><?php echo $row['id'];?></td>
                            </tr>
                            <tr>
                                <td>Instruments Name</td>
                                <td><?php echo $row['name'];?></td>
                            </tr>
                            <tr>
                                <td>Description</td>
                                <td><?php echo $row['description'];?></td>
                            </tr>
                            <tr>
                                <td>Year Of Manufecture</td>
                                <td><?php echo $row['manufactured_year'];?></td>
                            </tr>
                            <tr>
                                <td>Availability of technical Officer</td>
                                <td><?php echo $row['tech_off'];?></td>
                            </tr>
                            <tr>
                                <td>Working Condition</td>
                                <td><?php echo $row['w_condition'];?></td>
                            </tr>
                            <tr>
                                <td>Faculty</td>
                                <td><?php echo $row['f_name'];?></td>
                            </tr>
                            <tr>
                                <td>Department</td>
                                <td><?php echo $row['d_name'];?></td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td><?php echo $row['status'];?></td>
                            </tr>
                        </table>
                        <?php
	if(!isset($_GET['pr']))
	{
        $id=$row['id'];
		if($role_id=="R01")
		{  ?>
                        <a href="index1.php?pg=Instruments.php&option=edit&id=<?php echo $id; ?>"><button type="button"
                                class="btn btn-primary btn-xs"><i class="ace-icon fa fa-pencil-square-o bigger-125"></i>
                                Edit</button></a>
                        <?php
		} ?>
                        <a href="index1.php?pg=Instruments.php&option=view"><button type="button"
                                class="btn btn-pink btn-xs"><i class="ace-icon fa fa-undo bigger-125"></i> Go
                                Back</button></a>
                        <a href="print.php?pr=Instruments.php&option=find&id=<?php echo $id; ?>"><button type="button"
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
		$id=$_GET['id'];
        $del="deteted";
        $sqlupdateInstruments="UPDATE tbl_Instruments SET   
        status='".mysqli_real_escape_string($con,$del)."' where id='$id'";
$resultInstruments=mysqli_query($con,$sqlupdateInstruments)or die("error in Delete Instruments part:".mysqli_error($con));
$action="Instruments Deletion";

	if($resultInstruments)
	{
		
		echo'<script> alert("your data successfully deleted");window.location.href="index1.php?pg=Instruments.php&option=view";</script>';
		
	}
	}
}
?>