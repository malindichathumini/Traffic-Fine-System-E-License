<!--Insert data to user Table-->

<?php
//Officer Registrtion

if(isset($_POST['btnsubmit'])){
        //Accept Data
        $userid = $_POST["txtusername"];
        $offpw = $_POST["txtpassword"];
        $offRepw = $_POST["txtrepassword"];

        if($offpw == $offRepw)
        {

        //Create Connection
        $con2 = mysqli_connect("localhost:3308","root","");
        mysqli_select_db($con2,"trafficfinesystemdb");

        //Insert Data to user Table
        $userType = "PoliceOfficer";
        $sql2 = "INSERT INTO user (userID,userPW,userType) VALUES ('$userid','$offpw','$userType')";
        $ret2 =mysqli_query($con2,$sql2);        
        
        mysqli_close($con2);
    }else{
        echo "<p style=color:red;>Password and Re-Enter Password are dismatch!!!</p>";
    }
}

?>

<!--Insert data to policeoffiecer Table-->
<?php
    if(isset($_POST['btnsubmit'])){
        //Accept Data
        $id = $_POST["txtofficerid"];
        $name = $_POST["txtname"];        
        $contact = $_POST["txtphone"];
        $Oemail = $_POST["email"];
        $userid = $_POST["txtusername"];
        
            //Create Connection
            $con = mysqli_connect("localhost:3308","root","");
            mysqli_select_db($con,"trafficfinesystemdb");

            //Insert Data to policeofficer Table
            $sql = "INSERT INTO policeoffiecer (policeOfficerID,officerName,officerPhone ,officerEmail,userID) VALUES ('$id','$name','$contact','$Oemail','$userid')";
            $ret = mysqli_query($con,$sql); 
            //reidrect to login.html
            header("Location:signin.php");   
            mysqli_close($con); 
    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration - Step02</title>
    <link rel="stylesheet" type="text/css" href="assets/css/regofficer.css" />  
</head>
<body>
    <div class="hed">
    <div class="content">
            <h1>REGISTRATION FORM</h1>
        </div>
        <div class="icon">
            <img src="assets/gif/reg.gif">
        </div>
    </div>
    <h2 id="hed2">Step 02</h2>
    <div class="form">
    
        <form action="#" method="post" name="frmreg" class="frmreg">
                 Name :<br> <input type="text" name="txtname" class="txtname" placeholder="Enter Your Name Here" required>
                 <br><br>                 
                 Officer ID :<br> <input type="text" name="txtofficerid" id="txtofficerid" placeholder="Enter Officer ID Here"><br><br>                 
                 Contact NO :<br> <input type="text" name="txtphone" class="txtphone" placeholder="EX : 0766666667" required><br><br>
                 Email :<br> <input type="email" name="email" class="email" placeholder="Ex : example@gamil.com"><br><br><br>                        
                    <hr><br><br>
                 Username : <input type="text" name="txtusername" class="txtusername" placeholder="Enter Your Username Here" required><br><br>
                 password : <input type="password" name="txtpassword" class="txtpassword" placeholder="Password" required>
                 Re-Enter Password : <input type="password" name="txtrepassword" class="txtrepassword" placeholder="Re-Enter Password" required><br><br>
                <input type="reset" class="btnclear" value="Clear" name="btnclear">
                <input type="submit" class="btnsubmit" value="Submit" name="btnsubmit">
        </form>
   
    </div>
    
</body>
</html>
