<?php
if (!isset($_SESSION)) {
	session_start();
}
include('connection/config.php');
//$_SESSION['user_id'] = 1;
$user_id = $_SESSION['user_id'];
$role_id = $_SESSION['role_id'];

//$_SESSION['role_id']=1;
//$role_id = 1;
if(isset($_SESSION['user_id'])) {
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
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
    <link rel="stylesheet" href="dist/css/bootstrap-multiselect.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script>
        document.onmousedown = disableclick;
        status = "Right Click Disabled";

        function disableclick(event) {
            if (event.button == 2) {
                alert(status);
                return false;
            }
        }
    </script>
    <script>
        // for print button
        function printpage() {
            //Get the print button and put it into a variable
            var printButton = document.getElementById("printpagebutton");
            //Set the print button visibility to 'hidden'
            printButton.style.visibility = 'hidden';
            //Print the page content
            window.print()
            //Set the print button to 'visible' again
            //[Delete this line if you want it to stay hidden after printing]
            printButton.style.visibility = 'visible';
        }
    </script>
</head>



<body oncontextmenu="return false" style="background:#ffffff">
    <div class="content">
        <div class="container-fluid">
            <h2>Print</h2>
            <form role="form" action="" method="post">
                <div class="card card-primary">
                    <div class="card-header">
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-12">
 <input id="printpagebutton" type="button" value="Print Report" onclick="printpage()"
                           class="btn btn-primary"/>  <!-- print button, but it was not visible in printed paper  -->

                    <?php

                    if (isset($_GET['pr'])) // if get print
                    {
                        $filename = $_GET['pr'];
                        include($filename);
                    }
                    else
                    {

                    }
                    ?>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</body>

</html>

<?php } ?>