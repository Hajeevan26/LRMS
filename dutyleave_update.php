<?php 
if($flag)
{
    $sqlupdateReservation="UPDATE tbl_dutyleave SET 
    user_id='".mysqli_real_escape_string($con,$user_id)."',
    f_id='".mysqli_real_escape_string($con,$_POST['f_ide'])."',
    d_id='".mysqli_real_escape_string($con,$_POST['dep_ide'])."', 
    appointment_date='".mysqli_real_escape_string($con,$_POST['appointment_date'])."',

    from_date='".mysqli_real_escape_string($con,$_POST['from'])."',
    to_date='".mysqli_real_escape_string($con,$_POST['from'])."', 
    reason='".mysqli_real_escape_string($con,$_POST['reason'])."',
    s_file='".mysqli_real_escape_string($con,$filename)."',
    acting_officer='".mysqli_real_escape_string($con,$_POST['acting_officer'])."', 
    no_of_days='".mysqli_real_escape_string($con,$_POST['no_of_days'])."' where id='$id'";
    $resultReservation=mysqli_query($con,$sqlupdateReservation)or die("error in update Instruments part:".mysqli_error($con));
    if($resultReservation)
    {
         echo '<script>alert("your data added successfully");//window.location.href="index1.php?pg=dutyleave.php&option=view";</script>';
    
    }
}
else{
    $sqlupdateReservation="UPDATE tbl_dutyleave SET 
    user_id='".mysqli_real_escape_string($con,$user_id)."',
    f_id='".mysqli_real_escape_string($con,$_POST['f_ide'])."',
    d_id='".mysqli_real_escape_string($con,$_POST['dep_ide'])."', 
    appointment_date='".mysqli_real_escape_string($con,$_POST['appointment_date'])."',

    from_date='".mysqli_real_escape_string($con,$_POST['from'])."',
    to_date='".mysqli_real_escape_string($con,$_POST['from'])."', 
    reason='".mysqli_real_escape_string($con,$_POST['reason'])."',
    
    acting_officer='".mysqli_real_escape_string($con,$_POST['acting_officer'])."', 
    no_of_days='".mysqli_real_escape_string($con,$_POST['no_of_days'])."' where id='$id'";
    $resultReservation=mysqli_query($con,$sqlupdateReservation)or die("error in update Instruments part:".mysqli_error($con));
    if($resultReservation)
    {
         echo '<script>alert("your data added successfully");window.location.href="index1.php?pg=dutyleave.php&option=view";</script>';
    
    } 
}
?>