<?php
include('connection/config.php');
if(!isset($_SESSION))
{
	session_start();
}
$role_id=$_SESSION['role_id'];
$user_id=$_SESSION['user_id'];

$sqlviews="SELECT * from tbl_staff where s_id='$user_id'";
$results=mysqli_query($con,$sqlviews) or die("@error in view part:".mysqli_error($con));
$rwuserInfo=mysqli_fetch_assoc($results);
$ud_id=$rwuserInfo['d_id'];
//End Update part in Instruments
if (isset($_GET['option']))
{
	//start insert Form in Instruments
	

	if ($_GET['option']=="view")
	{?>
<div class="content">
    <div class="container-fluid">

        <form role="form" action="" method="post">
            <div class="card card-primary">
                <div class="card-header">
                    <h3>Reservation Confirm</h3>
                </div>
                <div class="card-body">
                    <?php  
if($role_id=="R01"){
    $sqlview="SELECT R.*,D.d_name,D.d_email,F.f_name ,I.name,U.email FROM tbl_reservation as R, tbl_department as D,tbl_faculty as F ,tbl_instruments as I ,user as U where R.status='pending' and R.d_id=d.d_id and R.f_id=F.f_id and I.id=R.i_id and R.user_id=U.user_id   order by res_id DESC";
}
else {
    $sqlview="SELECT R.*,D.d_name,D.d_email,F.f_name ,I.name,U.email FROM tbl_reservation as R, tbl_department as D,tbl_faculty as F ,tbl_instruments as I ,user as U where R.status='pending' and R.d_id=d.d_id and R.f_id=F.f_id and I.id=R.i_id and R.user_id=U.user_id and R.d_id='$ud_id'  order by res_id DESC";
}
                   
                   // $sqlview="SELECT i.*,f.f_name,d.d_name FROM tbl_Instruments as i,tbl_faculty as f,tbl_department as d where i.status='active' and f.f_id=i.f_id and d.d_id=i.d_id";
                    $result=mysqli_query($con,$sqlview) or die("@error in view part:".mysqli_error($con));
                    //$row=mysqli_fetch_assoc($result); ?>

                    <input class="form-control" id="myInput" type="text" placeholder="Search..">
                    <br>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <!-- <th>Faculty</th> -->
                                <th>Department</th>
                                <th>Instrument</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Booked By</th>
                                <!-- <th>Booked date</th> -->
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
      .$row['r_to'].'</td><td>'
   
      .$row['email'].'</td>'; 
     
      echo'<td><a href="index1.php?pg=reserv_confirm.php&option=confirm&res_id='.$row['res_id'].'">
      <button type=button class="btn btn-xs btn-success"><i class="ace-icon glyphicon glyphicon-ok"></i>Confirm</button></a>';
      echo' <a href="index1.php?pg=reserv_confirm.php&option=reject&res_id='.$row['res_id'].'">
      <button type=button class="btn btn-xs btn-danger"><i class="ace-icon glyphicon glyphicon-remove"></i>Reject</button></a></td></tr>';
							}
              ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </form>

    </div>
</div>

<!-- hh -->
<div class="content">
    <div class="container-fluid">

        <form role="form" action="" method="post">
            <div class="card card-primary">
                <div class="card-header">
                    <h3>Rejected Reservations</h3>
                </div>
                <div class="card-body">
                    <?php  
                    if($role_id=="R01"){
                    $sqlview="SELECT R.*,D.d_name,F.f_name ,I.name,U.email FROM tbl_reservation as R, tbl_department as D,tbl_faculty as F ,tbl_instruments as I ,user as U where R.status='rejected' and R.d_id=d.d_id and R.f_id=F.f_id and I.id=R.i_id and R.user_id=U.user_id   order by res_id DESC";
                    }
                    else {
                        $sqlview="SELECT R.*,D.d_name,F.f_name ,I.name,U.email FROM tbl_reservation as R, tbl_department as D,tbl_faculty as F ,tbl_instruments as I ,user as U where R.status='rejected' and R.d_id=d.d_id and R.f_id=F.f_id and I.id=R.i_id and R.user_id=U.user_id and R.d_id='$ud_id'  order by res_id DESC"; 
                    }
                    // $sqlview="SELECT i.*,f.f_name,d.d_name FROM tbl_Instruments as i,tbl_faculty as f,tbl_department as d where i.status='active' and f.f_id=i.f_id and d.d_id=i.d_id";
                    $result=mysqli_query($con,$sqlview) or die("@error in view part:".mysqli_error($con));
                    //$row=mysqli_fetch_assoc($result); ?>

                    <input class="form-control" id="myInput" type="text" placeholder="Search..">
                    <br>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <!-- <th>Faculty</th> -->
                                <th>Department</th>
                                <th>Instrument</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Booked By</th>
                                <!-- <th>Booked date</th> -->
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
      .$row['r_to'].'</td><td>'
   
      .$row['email'].'</td>'; 
     
      echo'<td><a href="index1.php?pg=reserv_confirm.php&option=pending&res_id='.$row['res_id'].'">
						<button type=button class="btn btn-xs btn-success"><i class="ace-icon glyphicon icon-spinner"></i>Pending</button></a>';
						echo' <a href="index1.php?pg=reserv_confirm.php&option=delete&res_id='.$row['res_id'].'">
						<button type=button class="btn btn-xs btn-danger"><i class="ace-icon glyphicon glyphicon-remove"></i>Delete</button></a></td></tr>';
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
    elseif($_GET['option']=="confirm")
    {
    $res_id=$_GET['res_id'];
    $sql1="update tbl_reservation set status='confirm' where res_id='$res_id'";
    $result1=mysqli_query($con,$sql1)or die("error in confirm part:".mysqli_error());
    
    //send sms to cutomer
    $sql2="SELECT R.*,D.d_id,D.d_name,F.f_name ,I.name,U.email,U.tp_no,U.user_name FROM tbl_reservation as R, tbl_department as D,tbl_faculty as F ,tbl_instruments as I ,user as U where R.d_id=d.d_id and R.f_id=F.f_id and I.id=R.i_id and R.user_id=U.user_id and R.res_id='$res_id'  order by res_id DESC";
    //$sql2="select r.reserve_date,r.reserve_time,c.tp_no from tblreservation as r,tblcustomer as c,tblvehicle as v where r.reservation_id='$reservation_id' and v.cus_id=c.cus_id and v.veh_id=r.veh_id";
    $result2=mysqli_query($con,$sql2)or die("error in select part:".mysqli_error());
    $row=mysqli_fetch_assoc($result2);
    $emailto=$row['email'];
    //$user = "94769669804";
    $user = "94752831538";
    //$password = "3100";
    $password = "4786";
    $msg='Dear '.$row['user_name'].' your reservation is confirm on '.$row['r_from'].' at '.$row['r_to'];
    
    $text = urlencode($msg);
    $to = "94".$row['tp_no'];
    
    $baseurl ="http://www.textit.biz/sendmsg";
    $url = "$baseurl/?id=$user&pw=$password&to=$to&text=$text";
    $ret = file($url);	
     //email
     $d_id=$row["d_id"];
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
        
     $subject="Your Reservation is accepted";
     $AltBody="Reservation Confirmation Notification";
     $emailHtmlcontent="tbl.php";
     // include('mail.php');
     include('mailU.php');

    // include('mail_confirm.php');
  
    echo '<script> location.replace("index1.php?pg=reserv_confirm.php&option=view"); </script>';
    //End send msg code		
    }
    //for request reject	
    elseif($_GET['option']=="reject")
    {
    $res_id=$_GET['res_id'];
    $sqlreject="update tbl_reservation set status='rejected' where res_id='$res_id'";
    $resultreject=mysqli_query($con,$sqlreject)or die("error in reject part:".mysqli_error());
    echo '<script> location.replace("index1.php?pg=reserv_confirm.php&option=view"); </script>';
    
    }
    elseif($_GET['option']=="delete")
    {
    $reservation_id=$_GET['res_id'];
    $sqlreject="delete from tbl_reservation where res_id='$reservation_id'";
    //$resultreject=mysqli_query($con,$sqlreject)or die("error in reject part:".mysqli_error());
    header('location:index1.php?pg=reserv_confirm.php&option=view');
    
    }
    elseif($_GET['option']=="pending")
    {
    $res_id=$_GET['res_id'];
    $sqlreject="update tbl_reservation set status='pending' where res_id='$res_id'";
    $resultreject=mysqli_query($con,$sqlreject)or die("error in reject part:".mysqli_error());
  echo ' <script> window.location.href="index1.php?pg=reserv_confirm.php&option=view";</script>';
    
    }
    }
    ?>