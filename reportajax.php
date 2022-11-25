<?php
include('connection/config.php');
	if(!ISSET($_SESSION))
	{
		
		session_start();
	}
	$user_id=$_SESSION['user_id'];
	$role_id=$_SESSION['role_id'];

    if(ISSET($_GET['option']))
	{
		if($_GET['option']=="reservation_report")
		{
            $from_date=$_GET['from_date'];
            $to_date=$_GET['to_date'];
            $d_id=$_GET['d_id'];

            if($role_id=="R01")
            { 
                if($d_id=="all"){
                    $sqlview="SELECT r.*,f.f_name,d.d_name,u.user_name,i.name FROM tbl_reservation as r , tbl_faculty as f , tbl_department as d ,user as u , tbl_instruments as i where r.f_id=f.f_id and r.d_id=d.d_id and r.user_id=u.user_id and i.id=r.i_id and r.r_from>='$from_date' and r.r_to<='$to_date'";
                }
                else{
                    $sqlview="SELECT r.*,f.f_name,d.d_name,u.user_name,i.name FROM tbl_reservation as r , tbl_faculty as f , tbl_department as d ,user as u , tbl_instruments as i where r.f_id=f.f_id and r.d_id=d.d_id and r.user_id=u.user_id and i.id=r.i_id and r.r_from>='$from_date' and r.r_to<='$to_date' and r.d_id='$d_id' ";
                }
            }
            else if($role_id=="R02")
            {
               
                    $sqlview="SELECT r.*,f.f_name,d.d_name,u.user_name,i.name FROM tbl_reservation as r , tbl_faculty as f , tbl_department as d ,user as u , tbl_instruments as i where r.f_id=f.f_id and r.d_id=d.d_id and r.user_id=u.user_id and i.id=r.i_id and r.r_from>='$from_date' and r.r_to<='$to_date' and r.d_id='$d_id'";
                
            }
            else {
                if($d_id=="all")
                {
                    $sqlview="SELECT r.*,f.f_name,d.d_name,u.user_name,i.name FROM tbl_reservation as r , tbl_faculty as f , tbl_department as d ,user as u , tbl_instruments as i where r.f_id=f.f_id and r.d_id=d.d_id and r.user_id=u.user_id and i.id=r.i_id and r.r_from>='$from_date' and r.r_to<='$to_date'  and r.user_id='$user_id'";
                }
                else 
                {
                    $sqlview="SELECT r.*,f.f_name,d.d_name,u.user_name,i.name FROM tbl_reservation as r , tbl_faculty as f , tbl_department as d ,user as u , tbl_instruments as i where r.f_id=f.f_id and r.d_id=d.d_id and r.user_id=u.user_id and i.id=r.i_id and r.r_from>='$from_date' and r.r_to<='$to_date' and r.d_id='$d_id' and r.user_id='$user_id'";
                }
            }
            $result=mysqli_query($con,$sqlview) or die("@error in view part:".mysqli_error($con));
		?>


            <div class="card">
                <div class="card-header">
                    <h3>Reservation Reports</h3>
                </div>
                <div class="card-body">
                    <!-- <input class="form-control" id="search" type="text" placeholder="Search.."> -->
                    <br>
                    <table name="example1" id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <!-- <th>reservation</th> -->
                                <th>Department</th>
                                <th>Equipment & Instruments</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Status</th>
                                
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
              .$row['status'].'</td> </tr>';
                                    }
                      ?>
                        </tbody>
                    </table>
                    
                </div>
            </div>
  
  
<?php
        }
    }
        ?>