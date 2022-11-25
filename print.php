<?php
if (!isset($_SESSION)) {
    session_start();
}

include('connection/config.php');
date_default_timezone_set('Asia/Colombo');
?>
<html>
<html lang="en">
<head>
    <!-- GLOBAL STYLES -->
    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.css"/>
    <link rel="stylesheet" href="assets/css/main.css"/>
    <link rel="stylesheet" href="assets/css/theme.css"/>
    <link rel="stylesheet" href="assets/css/MoneAdmin.css"/>
    <link rel="stylesheet" href="assets/plugins/Font-Awesome/css/font-awesome.css"/>
    <!--END GLOBAL STYLES -->
    <link href="assets/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet"/>


   
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
<body oncontextmenu="return false" style="background:#ffffff"><tr>
<table class="table-responsive" width="1200" border="0" align="center">
    <tr>  <!-- banner start -->
        <td><img width="100%" height="250" src="images/Auto.jpg"/></td>
    </tr>
    <!-- banner end -->
    <tr class="panel panel-default">
        <div class="panel-heading">
          <h4 ><center>  Reports</center></h4>
        </div>
        <tr>
            <div class="panel-body">
                <td center>
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
                </td>
            </div>
        </tr>
    </tr>
    </div>
	</table>
</body>
</html>
