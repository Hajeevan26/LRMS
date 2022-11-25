<html>
<head>
    <title></title>
</head>

<body>
    <div class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-header">
                    Your Reservation details
                </div>

                <div class="card-body">
                    <table class="table table-bordered">
                        
                        <tr>
                            <td colspan="6">
                                Dear <b> ".$user_name." </b> <br>
                                Thank You for booking with us. Please find the Reservation details along with the email.

                            </td>
                        </tr>
                        <tr>
                            <td colspan="4"> Reservation Number :- ".$rowww['res_id']."</td>
                            <td ><a href="vars/index.php"> My Reservation </a></td>
                            <td ><a href="vars/index.php"> Dashboard </a></td>
                        </tr>
                        <tr>
                            <th>Equipment & Instrument</th>
                            <th>Faculty</th>
                            <th>Department</th>
                            <th>From</th>
                            <th>To</th>
                            <th>Satus</th>
                          
                        </tr>
                        <tr>
                            <td>".$rowww['name']."</td>
                            <td>".$rowww['f_name']."</td>
                            <td>".$rowww['d_name']."</td>
                            <td>".$rowww['r_from']."</td>
                            <td>".$rowww['r_to']."</td>
                            <td>".$rowww['status']."</td>
                        </tr>
                    </table>
                    <br>
                    <p>Thank You</p>
                </div>
            </div>
        </div>
</body>

</html>