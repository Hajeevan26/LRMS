<?php
include('connection/config.php');
	if(!ISSET($_SESSION))
	{
		
		session_start();
	}
	$user_id=$_SESSION['user_id'];
	$role_id=$_SESSION['role_id'];
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>VARS EUSL | Dashboard</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
</head>

<body>
    <div>
        <!-- Navbar -->

        <!-- /.navbar -->

        <!-- Main Sidebar Container -->


        <!-- Content Wrapper. Contains page content -->
        <div>
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Reports</h1>
                        </div>

                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <?php
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
            else
            {
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
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Reservation Report</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <table id="example1" class="table table-bordered table-striped">
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
                                            <tbody>
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

                                                </tfoot>
                                        </table>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.container-fluid -->
            </section>
            <?php  
        }

    }
        ?>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer>
                <strong>Copyright &copy; 2022 <a href="https://EUSL">EUSL</a>.</strong>
                All rights reserved.
                <div class="float-right d-none d-sm-inline-block">
                    <b>Version</b> 3.2.0
                </div>
            </footer>
            <br>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="../../plugins/jszip/jszip.min.js"></script>
    <script src="../../plugins/pdfmake/pdfmake.min.js"></script>
    <script src="../../plugins/pdfmake/vfs_fonts.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
 
    <!-- Page specific script -->
    <script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
    </script>
</body>

</html>