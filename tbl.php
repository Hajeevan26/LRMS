<?php
include('connection/config.php');
if(!isset($_SESSION))
{
	session_start();
}
$role_id=$_SESSION['role_id'];
$user_name=$_SESSION['user_name'];
$user_id=$_SESSION['user_id'];
$emailto=$_SESSION['email'];
 $sqlview="SELECT r.*,f.f_name,d.d_name,u.user_name,i.name FROM tbl_reservation as r , tbl_faculty as f , tbl_department as d ,user as u , tbl_instruments as i where r.f_id=f.f_id and r.d_id=d.d_id and r.user_id=u.user_id and i.id=r.i_id and r.res_id='$res_id'";
 $result=mysqli_query($con,$sqlview) or die("@error in view part:".mysqli_error($con));
 $rowww=mysqli_fetch_assoc($result);
$aa='<html>
<head>
    <title></title>
    
</head>

<body>

    
                <div>
                    Your Reservation details
                </div>

                <div class="card-body">
                <table style="border:black; border-style: solid;" >
                        
                        <tr>
                            <td colspan="6">
                                Dear <b> '.$user_name.' </b> <br>
                                Thank You for booking with us. Please find the Reservation details along with the email.

                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" border: solid 1px red;> Reservation Number :- '.$rowww['res_id'].'</td>
                            <td  border: solid 1px red;><a href="vars/index.php"> My Reservation </a></td>
                            <td  border: solid 1px red;><a href="vars/index.php"> Dashboard </a></td>
                        </tr>
                        <hr>
                       <!-- <tr>
                            <th  border: solid 1px red;>Equipment & Instrument</th>
                            <th border: solid 1px red;>Faculty</th>
                            <th border: solid 1px red;>Department</th>
                            <th border: solid 1px red;>From</th>
                            <th border: solid 1px red;>To</th>
                            <th border: solid 1px red;>Satus</th>
                          
                        </tr>
                        <tr>
                            <td border: solid 1px red;>'.$rowww['name'].'</td>
                            <td border: solid 1px red;>'.$rowww['f_name'].'</td>
                            <td border: solid 1px red;>'.$rowww['d_name'].'</td>
                            <td border: solid 1px red;>'.$rowww['r_from'].'</td>
                            <td border: solid 1px red;>'.$rowww['r_to'].'</td>
                            <td border: solid 1px red;>'.$rowww['status'].'</td>
                        </tr> -->
                        <tr>
                        <td colspan="3">  Equipment & Instrument </td>
                        <td colspan="3"> '.$rowww['name'].' </td>
                        </tr>
                        <tr>
                        <td colspan="3"> Faculty</td>
                        <td colspan="3"> '.$rowww['f_name'].' </td>
                        </tr>
                        <tr>
                        <td colspan="3">  Department</td>
                        <td colspan="3"> '.$rowww['d_name'].' </td>
                        </tr> <tr>
                        <td colspan="3">From</td>
                        <td colspan="3"> '.$rowww['r_from'].' </td>
                        </tr> <tr>
                        <td colspan="3">To</td>
                        <td colspan="3"> '.$rowww['r_to'].' </td>
                        </tr> <tr>
                        <td colspan="3"> Status</td>
                        <td colspan="3"> '.$rowww['status'].' </td>
                        </tr>
                    </table>
                    <br>
                    <p>Thank You</p>
               
</body>

</html>';

//echo $aa;
?>