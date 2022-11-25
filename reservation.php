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
    $res_id=$_POST["res_id"];
	$sqlCmd="INSERT into tbl_reservation (res_id,user_id,f_id,d_id,i_id,res_datetime,r_from,r_to) Values(
                                                                '".mysqli_real_escape_string($con,$res_id)."',
                                                               '".mysqli_real_escape_string ($con,$user_id)."',
                                                               '".mysqli_real_escape_string ($con,$_POST["f_id"])."',
                                                               '".mysqli_real_escape_string ($con,$_POST["dep_id"])."',
                                                               '".mysqli_real_escape_string ($con,$_POST["i_id"])."',
                                                               '".mysqli_real_escape_string ($con,$_POST["res_datetime"])."',
                                                               '".mysqli_real_escape_string ($con,$_POST["from"])."',
                                                               '".mysqli_real_escape_string ($con,$_POST["to"])."')";
	$result= mysqli_query($con,$sqlCmd) or die("SQL Error".mysqli_error($con));
	if($result)
	{
        $sql2="SELECT R.*,D.d_name,F.f_name ,I.name,U.email,U.tp_no,U.user_name FROM tbl_reservation as R, tbl_department as D,tbl_faculty as F ,tbl_instruments as I ,user as U where R.d_id=D.d_id and R.f_id=F.f_id and I.id=R.i_id and R.user_id=U.user_id and R.res_id='$res_id'";
        //$sql2="select r.reserve_date,r.reserve_time,c.tp_no from tblreservation as r,tblcustomer as c,tblvehicle as v where r.reservation_id='$reservation_id' and v.cus_id=c.cus_id and v.veh_id=r.veh_id";
        $result2=mysqli_query($con,$sql2)or die("error in select part:".mysqli_error($con));
        $row=mysqli_fetch_assoc($result2);
        $emailto=$row['email'];
        //$user = "94769669804";
        $user = "94752831538";
        //$password = "3100";
        $password = "4786";
        $msg='Dear '.$row['user_name'].' your reservation is successfully created on '.$row['r_from'].' at '.$row['r_to'].' and you will get notification after the confirmed by Admin' ;
        
        $text = urlencode($msg);
        $to = "94".$row['tp_no'];
        
        $baseurl ="http://www.textit.biz/sendmsg";
        $url = "$baseurl/?id=$user&pw=$password&to=$to&text=$text";
        $ret = file($url);
        //email
        $d_id=$_POST["dep_id"];
        $sqlview="SELECT d_email from tbl_department where d_id='$d_id' LIMIT 1 ";
        $result=mysqli_query($con,$sqlview) or die("@error in view part:".mysqli_error($con));
        $row2=mysqli_fetch_array($result);
        $nor=mysqli_num_rows($result);
        if($nor>0){
            $cc=$row2['d_email'];
        }
        else
        {
            $cc="hajeevans@esn.ac.lk";
        }
        
        $subject="Your Reservation was successfully submited";
        $AltBody="You will get confirmation when Admin accept your request";
        $emailHtmlcontent="tbl.php";
        // include('mail.php');
        include('mailU.php');
		echo '<script>alert("your data added successfully");window.location.href="index1.php?pg=reservation.php&option=view";</script>';
		
	}
}
if(isset($_POST["btnupdate"]))
{
    $res_id=$_POST['res_id'];
    $emailto=$_SESSION['email'];

	$sqlupdateReservation="UPDATE tbl_reservation SET 
    user_id='".mysqli_real_escape_string($con,$user_id)."',
    f_id='".mysqli_real_escape_string($con,$_POST['f_ide'])."',
    d_id='".mysqli_real_escape_string($con,$_POST['dep_ide'])."',
   
    i_id='".mysqli_real_escape_string($con,$_POST['i_ide'])."',
    res_datetime='".mysqli_real_escape_string($con,$_POST['res_datetime'])."',
    r_from='".mysqli_real_escape_string($con,$_POST['from'])."',

    r_to='".mysqli_real_escape_string($con,$_POST['to'])."' where res_id='$res_id'";
    $resultReservation=mysqli_query($con,$sqlupdateReservation)or die("error in update Instruments part:".mysqli_error($con));
    if($resultReservation)
    {
        // $sql2="SELECT R.*,D.d_name,F.f_name ,I.name,U.email,U.tp_no,U.user_name FROM tbl_reservation as R, tbl_department as D,tbl_faculty as F ,tbl_instruments as I ,user as U where R.d_id=d.d_id and R.f_id=F.f_id and I.id=R.i_id and R.user_id=U.user_id and R.res_id='$res_id'";
        // //$sql2="select r.reserve_date,r.reserve_time,c.tp_no from tblreservation as r,tblcustomer as c,tblvehicle as v where r.reservation_id='$reservation_id' and v.cus_id=c.cus_id and v.veh_id=r.veh_id";
        // $result2=mysqli_query($con,$sql2)or die("error in select part:".mysqli_error());
        // $row=mysqli_fetch_assoc($result2);
       
        $action="Add Update Reservation";
        $d_id=$_POST["dep_ide"];
        $sqlview="SELECT d_email from tbl_department where d_id='$d_id' LIMIT 1 ";
        $result=mysqli_query($con,$sqlview) or die("@error in view part:".mysqli_error($con));
        $row2=mysqli_fetch_array($result);
        $nor=mysqli_num_rows($result);
        if($nor>0)
        {
            $cc=$row2['d_email'];
        }
        else
        {
            $cc="hajeevans@esn.ac.lk";
        }

        $subject="Your Reservation has been Updated";
        $AltBody="You will get confirmation when Admin accept your request";
        $emailHtmlcontent="tbl.php";
        // include('mail.php');
        include('mailU.php');
            echo '<script>alert("your data added successfully");window.location.href="index1.php?pg=reservation.php&option=view";</script>';
    
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
        $sql1="select res_id from tbl_reservation order by res_id DESC";
        $result1=mysqli_query($con,$sql1)or die("error in insert Vehicle Id:".mysqli_error());
        $row=mysqli_fetch_assoc($result1);
        // $res_id=$row['res_id'];
        if(mysqli_num_rows($result1)>0)
        {
            $res_id=$row['res_id'];
            $res_id=++$res_id;
        }
        else{
            $res_id="R001";
        }
        ?>

        <form role="form" action="" method="post">
            <div class="card card-primary">
                <div class="card-header">
                    <h2>Your Reservation Number is - <?php echo $res_id; ?></h2>
                </div>

                <div class="card-body">
                    <div class="row">
                        <input type="hidden" name="res_id" id="res_id" value="<?php echo $res_id; ?>" readonly
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
						echo '<option value="">Faculty not available</option>'; 
					}
					?>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <!-- State dropdown -->
                            <label for="country">Department</label>
                            <select class="form-control select2bs4" id="dep_id" name="dep_id" required
                                onchange="view_status()">
                                <option value="0">Select reservation</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <!-- City dropdown -->
                            <label for="country">Instrument</label>
                            <select class="form-control select2bs4" id="i_id" name="i_id" data-live-search="true"
                                required onchange="view_status()">
                                <option value="0">Select Department</option>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Current date</label>
                            <div class="col-sm-10">
                                <?php  $dt = new DateTime();  $dt= $dt->format('Y-m-d\TH:i:s');  ?>
                                <input type="datetime-local" readonly class="form-control" value="<?php echo  $dt;  ?>"
                                    name="res_datetime" id="res_datetime" min="<?php echo $dt ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>From</label>
                            <div class="col-sm-10">
                                <?php  $dt = new DateTime();  $dt= $dt->format('Y-m-d\TH:i:s');  ?>
                                <input type="datetime-local" class="form-control" value="<?php echo  $dt;  ?>"
                                    name="from" id="from" min="<?php echo $dt ?>" onchange="view_status()">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label>To</label>
                            <div class="col-sm-10">
                                <?php  $dt = new DateTime();  $dt= $dt->format('Y-m-d\TH:i:s');  ?>
                                <input type="datetime-local" class="form-control" name="to" id="to"
                                    onchange="view_status()" value="<?php echo  $dt; ?>" min="<?php echo $dt ?>">
                            </div>
                        </div>


                    </div>
                    <br>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div id="div_status">
                            </div>
                        </div>
                    </div>
                </div>
                <br>

            </div>
            <div class="card-footer">
                <a href="index1.php?pg=reservation.php&option=view"><button type="button" class="btn btn-danger"><i
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
                <div class="col-sm-3"> <a href="index1.php?pg=reservation.php&option=new">
                        <button type=button class="btn btn-block bg-gradient-success"><i
                                class="ace-icon fa fa-trash-o bigger-120"></i>new</button></a></div>
            </div>
            <br>
            <div class="card card-primary">
                <div class="card-header">
                    Reservation Information
                </div>
                <div class="card-body">


                    <?php  
                            if($role_id=="R01")
                            { 
                            $sqlview="SELECT r.*,f.f_name,d.d_name,u.user_name,i.name FROM tbl_reservation as r , tbl_faculty as f , tbl_department as d ,user as u , tbl_instruments as i where r.f_id=f.f_id and r.d_id=d.d_id and r.user_id=u.user_id and i.id=r.i_id";
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
                                <th>Equipment & Instruments</th>
                                <th>From</th>
                                <!-- <th>To</th> -->
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="myTable">
                            <?php while($row=mysqli_fetch_assoc($result)) {
              echo '<tr> <td>'
              .$row['res_id'].'</td><td>'
            //   .$row['f_name'].'</td><td>'
              .$row['d_name'].'</td><td>' 
              .$row['name'].'</td><td>' 
              .$row['r_from'].'</td><td>' 
            //   .$row['r_to'].'</td><td>' 
             
              .$row['status'].'</td>'; 
              echo'<td><a href="index1.php?pg=reservation.php&option=find&res_id='.$row['res_id'].'">
                                        <button type=button disabled class="btn btn-xs btn-purple"><i class="ace-icon fa  fa-eye"></i>View</button></a>';
                        echo'<a href="index1.php?pg=reservation.php&option=edit&res_id='.$row['res_id'].'">
                                        <button type=button class="btn btn-xs btn-primary"><i class="ace-icon fa fa-pencil-square-o bigger-120"></i>Edit</button></a>';
                        echo'<a href="index1.php?pg=reservation.php&option=delete&res_id='.$row['res_id'].'">
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
          $res_id=  $_GET['res_id'];
            $sql1="select * from tbl_reservation where res_id='$res_id'";
            $result1=mysqli_query($con,$sql1)or die("error in insert Vehicle Id:".mysqli_error());
            $row=mysqli_fetch_assoc($result1);
            $res_id=$row['res_id'];
            
            ?>


        <form role="form" action="" id="frmres" method="post">
            <div class="card card-primary">
                <div class="card-header">
                    <h3>Edit Reservation - <?php echo $res_id; ?></h3>
                </div>

                <input type="hidden" id="txtf_id" name="txtf_id" value="<?php echo $row['f_id']; ?>">
                <input type="hidden" id="txtd_id" name="txtd_id" value="<?php echo $row['d_id']; ?>">
                <input type="hidden" id="txti_id" name="txti_id" value="<?php echo $row['i_id']; ?>">
                <input type="hidden" id="emailto" name="emailto" value="<?php echo $emailto; ?>">


                <div class="card-body">
                    <div class="row">
                        <input type="hidden" name="res_id" id="res_id" value="<?php echo $res_id; ?>" readonly
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
                            <label for="country">Instrument</label>
                            <select class="form-control select2bs4" id="i_ide" name="i_ide" required>
                                <option value="0">Select Department</option>
                            </select>

                        </div>


                    </div>
                    <hr>

                    <div class="row">
                        <div class="col-md-4">
                            <label>Current date</label>
                            <div class="col-sm-10">
                                <?php  $dt = new DateTime();  $dt= $dt->format('Y-m-d\TH:i:s');  ?>
                                <input type="datetime-local" readonly class="form-control" value="<?php echo  $dt;  ?>"
                                    name="res_datetime" id="res_datetime" min="<?php echo $dt ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>From</label>
                            <div class="col-sm-10">
                                <?php $exampleDate=$row['r_from'];
                            $newDate = date('Y-m-d\TH:i:s', strtotime($exampleDate)); ?>
                                <input type="datetime-local" class="form-control" value="<?php echo  $newDate;  ?>"
                                    name="from" id="from" min="<?php echo $dt-1 ?>">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label>To</label>
                            <div class="col-sm-10">
                                <?php  $exampleDate=$row['r_to'];
                            $newDatee = date('Y-m-d\TH:i:s', strtotime($exampleDate)); ?>
                                <input type="datetime-local" class="form-control" name="to" id="to"
                                    value="<?php echo  $newDatee; ?>" min="<?php echo $newDatee ?>">
                            </div>
                        </div>


                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Status</label>
                            <div class="col-sm-12">
                                <input type="text" readonly class="form-control" name="status" id="status"
                                    value="<?php echo  $row['status']; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <span class="badge badge-success"> Available </span>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="index1.php?pg=reservation.php&option=view"><button type="button" class="btn btn-danger"><i
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
	
	if ($_GET['option']=="delete")
	{
	
	}
}
?>