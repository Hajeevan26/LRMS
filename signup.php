<!--
Author: Hajeevan
Author URL: https://neirahtech.com
-->
<?php  
if(!isset($_SESSION))
{
    session_start();
}

include('connection/config.php');
if(isset($_POST["btnsignup"]))
{
    $password=md5($_POST["cpassword"]);
    $sqlCmd="INSERT into tbl_researchers (c_id,c_name,email,password,nic,tp_no,gender) Values(
        '".mysqli_real_escape_string($con,$_POST["c_id"])."',
     '".mysqli_real_escape_string($con,$_POST["name"])."',
     '".mysqli_real_escape_string($con,$_POST["email"])."',
     '".mysqli_real_escape_string($con,$password)."',
     '".mysqli_real_escape_string($con,$_POST["nic"])."',
     '".mysqli_real_escape_string($con,$_POST["tp_no"])."',
       '".mysqli_real_escape_string ($con,$_POST["gender"])."')";
$result= mysqli_query($con,$sqlCmd) or die("SQL Error".mysqli_error($con));

$sqluser="INSERT into user (user_id,password,role_id,user_name,email,tp_no) Values(
    '".mysqli_real_escape_string($con,$_POST["c_id"])."',
 '".mysqli_real_escape_string($con,$password)."',
 '".mysqli_real_escape_string($con,"R04")."',
 '".mysqli_real_escape_string($con,$_POST["name"])."',
 '".mysqli_real_escape_string($con,$_POST["email"])."', 
   '".mysqli_real_escape_string ($con,$_POST["tp_no"])."')";
$resultuser= mysqli_query($con,$sqluser) or die("SQL Error".mysqli_error($con)); 
    if($result && $resultuser)
    {
        $_SESSION['user_id']=$_POST['c_id'];
        $_SESSION['email']=$_POST['email'];
        $_SESSION['role_id']="R04";
        $_SESSION['user_name']=$_POST['name'];
        //echo '<script> window.location.href="index1.php?pg=reservation.php&option=new";</script>';
       //echo'<script> alert("Account created Successfully");window.location.href="index1.php?pg=reservation.php&option=view";</script>';
      //header('location:index1.php?pg=reservation.php&option=view');
    }
}
if(!isset($_SESSION["user_id"])){
?>
<!DOCTYPE html>
<html>

<head>
    <title>VARS Signup</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script type="application/x-javascript">
    addEventListener("load", function() {
        setTimeout(hideURLbar, 0);
    }, false);

    function hideURLbar() {
        window.scrollTo(0, 1);
    }
    </script>
    <!-- Custom Theme files -->

    <link href="dist/css/signup.css" rel="stylesheet" type="text/css" media="all" />
    <!-- //Custom Theme files -->
    <!-- web font -->
    <link href="//fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,700,700i" rel="stylesheet">
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- //web font -->
</head>

<body>
    <!-- main -->
    <div class="main-w3layouts wrapper">
        <h1> SignUp Form</h1>
        <div class="main-agileinfo">
            <div class="agileits-top">
                <form action="#" method="post">
                    <?php  
                    $sql1 = "SELECT user_id FROM user WHERE user_id LIKE 'C%' order by user_id DESC";
                    $result1 = mysqli_query($con, $sql1) or die("error in select customer Id:" . mysqli_error($con));
                    $row = mysqli_fetch_assoc($result1);
                    
                    if (mysqli_num_rows($result1) > 0) 
                    {
                        $c_id = $row['user_id'];
                        $c_id = ++$c_id;
                    } 
                    else 
                    {
                    // $SUFFIX = '0001 ';
                        $c_id = "C001";
                    }
                    ?>
                    <input class="text" type="hidden" name="c_id" id="c_id" value="<?php  echo $c_id; ?>" readonly>
                    <input class="text" type="text" name="name" placeholder="name" required="">
                    <font color="red">
                        <div id="dividemail"></div>
                    </font>
                    <input class="text email" type="email" name="email" id="email" placeholder="Email"
                        onblur="validEmail()" required="">

                    <input class="text" type="password" name="password" placeholder="Password" required="">
                    <input class="text w3lpass" type="password" name="cpassword" id="cpassword"
                        placeholder="Confirm Password" required="">
                    <input class="text email" type="text" name="nic" id="nic" placeholder="NIC" required="">
                    <div>
                          <input type="radio" checked id="male" name="gender" value="male"> <label>Male</label>
                          <input type="radio" id="female" name="gender" value="female"> <label>Female</label>
                    </div>
                    <input class="text email" type="text" name="tp_no" id="tp_no" onBlur="validatetp()"
                        placeholder="0712345678" required="">
                    <div class="wthree-text">
                        <label class="anim">
                            <input type="checkbox" class="checkbox" name="chkagree" id="chkagree" required="">
                            <span>I Agree To The Terms & Conditions</span>
                        </label>
                        <div class="clear"> </div>
                    </div>
                    <input type="submit" id="btnsignup" name="btnsignup" value="SIGNUP">
                </form>
                <p>Do you have an Account? <a href="index.php"> Login Now!</a></p>
            </div>
        </div>
        <!-- copyright -->
        <div class="colorlibcopy-agile">
            <p>© 2022 EUSL. All rights reserved | Design by <a href="https://neirahtech.com/"
                    target="_blank">Neirahtech</a></p>
        </div>
        <!-- //copyright -->
        <ul class="colorlib-bubbles">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
    </div>
    <!-- //main -->
    <script>
    $(document).ready(function() {

        $('#chkagree').click(function() {
            if ($(this).is(':checked')) {
                $('#btnsignup').removeAttr('disabled');
            } else {
                $('#btnsignup').attr('disabled', 'disabled');
            }
        });
    });
    </script>
    <script>
    $(window).on("load", function() {
        if ($('#chkagree').is(':checked')) {
            $('#btnsignup').removeAttr('disabled');
        } else {
            $('#btnsignup').attr('disabled', 'disabled');
        }
    });
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
    function validEmail() {
        var stremail = document.getElementById("email").value;
        var emailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*.(\.\w{2,3})+$/;
        if (stremail.match(emailformat)) {
            document.getElementById("dividemail").innerHTML = "";
            emailexist();
        } else if (stremail.length == 0) {
            document.getElementById("dividemail").innerHTML = "";
            document.getElementById("email").value = "";
        } else {
            document.getElementById("dividemail").innerHTML = "your email address is not valid";
            document.getElementById("email").value = "";
            document.getElementById("email").focus();
        }
    }
    </script>
</body>

</html>
<?php } 
else
{
    if( $_SESSION['role_id']=="R01"){
        header('location:index1.php?pg=content.php');
    }
    else {
        header('location:index1.php?pg=reservation.php&option=view');
    }
}
?>