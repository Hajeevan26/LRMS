<?php
include('connection/config.php');
if(!isset($_SESSION))
{
	session_start();
}
$role_id=$_SESSION['role_id'];
$user_id=$_SESSION['user_id'];
$emailto=$_SESSION['email'];
?>
<div class="content">
    <div class="container-fluid">



        <?php
		//Generate Vehicle id automatically-start
        $sql1="select res_id from tbl_reservation order by res_id DESC";
        $result1=mysqli_query($con,$sql1)or die("error in insert Vehicle Id:".mysqli_error());
        $row=mysqli_fetch_assoc($result1);
        $res_id=$row['res_id'];
        if(mysqli_num_rows($result1)>0)
        {
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
                            <!-- <select name="f_id" class="form-select" id="f_id"> -->
                                <select class="form-control" id="f_id1" name="f_id1" required onchange="fndep()">
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
                           <div id="dividdep1">

                           </div>
                        </div>

                        <div class="col-md-4">
                            <!-- City dropdown -->
                            <label for="country">Instrument</label>
                            <select class="form-control" id="i_id" name="i_id" required onchange="view_status()">
                                <!-- <select class="form-control selectpicker" id="i_id" data-live-search="true" required onchange="view_status()"> -->
                                <!-- <select name="i_id" class="form-select" id="i_id">  -->
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
                                    name="from" id="from" min="<?php echo $dt-1 ?>" onchange="view_status()">
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

                    <!-- hajee -->

                    <!-- hajee -->
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
	