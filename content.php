<!-- Main content -->
<?php     
if($role_id=="R01" || $role_id=="R02"){ ?>


    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <?php 
                include('connection/config.php');
                $query = "SELECT * FROM tbl_reservation where status='pending' "; 
                $result = $con->query($query); 
                $cnt=$result->num_rows 
                ?>
                <h3><?php echo $cnt; ?></h3>

                <p>New Reservation</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="index1.php?pg=reserv_confirm.php&option=view" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>53<sup style="font-size: 20px">%</sup></h3>

                <p>Bounce Rate</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner"> <?php 
              include('connection/config.php');
                $query = "SELECT * FROM tbl_customers"; 
                $result = $con->query($query); 
                if($result){
                  $cnt=$result->num_rows ;
                }
               else {
                $cnt=0 ;
               }
                
                ?>
               <h3><?php echo $cnt; ?></h3>

                <p>User Registrations</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner"><?php 
              include('connection/config.php');
                $query = "SELECT * FROM tbl_reservation"; 
                $result = $con->query($query); 
                $cnt=$result->num_rows 
                ?>
               <h3><?php echo $cnt; ?></h3>

                <p>Total Reservation</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="index1.php?pg=reservation.php&option=view"  class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <?php  }  ?>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
  
    <!-- /.content -->