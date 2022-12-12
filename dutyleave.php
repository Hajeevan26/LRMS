<?php
include('connection/config.php');
if(!isset($_SESSION))
{
	session_start();
}
$role_id=$_SESSION['role_id'];
$user_id=$_SESSION['user_id'];
$emailto=$_SESSION['email'];
if($role_id!="R04")
	{
		$sqld_id="SELECT d_id FROM tbl_staff WHERE s_id='$user_id'";
		$resuld_id=mysqli_query($con,$sqld_id) or die("error in user branch id:".mysqli_error());
		$rowuid=mysqli_fetch_assoc($resuld_id);
		$rd_id=$rowuid['d_id'];
	} 
if(isset($_POST["btnsave"]))
{
    $emailto=$_SESSION['email'];
    $id=$_POST["id"];

   
    if (isset($_POST['chksupp_doc'])) {
        $flag=true;//check box checked
    }
    else {
        $flag=false;
    }
    if ($flag) 
    {
        //check box checked
        $filename = $_FILES['file']['name'];
        if($filename != '')
            {
                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                //$allowed = ['pdf', 'txt', 'doc', 'docx', 'png', 'jpg', 'jpeg',  'gif'];
                $allowed = ['pdf','doc', 'docx', 'png', 'jpg', 'jpeg',  'gif'];
                //check if file type is valid
                if (in_array($ext, $allowed))
                {
                    $created = @date('Y-m-d H:i:s');
                    $filename = $user_id.'-' . $filename;
                    //set target directory
                    $path = 'uploads/PDF/'.$user_id.'/';
                    if (!file_exists($path)) 
                    {
                        mkdir($path);
                    }
                    
                    move_uploaded_file($_FILES['file']['tmp_name'],($path . $filename));
                    
                    $sqlCmd="INSERT into  tbl_dutyleave (id,f_id,d_id,user_id,appointment_date,from_date,to_date,no_of_days,reason,s_file,acting_officer) Values(
                        '".mysqli_real_escape_string($con,$id)."',
                        '".mysqli_real_escape_string ($con,$_POST["f_id"])."',
                        '".mysqli_real_escape_string ($con,$_POST["dep_id"])."',
                       '".mysqli_real_escape_string ($con,$user_id)."',
                       '".mysqli_real_escape_string ($con,$_POST["appointment_date"])."',
                       '".mysqli_real_escape_string ($con,$_POST["from"])."',
                       '".mysqli_real_escape_string ($con,$_POST["to"])."',
                       '".mysqli_real_escape_string ($con,$_POST["no_of_days"])."',
                       '".mysqli_real_escape_string ($con,$_POST["reason"])."',
                       '".mysqli_real_escape_string ($con,$filename)."',
                       '".mysqli_real_escape_string ($con,$_POST["acting_officer"])."')";
                       $result= mysqli_query($con,$sqlCmd) or die("SQL Error".mysqli_error($con));
                       if($result)
                       {
       
                        // include('mailU.php');
                        echo '<script>alert("your data added successfully");window.location.href="index1.php?pg=dutyleave.php&option=view";</script>';
                        
                        }
                       //echo '<script> window.location.href="index.php?pg=vehicle.php&option=new&st=success";</script>';
                    //header("Location: index.php?pg=vehicle.php&option=new&st=success");
                }
                else
                {
                    //echo '<script>alert("Invalid supportive document");window.location.href="index.php?pg=dutyleave.php&option=new&st=error";</script>';
                    //header("Location:index.php?pg=dutyleave.php&option=new&st=error");
                                        ?>
<div class="alert alert-danger alert-dismissible fade show text-center">
    <a class="close" data-dismiss="alert" aria-label="close">×</a><strong>Failed!</strong> File must be uploaded in PDF
    format!
</div>
<?php
                }
            }
    }
    else 
    {
        //check box not checked
        $sqlCmd="INSERT into  tbl_dutyleave (id,f_id,d_id,user_id,appointment_date,from_date,to_date,no_of_days,reason,acting_officer) Values(
            '".mysqli_real_escape_string($con,$id)."',
            '".mysqli_real_escape_string ($con,$_POST["f_id"])."',
            '".mysqli_real_escape_string ($con,$_POST["dep_id"])."',
           '".mysqli_real_escape_string ($con,$user_id)."',
           '".mysqli_real_escape_string ($con,$_POST["appointment_date"])."',
           '".mysqli_real_escape_string ($con,$_POST["from"])."',
           '".mysqli_real_escape_string ($con,$_POST["to"])."',
           '".mysqli_real_escape_string ($con,$_POST["no_of_days"])."',
           '".mysqli_real_escape_string ($con,$_POST["reason"])."',
         
           '".mysqli_real_escape_string ($con,$_POST["acting_officer"])."')";
           $result= mysqli_query($con,$sqlCmd) or die("SQL Error".mysqli_error($con));
           if($result){
       
            // include('mailU.php');
            echo '<script>alert("your data added successfully");window.location.href="index1.php?pg=dutyleave.php&option=view";</script>';
            
        }
    }
   
	
	
      
	
}
if(isset($_POST["btnupdate"]))
{
    $id=$_POST['id'];
    $txt_file=$_POST['txt_file'];
    $emailto=$_SESSION['email'];

    if (isset($_POST['chksupp_doc'])) {
        $flag=true;//check box checked
    }
    else {
        $flag=false;
    }
    if ($flag) 
    {
        
        $filename = $_FILES['file1']['name'];
        if($filename != '')
        {
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            //$allowed = ['pdf', 'txt', 'doc', 'docx', 'png', 'jpg', 'jpeg',  'gif'];
            $allowed = ['pdf','doc', 'docx', 'png', 'jpg', 'jpeg',  'gif'];
            //check if file type is valid
            if (in_array($ext, $allowed))
            {
                $created = @date('Y-m-d H:i:s');
                $filename = $user_id.'-' .$filename;
                //set target directory
                $path = 'uploads/PDF/'.$user_id.'/';

                if (!file_exists($path)) 
                {
                    mkdir($path);
                }
                if (file_exists($path.$txt_file)) {
                    unlink($path.$txt_file);
                }
                $st="success";
                move_uploaded_file($_FILES['file1']['tmp_name'],($path . $filename));
                include('dutyleave_update.php');
            }
            else {
                $st="Fail";
                echo '<script> alert("Invalid File Extension!"); </script>';
            }

        }
    }
    else {
        include('dutyleave_update.php');
    }
	
     
}

if (isset($_GET['option']))
{
	//start insert Form in vehicle
	if ($_GET['option']=="new")
	{?>
<div class="content">
    <div class="container-fluid">

        <?php
		//Generate Vehicle id automatically-start
        $sql1="select id from tbl_dutyleave order by id DESC";
        $result1=mysqli_query($con,$sql1)or die("error in insert Vehicle Id:".mysqli_error($con));
        $row=mysqli_fetch_assoc($result1);
        // $id=$row['id'];
        if(mysqli_num_rows($result1)>0)
        {
            $id=$row['id'];
            $id=++$id;
        }
        else{

            $id="dl001";
        }
        ?>

        <form role="form" action="" method="post" enctype="multipart/form-data">
            <div class="card card-primary">
                <div class="card-header">
                    <h2>Serial No - <?php echo $id; ?></h2>
                </div>

                <div class="card-body">
                    <div class="row">
                        <input type="hidden" name="id" id="id" value="<?php echo $id; ?>" readonly
                            class="form-control" />


                        <div class="col-md-4">
                            <!-- Country dropdown -->
                            <label for="country">Faculty</label>
                            <select class="form-control select2bs4" id="f_id" name="f_id" required
                                onchange="view_status()">
                                <option value="">Select Faculty</option>
                                <?php 
					$query="select * from tbl_faculty";
					$result = $con->query($query);
					if ($result->num_rows > 0) {
						while ($row = $result->fetch_assoc()) {
							  echo '<option value="'.$row['f_id'].'">'.$row['f_name'].'</option>';
						}
					}else{
						echo '<option value="0">Faculty not available</option>'; 
					}
					?>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <!-- State dropdown -->
                            <label for="country">Department</label>
                            <select class="form-control select2bs4" id="dep_id" name="dep_id" required
                                onchange="view_status()">
                                <option value="0">Select Department</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label>Date of First Appointment:</label>
                            <div class="col-sm-10">
                                <?php  $dt = new DateTime();  $dt= $dt->format('Y-m-d');  ?>
                                <input type="date" class="form-control" value="<?php echo  $dt;  ?>"
                                    name="appointment_date" id="appointment_date" min="<?php echo $dt ?>">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">

                        <div class="col-md-4">
                            <label>Date of commencement of leave:</label>
                            <div class="col-sm-10">
                                <?php  $dt = new DateTime();  $dt= $dt->format('Y-m-d\TH:i:s');  ?>
                                <input type="date" class="form-control" value="<?php echo  $dt;  ?>" name="from"
                                    id="from" min="<?php echo $dt ?>" onchange="fnGetDays()">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label>Date of expiry of leave:</label>
                            <div class="col-sm-10">
                                <?php  $dt = new DateTime();  $dt= $dt->format('Y-m-d\TH:i:s');  ?>
                                <input type="date" class="form-control" name="to" id="to" onchange="fnGetDays()"
                                    value="<?php echo  $dt; ?>" min="<?php echo $dt ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>No. of Days Leave Applied for:</label>
                            <div class="col-sm-10">

                                <input type="text" readonly class="form-control" name="no_of_days" id="no_of_days">
                            </div>
                        </div>

                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <label>Reason </label>
                            <div class="col-sm-12">
                                <textarea class="form-control" rows="3" name="reason" id="reason"
                                    placeholder="Enter ..."></textarea>
                            </div>
                        </div>

                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-4">

                            <input type="checkbox" id="chksupp_doc" checked name="chksupp_doc" /> Do you have Support
                            documents?
                        </div>
                        <div class="col-md-4" id="divfile_upload">
                            <legend>Select File to Upload:</legend>
                            <div class="form-group">
                                <input type="file" name="file" />
                            </div>
                            <?php if(isset($_GET['st'])) { ?>
                            <div class="alert alert-danger text-center">
                                <?php if ($_GET['st'] == 'success') {
															echo "File Uploaded Successfully!";
														}
														else
														{
															echo 'Invalid File Extension!';
														} ?>
                            </div>
                            <?php } ?>

                        </div>
                        <div class="col-md-4">
                            <label>Name of Acting Officer:(Only if necessary/appropriate)</label>
                            <div class="col-sm-12">

                                <input type="text" class="form-control" name="acting_officer" id="acting_officer">
                            </div>
                        </div>
                    </div>

                </div>
                <br>

            </div>
            <div class="card-footer">
                <a href="index1.php?pg=dutyleave.php&option=view"><button type="button" class="btn btn-danger"><i
                            class="ace-icon glyphicon glyphicon-remove"></i>Cancel</button> </a>
                <button type="reset" class="btn btn-default">Reset Button</button>
                <button type="submit" name="btnsave" id="btnsave" class="btn btn-primary float-right">Request</button>
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
                <div class="col-sm-3"> <a href="index1.php?pg=dutyleave.php&option=new">
                        <button type=button class="btn btn-block bg-gradient-success"><i
                                class="ace-icon fa fa-trash-o bigger-120"></i>new</button></a></div>
            </div>
            <br>
            <div class="card card-primary">
                <div class="card-header">
                    Duty Leave Information
                </div>
                <div class="card-body">


                    <?php  
                            if($role_id=="R01")
                            { 
                            $sqlview="SELECT dl.*,f.f_name,d.d_name,u.user_name FROM tbl_dutyleave as dl , tbl_faculty as f , tbl_department as d ,user as u  where dl.f_id=f.f_id and dl.d_id=d.d_id and dl.user_id=u.user_id";
                            }
                            else if($role_id=="R02")
                            { 
                            $sqlview="SELECT r.*,f.f_name,d.d_name,u.user_name,i.name FROM tbl_reservation as r , tbl_faculty as f , tbl_department as d ,user as u , tbl_instruments as i where r.f_id=f.f_id and r.d_id=d.d_id and r.user_id=u.user_id and i.id=r.i_id and r.d_id='$rd_id'";
                            }
                            
                            else{
                                $sqlview="SELECT r.*,f.f_name,d.d_name,u.user_name,i.name FROM tbl_reservation as r , tbl_faculty as f , tbl_department as d ,user as u , tbl_instruments as i where r.f_id=f.f_id and r.d_id=d.d_id and r.user_id=u.user_id and i.id=r.i_id and r.user_id='$user_id'";
                            }
                            $result=mysqli_query($con,$sqlview) or die("@error in view part:".mysqli_error($con));
                            //$row=mysqli_fetch_assoc($result);
          ?>

                    <input class="form-control" id="myInput" type="text" placeholder="Search..">
                    <br>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <!-- <th>reservation</th> -->
                                <th>Department</th>
                                <th>From</th>
                                <th>To</th>
                                <th>No Of Days</th>
                                <th>Employee</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="myTable">
                            <?php while($row=mysqli_fetch_assoc($result)) {
              echo '<tr> <td>'
              .$row['id'].'</td><td>'
            //   .$row['f_name'].'</td><td>'
              .$row['d_name'].'</td><td>' 
              .$row['from_date'].'</td><td>' 
              .$row['to_date'].'</td><td>' 
              .$row['no_of_days'].'</td><td>' 
              .$row['user_name'].'</td><td>' 
            //   .$row['r_to'].'</td><td>' 
             
              .$row['status'].'</td>'; 
              echo'<td><a href="index1.php?pg=dutyleave.php&option=find&id='.$row['id'].'">
                                        <button type=button  class="btn btn-xs btn-purple"><i class="ace-icon fa  fa-eye"></i>View</button></a>';
                        echo'<a href="index1.php?pg=dutyleave.php&option=edit&id='.$row['id'].'">
                                        <button type=button class="btn btn-xs btn-primary"><i class="ace-icon fa fa-pencil-square-o bigger-120"></i>Edit</button></a>';
                        echo'<a href="index1.php?pg=dutyleave.php&option=delete&id='.$row['id'].'">
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
	{ ?>
<div class="content">
    <div class="container-fluid">
        <?php
          $id=  $_GET['id'];
            $sql1="select * from tbl_dutyleave where id='$id'";
            $result1=mysqli_query($con,$sql1)or die("error in insert Vehicle Id:".mysqli_error());
            $row=mysqli_fetch_assoc($result1);
            $id=$row['id'];
            
            ?>


        <form role="form" action="" id="frmres" method="post" enctype="multipart/form-data">
            <div class="card card-primary">
                <div class="card-header">
                    <h3>Edit Reservation - <?php echo $id; ?></h3>
                </div>

                <input type="hidden" id="txtf_id" name="txtf_id" value="<?php echo $row['f_id']; ?>">
                <input type="hidden" id="txtd_id" name="txtd_id" value="<?php echo $row['d_id']; ?>">
                <input type="hidden" id="txt_file" name="txt_file" value="<?php echo $row['s_file']; ?>">
                <input type="hidden" id="emailto" name="emailto" value="<?php echo $emailto; ?>">


                <div class="card-body">
                    <div class="row">
                        <input type="hidden" name="id" id="id" value="<?php echo $id; ?>" readonly
                            class="form-control" />


                        <div class="col-md-4">
                            <!-- Country dropdown -->
                            <label for="country">Faculty</label>
                            <select class="form-control select2bs4" id="f_ide" name="f_ide">
                                <option value="">Select Faculty</option>
                                <?php 
                        $query="select * from tbl_faculty";
                        $result3 = $con->query($query);
                        if ($result3->num_rows > 0) {
                            while ($roww = $result3->fetch_assoc()) 
                            {
                                if($row['f_id']==$roww['f_id'])
                                 {
                                    echo'<option selected value="'.$roww['f_id'].'">'.$roww['f_name'].'</option>';

                                }
                                else {
                                    echo '<option value="'.$roww['f_id'].'">'.$roww['f_name'].'</option>';
                                }
                                 
                            }
                        }
                        else
                        {
                            echo '<option value="">Faculty not available</option>'; 
                        }
                        ?>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <!-- State dropdown -->
                            <label for="country">Department</label>
                            <select class="form-control select2bs4" id="dep_ide" name="dep_ide">
                                <option value="0">Select Faculty</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <!-- City dropdown -->
                            <label for="country">Date of Appointment</label>
                            <div class="col-sm-10">
                                <?php $exampleDate=$row['appointment_date'];
                            $newDate = date('Y-m-d', strtotime($exampleDate)); ?>
                                <input type="date" class="form-control" value="<?php echo  $newDate;  ?>"
                                    name="appointment_date" id="appointment_date">
                            </div>

                        </div>


                    </div>
                    <hr>

                    <div class="row">
                        <div class="col-md-4">
                            <label>Current date</label>
                            <div class="col-sm-10">
                                <?php  $dt = new DateTime();  $dt= $dt->format('Y-m-d\TH:i:s');  ?>
                                <input type="datetime-local" readonly class="form-control" value="<?php echo  $dt;  ?>"
                                    name="cur_datetime" id="cur_datetime" min="<?php echo $dt ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>From</label>
                            <div class="col-sm-10">
                                <?php $exampleDate=$row['from_date'];
                                $dt = new DateTime();  $dt= $dt->format('Y-m-d');  
                            $newDate = date('Y-m-d', strtotime($exampleDate)); ?>
                                <input type="date" class="form-control" value="<?php echo  $newDate;  ?>" name="from"
                                    id="from" min="<?php echo $dt-1 ?>">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label>To</label>
                            <div class="col-sm-10">
                                <?php  $exampleDate=$row['to_date'];
                            $newDatee = date('Y-m-d', strtotime($exampleDate)); ?>
                                <input type="date" class="form-control" name="to" id="to"
                                    value="<?php echo  $newDatee; ?>" min="<?php echo $newDatee ?>">
                            </div>
                        </div>


                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-4">
                            <label>No. of Days Leave Applied for:</label>
                            <div class="col-sm-12">
                                <input type="text" readonly class="form-control" name="no_of_days" id="no_of_days"
                                    value="<?php echo  $row['no_of_days']; ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Status</label>
                            <div class="col-sm-12">
                                <input type="text" readonly class="form-control" name="status" id="status"
                                    value="<?php echo  $row['status']; ?>">
                            </div>
                        </div>
                    </div>


                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <label>Reason </label>
                            <div class="col-sm-12">
                                <textarea class="form-control" rows="3" name="reason"
                                    id="reason"><?php echo htmlspecialchars($row['reason']); ?></textarea>
                            </div>
                        </div>

                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-4">

                            <input type="checkbox" id="chksupp_doc" checked name="chksupp_doc" /> Do you have Support
                            documents?
                        </div>
                        <div class="col-md-4" id="divfile_upload">
                            <legend>Select File to Upload:</legend>
                            <div class="form-group">
                                <input type="file" name="file1" /><br><span style="color:red;font-weight:bold;"  ><?php echo $row['s_file']?></span>
                            </div>
                            <?php if(isset($_GET['st'])) { ?>
                            <div>
                                <?php if ($_GET['st'] == 'success') {
															echo "File Uploaded Successfully!";
														}
														else
														{
                                                            echo '<script> alert("Invalid File Extension!"); </script>';
															//echo 'Invalid File Extension!';
														} ?>
                            </div>
                            <?php } ?>

                        </div>
                        <div class="col-md-4">
                            <label>Name of Acting Officer:(Only if necessary/appropriate)</label>
                            <div class="col-sm-12">

                                <input type="text" class="form-control" name="acting_officer"
                                    value="<?php echo $row['acting_officer'];?>" id="acting_officer">
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="card-footer">
                    <a href="index1.php?pg=dutyleave.php&option=view"><button type="button" class="btn btn-danger"><i
                                class="ace-icon glyphicon glyphicon-remove"></i>Cancel</button> </a>
                    <button type="reset" class="btn btn-default">Reset Button</button>
                    <?php if($row['status']=="pending" ){?>
                    <button type="submit" name="btnupdate" class="btn btn-primary float-right">Update</button>

                    <?php } 
                        else{ ?>
                    <button type="submit" name="btnupdate" class="btn btn-primary float-right" disabled>Update</button>
                    <?php }  ?>

                </div>
        </form>
    </div>
</div>
</div>
</div> <?php
	}
	if ($_GET['option']=="find")
	{
		$id=$_GET['id'];

		//$sql3="select * from tbl_dutyleave where id='$id'";
        if($role_id=="R01")
        { 
        $sqlview="SELECT dl.*,f.f_name,d.d_name,u.user_name FROM tbl_dutyleave as dl , tbl_faculty as f , tbl_department as d ,user as u  where dl.f_id=f.f_id and dl.d_id=d.d_id and dl.user_id=u.user_id";
        }
        else if($role_id=="R02")
        { 
        $sqlview="SELECT r.*,f.f_name,d.d_name,u.user_name,i.name FROM tbl_reservation as r , tbl_faculty as f , tbl_department as d ,user as u , tbl_instruments as i where r.f_id=f.f_id and r.d_id=d.d_id and r.user_id=u.user_id and i.id=r.i_id and r.d_id='$rd_id'";
        }
        
        else{
            $sqlview="SELECT r.*,f.f_name,d.d_name,u.user_name,i.name FROM tbl_reservation as r , tbl_faculty as f , tbl_department as d ,user as u , tbl_instruments as i where r.f_id=f.f_id and r.d_id=d.d_id and r.user_id=u.user_id and i.id=r.i_id and r.user_id='$user_id'";
        }
        $result=mysqli_query($con,$sqlview) or die("@error in view part:".mysqli_error($con));

		//$result3=mysqli_query($con,$sql3)or die("error in Find faculty Id:".mysqli_error($con));
		$row=mysqli_fetch_assoc($result);
		?>

<div class="content">
    <div class="container-fluid">

        <form role="form" action="" method="post">
            <div class="card card-primary">
                <div class="card-header"> Duty Information </div>
                <div class="card-body">
                    <div class="col-xs-6">
                        <table class="table table-striped table-bordered table-hover">
                            <tr>
                                <td>Leave Serial No</td>
                                <td><?php echo $row['id'];?></td>
                            </tr>
                            <tr>
                                <td>Employee Name</td>
                                <td><?php echo $row['user_name'];?></td>
                            </tr>
                            <tr>
                                <td>Appointment Date</td>
                                <td><?php echo $row['appointment_date'];?></td>
                            </tr>
                            <tr>
                                <td>From</td>
                                <td><?php echo $row['from_date'];?></td>
                            </tr>
                            <tr>
                                <td>To</td>
                                <td><?php echo $row['to_date'];?></td>
                            </tr>
                            <tr>
                                <td>Number of Days</td>
                                <td><?php echo $row['no_of_days'];?></td>
                            </tr>
                            <tr>
                                <td>Reason</td>
                                <td><?php echo $row['reason'];?></td>
                            </tr>
                            <tr>
                                <td>Supportive Document</td>
                                <?php  
                                // $iid=$row['id'];
                                // $sqlview1="SELECT * FROM tbl_dutyleave where id='$iid'";
                                // $result1=mysqli_query($con,$sqlview1) or die("@error in view part:".mysqli_error($con));
                                // $row1=mysqli_fetch_assoc($result1);
                                $pathx="uploads/PDF/".$user_id.'/';
						         //$file=$row['s_file'];
						        $doc=$pathx.$row['s_file']; ?>
                                <td><?php echo $doc; ?></td>
                            </tr>


                            <tr>
                                <td>Acting Officer</td>

                                <td><?php echo $row['acting_officer'];?></td>
                            </tr>
                            <tr>
                                <td>Download</td>
                                <?php  
                                // $iid=$row['id'];
                                // $sqlview1="SELECT * FROM tbl_dutyleave where id='$iid'";
                                // $result1=mysqli_query($con,$sqlview1) or die("@error in view part:".mysqli_error($con));
                                // $row1=mysqli_fetch_assoc($result1);
                                $pathx="uploads/PDF/".$user_id.'/';
						         //$file=$row['s_file'];
						        $doc=$pathx.$row['s_file']; ?>
                                <td><a href="<?php echo $doc; ?>" target="_blank"> <?php echo $row['s_file'] ; ?></a>
                                </td>
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
                        <a href="index1.php?pg=dutyleave.php&option=edit&id=<?php echo $id; ?>"><button type="button"
                                class="btn btn-primary btn-xs"><i class="ace-icon fa fa-pencil-square-o bigger-125"></i>
                                Edit</button></a>
                        <?php
		} ?>
                        <a href="index1.php?pg=dutyleave.php&option=view"><button type="button"
                                class="btn btn-pink btn-xs"><i class="ace-icon fa fa-undo bigger-125"></i> Go
                                Back</button></a>
                        <a href="print.php?pr=dutyleave.php&option=find&id=<?php echo $id; ?>"><button type="button"
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
	
	}
}
?>