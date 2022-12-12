<?php
if (!isset($_SESSION)) {
	session_start();
}
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

    <!-- select -->
    <!-- select 2 -->
    <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <!--div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div-->

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="index1.php" class="nav-link">Home</a>
                </li>

            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                    aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

                <!-- Messages Dropdown Menu -->

                <!-- Notifications Dropdown Menu -->

                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#"
                        role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php  include('sidebar.php'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <!-- <h1 class="m-0">Dashboard</h1> -->
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            <?php


//
if (isset($_GET['pg'])) 
{
include($_GET['pg']); 
}

else 
 {
include("content.php");
    
}
?>
            <!-- Main content -->

            <!-- /.content-wrapper -->
            <footer class="main-footer">
                <strong>Copyright &copy; 2022 <a href="https://EUSL">EUSL</a>.</strong>
                All rights reserved.
                <div class="float-right d-none d-sm-inline-block">
                    <b>Version</b> 3.2.0
                </div>
            </footer>

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
        </div>
        <!-- ./wrapper -->

        <!-- jQuery -->
        <script src="plugins/jquery/jquery.min.js"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
        $.widget.bridge('uibutton', $.ui.button)
        </script>
        <!-- Bootstrap 4 -->
        <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- ChartJS -->
        <script src="plugins/chart.js/Chart.min.js"></script>
        <!-- Sparkline -->
        <script src="plugins/sparklines/sparkline.js"></script>
        <!-- JQVMap -->
        <script src="plugins/jqvmap/jquery.vmap.min.js"></script>
        <script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
        <!-- jQuery Knob Chart -->
        <script src="plugins/jquery-knob/jquery.knob.min.js"></script>
        <!-- daterangepicker -->
        <script src="plugins/moment/moment.min.js"></script>
        <script src="plugins/daterangepicker/daterangepicker.js"></script>
        <!-- Tempusdominus Bootstrap 4 -->
        <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
        <!-- Summernote -->
        <script src="plugins/summernote/summernote-bs4.min.js"></script>
        <!-- overlayScrollbars -->
        <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
        <!-- AdminLTE App -->
        <script src="dist/js/adminlte.js"></script>
        <!-- AdminLTE for demo purposes -->
        <!--script src="dist/js/demo.js"></script-->
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="dist/js/pages/dashboard.js"></script>

        <script src="plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>

        <!-- Select2 -->
        <script src="plugins/select2/js/select2.full.min.js"></script>
        <!-- DataTables  & Plugins -->
        <script src="plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
        <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
        <script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
        <script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
        <script src="plugins/jszip/jszip.min.js"></script>
        <script src="plugins/pdfmake/pdfmake.min.js"></script>
        <script src="plugins/pdfmake/vfs_fonts.js"></script>
        <script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
        <script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
        <script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>


        <!-- or export -->
        <script>
        $(document).ready(function() {

            // $('.selectpicker').selectpicker();

            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });

            $("input[data-bootstrap-switch]").each(function() {
                $(this).bootstrapSwitch('state', $(this).prop('checked'));
            })
            // for export table

            ///////////////////////////

            $("#f_id").on("change", function() {
                var f_id = $(this).val();
                $.ajax({
                    url: "action.php",
                    type: "POST",
                    cache: false,
                    data: {
                        f_id: f_id
                    },
                    success: function(data) {
                        $("#dep_id").html(data);
                        $('#i_id').html('<option value="">Select Instruments</option>');
                    }
                });
            });

            // state dependent ajax
            $("#dep_id").on("change", function() {
                var dep_id = $(this).val();

                $.ajax({
                    url: "action.php",
                    type: "POST",
                    cache: false,
                    data: {
                        dep_id: dep_id
                    },
                    success: function(data) {
                        $("#i_id").html(data);
                    }
                });
            });

            $("#f_ide").on("change", function() {
                var f_ide = $(this).val();
                $.ajax({
                    url: "action.php",
                    type: "POST",
                    cache: false,
                    data: {
                        f_ide: f_ide
                    },
                    success: function(data) {
                        $("#dep_ide").html(data);
                        $('#i_ide').html('<option value="">Select Instruments</option>');
                    }
                });
            });

            //

            // state dependent ajax
            $("#dep_ide").on("change", function() {

                var dep_ide = $(this).val();
                // var f_ide=$("#f_ide").val();
                $.ajax({
                    url: "action.php",
                    type: "POST",
                    cache: false,
                    data: {
                        dep_ide: dep_ide
                    },
                    success: function(data) {
                        $("#i_ide").html(data);
                    }
                });
            });

            $("#dep_ide").on("click", function() {

                var d_idei = $("#dep_ide").val();
                var txtd_id = $("#txtd_id").val();
                $.ajax({
                    url: "action.php",
                    type: "POST",
                    cache: false,
                    data: {
                        d_idei: d_idei,
                        txtd_id: txtd_id
                    },
                    data: {
                        d_idei: d_idei
                    },
                    success: function(data) {
                        $("#i_ide").html(data);
                    }
                });
            });


        });
        </script>
        <script>
        $(window).on("load", function() {
            var f_ide = $("#f_ide").val();
            var txtd_id = $("#txtd_id").val();
            $.ajax({
                url: "action.php",
                type: "POST",
                cache: false,
                data: {
                    f_ide: f_ide,
                    txtd_id: txtd_id
                },
                success: function(data) {
                    $("#dep_ide").html(data);
                    $('#i_ide').html('<option value="">Select Instruments</option>');
                }
            });


            var txtd_id = $("#txtd_id").val();
            var txti_id = $("#txti_id").val();
            $.ajax({
                url: "action.php",
                type: "POST",
                cache: false,
                data: {
                    txtd_id: txtd_id,
                    txti_id: txti_id
                },
                success: function(data) {
                    $("#i_ide").html(data);
                }
            });

        });
        </script>

        <script>
        function updateinstrument() {
            var d_id = document.getElementById("d_id").value;
            var f_id = document.getElementById("f_id").value;
            // var household_id = document.getElementById("household_id").value;

            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 & xmlhttp.status == 200) {
                    document.getElementById("div_instruments").innerHTML = xmlhttp.responseText;
                    //  $('#numberr')[0].innerHTML =  $items[] ;
                } else {

                    document.getElementById("div_instruments").innerHTML = "";
                    //window.location.href = "http://www.google.com";
                }
            }
            xmlhttp.open("GET", "ajaxpage.php?option=viewinstruments&d_id=" + d_id + "&f_id=" + f_id,
                true);
            xmlhttp.send();
        }
        //end select vehicle no
        </script>
        <script>
        function updateDepartment() {
            //var d_id = document.getElementById("d_id").value;
            var f_id = document.getElementById("f_id").value;
            // var household_id = document.getElementById("household_id").value;

            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 & xmlhttp.status == 200) {
                    document.getElementById("div_department").innerHTML = xmlhttp.responseText;
                    //  $('#numberr')[0].innerHTML =  $items[] ;
                } else {

                    document.getElementById("div_department").innerHTML = "";
                    //window.location.href = "http://www.google.com";
                }
            }
            xmlhttp.open("GET", "ajaxpage.php?option=viewdepartment&f_id=" + f_id,
                true);
            xmlhttp.send();
        }
        //end select vehicle no
        </script>
        <script>
        function updateDepartmentren() {
            //var d_id = document.getElementById("d_id").value;
            var f_id = document.getElementById("f_id").value;
            // var household_id = document.getElementById("household_id").value;

            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 & xmlhttp.status == 200) {
                    document.getElementById("div_departmentren").innerHTML = xmlhttp.responseText;
                    //  $('#numberr')[0].innerHTML =  $items[] ;
                } else {

                    document.getElementById("div_departmentren").innerHTML = "";
                    //window.location.href = "http://www.google.com";
                }
            }
            xmlhttp.open("GET", "ajaxpage.php?option=viewdepartmentren&f_id=" + f_id,
                true);
            xmlhttp.send();
        }
        //end select vehicle no
        </script>

        <script>
        //for reservation available or not
        function view_status() {
            //var d_id = document.getElementById("d_id").value;
            var f_id = document.getElementById("f_id").value;
            var dep_id = document.getElementById("dep_id").value;
            var i_id = document.getElementById("i_id").value;
            var from = document.getElementById("from").value;
            var to = document.getElementById("to").value;
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 & xmlhttp.status == 200) {
                    document.getElementById("div_status").innerHTML = xmlhttp.responseText;
                    //alert(xmlhttp.responseText) ;
                    //  $('#numberr')[0].innerHTML =  $items[] ;
                    if (xmlhttp.responseText.includes("Not Available")) {
                        var ss = xmlhttp.responseText.includes("Not Available");
                        //alert(ss);
                        document.getElementById("btnsave").disabled = true;
                    } else {
                        document.getElementById("btnsave").disabled = false;
                    }
                } else {

                    document.getElementById("div_status").innerHTML = "";
                    //window.location.href = "http://www.google.com";
                }
            }
            xmlhttp.open("GET", "ajaxpage.php?option=viewresstatus&f_id=" + f_id + "&i_id=" + i_id + "&from=" + from +
                "&to=" + to, true);
            xmlhttp.send();
        }
        //end select vehicle no
        </script>
        <script>
        function deleteconfirm() {
            var x = confirm("Are you sure do you want to delete this record?");
            if (x) {
                return true;
            } else {
                return false;
            }
        }
        </script>
        <script>
        //start validation for telephone No
        function validatetp() {
            var tp_no = document.getElementById("tp_no").value;
            if (tp_no.length == 10) {
                var tpformat = /^[0-9]{10}$/;
                if (tp_no.match(tpformat)) {
                    document.getElementById("tperrormsg").innerHTML = "";
                } else {
                    document.getElementById("tperrormsg").innerHTML =
                        "Your Telephone no must be in numbers & 10 digits";
                    document.getElementById("tp_no").focus();
                }
            } else if (tp_no.length == 0) {
                document.getElementById("tperrormsg").innerHTML = "";
            } else {
                document.getElementById("tperrormsg").innerHTML = "Your Telephone no must be 10 characters";
                document.getElementById("tp_no").focus();
            }

        }
        //End Validation for Telephone No
        </script>
        <script>
        function check_submission() {
            var f_id = document.getElementById("f_id").value;
            // var branch_id = document.getElementById("branch_id").value;
            // var service_type = document.getElementById("service_type").value;
            //var prv = document.getElementById("prv").value;
            // if(veh_no!="f_id" && branch_id!="select" && service_type!="select")

            if (f_id != "select") {

                return true;
            } else {
                alert("select the Faculty");
                return false;
            }
        }
        </script>

        <script>
        function servicereport() {
            var from_date = document.getElementById("from_date").value;
            var to_date = document.getElementById("to_date").value;
            var d_id = document.getElementById("d_id").value;
            //alert(from_date);
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 & xmlhttp.status == 200) {
                    document.getElementById("loaddetails").innerHTML = xmlhttp.responseText;

                    // $("loaddetails").load(window.location.href +" #loaddetails");
                    var x = document.getElementById('loaddetails').innerHTML;
                    document.getElementById('loaddetails').innerHTML = x;

                }
            }
            xmlhttp.open("GET", "reportajax.php?option=reservation_report&from_date=" + from_date + "&to_date=" +
                to_date + "&d_id=" + d_id, true);
            xmlhttp.send();
        }
        </script>
        <script>
        function serviceprint() {
            var from_date = document.getElementById("from_date").value;
            var to_date = document.getElementById("to_date").value;
            var d_id = document.getElementById("d_id").value;
            //var xmlhttp=new XMLHttpRequest();
            var url = "repgen.php?option=reservation_report&from_date=" + from_date + "&to_date=" + to_date + "&d_id=" +
                d_id;
            // var url = "repgen.php&sdate="+ from_date+"&tdate="+to_date + "&d_id=" + d_id;
            window.open(url, "_blank");
        }
        </script>
        <script>
        function emailexist() {
            var email = document.getElementById("email").value;
            //alert(email);
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 & xmlhttp.status == 200) {
                    if (xmlhttp.responseText.trim() == "Allowed") {
                        document.getElementById("dividemail").innerHTML = "";
                    } else {
                        document.getElementById("dividemail").innerHTML = xmlhttp.responseText.trim();
                        document.getElementById("email").value = "";
                    }
                }
            }
            xmlhttp.open("GET", "ajaxsignup.php?option=email_check&email=" + email, true);
            xmlhttp.send();
        }
        </script>



        <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        })
        </script>
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
        <script type="text/javascript">
        // JavaScript program to illustrate 
        // calculation of no. of days between two date 

        // To set two dates to two variables


        //
        function fnGetDays() {

            var a = document.getElementById("from").value;
            var b = document.getElementById("to").value;

            var date1 = new Date(a);
            var date2 = new Date(b);

            var Difference_In_Time = date2.getTime() - date1.getTime();
            var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);
            if (Difference_In_Days > 0) {
                document.getElementById("no_of_days").value = Difference_In_Days;
                document.getElementById("btnsave").disabled = false;
            } else {
                document.getElementById("no_of_days").value = "Please select valid date";
                document.getElementById("btnsave").disabled = true;
            }



        }
        </script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript">
    $(function () {
        $("#chksupp_doc").click(function () {
            if ($(this).is(":checked")) {
                $("#divfile_upload").show();
            } else {
                $("#divfile_upload").hide();
            }
        });
    });
</script>
</body>

</html>
<?php 
}

else {
			header('location:index.php');
		}
        ?>