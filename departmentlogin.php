<?php
if (isset($_POST['btnlogin']))
{
    //Accept Data
    $un = $_POST["txtusername"];
    $pw = $_POST["txtpassword"];

    if($un == "Admin_Police" && $pw == "Admin0000")
    {
        header("Location:departmentdashboard.php");   
            
    }else{
        echo "<p style=color:red;>Invalid Username or Password!!!</p>";
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Department Login</title>
    <link rel="shortcut icon" href="assets/img/Logo.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Merriweather&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="assets/images/fav.jpg">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/fontawsom-all.min.css">
    <link rel="stylesheet" href="assets/plugins/grid-gallery/css/grid-gallery.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/departmentlogin.css" />
    
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
                <input type="submit" name="btnlogin" class="btnlogin" id="btnlogin" value="Login">                
            </form>

        </div>
    </div>
    
</body>
</html>
