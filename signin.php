<?php
//login in quary

if(isset($_POST['btnlogin'])){
    session_start();
    $id = $_POST["txtusername"];
    $pw = $_POST["txtpassword"];
    $utype = $_POST["cmbtype"]; 

    // Create Connection
    $con = mysqli_connect("localhost:3308","root","");
    mysqli_select_db($con,"trafficfinesystemdb");

    // SQL command Select userid,user password, user type from users
    $sql = "SELECT * FROM user WHERE  userid = '$id' AND userPW = '$pw' AND userType = '$utype' AND userAccStatus = 'Approved'";
    $result = mysqli_query($con, $sql);                 

    if($row = mysqli_fetch_array($result))
    {
        $_SESSION['userid'] = $id;
        $_SESSION['userType'] = $utype;
        if($utype == "Client")
        {
            // Redirect to userdashboard.php
            header("Location: userdashboard.php");
            exit();
        }
        else if ($utype == "PoliceOfficer") {
            // Redirect to OfficerDashboard.php
            header("Location: OfficerDashboard.php");
            exit();
        }
    }
    else
    {
        echo "<p style=color:red;>Invalid Username or Password or Your Account is not Approved!! Please try again.</p>";
    }
    mysqli_close($con);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="assets/css/signin.css" />
</head>
<body>
<div class="mainbg">
        <div class="icon">
            
            <img src="assets/gif/login.gif" alt="">
        </div>
        <div class="form">
            <form method="post" class="frmlogin" id="frmlogin" action="#">
                <h2>LOGIN</h2>
                <input type="text" name="txtusername" class="txtusername" id="txtusername"  placeholder="Enter Your Username Here" required><br>
                <input type="password" name="txtpassword" class="txtpassword" id="txtpassword" placeholder="Enter Your Password Here" required><br>
                <select name="cmbtype" id="cmbtype">
                <option value="Client" id="Client">Client</option>
                <option value="PoliceOfficer" id="PoliceOfficer">Police Officer</option>
               </select><br><br>
                <input type="submit" name="btnlogin" class="btnlogin" id="btnlogin" value="Login">
                <p id="para1">If You new to this <a href="signup.php">Register</a> Now..!</p> 
            </form>

        </div>
    </div>
    
</body>
</html>



