<!--Insert data to user Table-->

<?php
//Register Client

if(isset($_POST['btnsubmit'])){
        //Accept Data
        $userid = $_POST["txtusername"];
        $cpw = $_POST["txtpassword"];
        $cRepw = $_POST["txtrepassword"];

        if($cpw == $cRepw)
        {

        //Create Connection
        $con2 = mysqli_connect("localhost:3308","root","");
        mysqli_select_db($con2,"trafficfinesystemdb");

        //Insert Data to user Table
        $userType = "Client";
        $sql2 = "INSERT INTO user (userID,userPW,userType) VALUES ('$userid','$cpw','$userType')";
        $ret2 =mysqli_query($con2,$sql2);        
        
        mysqli_close($con2);
    }else{
        echo "<p style=color:red;>Password and Re-Enter Password are dismatch!!!</p>";
    }
}

?>

<!--Insert data to client Table-->
<?php
if(isset($_POST['btnsubmit'])){
    // Accept Data
    $cdrl = $_POST["txtlicense"];
    $cname = $_POST["txtname"];
    $cnic = $_POST["txtnic"];
    $cphone = $_POST["txtphone"];
    $caddress = $_POST["txtaddress"];
    $cemail = $_POST["email"];
    $image_name = $_FILES["image"]["name"];
    $userid = $_POST["txtusername"];

    // Create Connection
    $con = mysqli_connect("localhost:3308", "root", "");
    mysqli_select_db($con, "trafficfinesystemdb");

    // Define the upload directory and path
    $upload_dir = "image/";  // Make sure the "image" folder exists
    $upload_path = $upload_dir . $image_name;

    // Check if the file was successfully uploaded
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $upload_path)) {
        // Insert Data into client Table
        $sql = "INSERT INTO client (licenseNO, cName, NIC, cPhone, cAddress, cEmail, licenseImage, userID) 
        VALUES ('$cdrl', '$cname', '$cnic', '$cphone', '$caddress', '$cemail', '$image_name', '$userid')";

        // Prepare the statement
        $stmt = mysqli_prepare($con, $sql);

        if ($stmt) {
            // Execute the statement
            $ret = mysqli_stmt_execute($stmt);

            if ($ret) {
                echo "No of records inserted: " . mysqli_affected_rows($con) . "<br>";

                // Redirect to login.html
                header("Location: signin.php");
            } else {
                echo "Error: " . mysqli_error($con);
            }

            mysqli_stmt_close($stmt);
        } else {
            echo "Error: " . mysqli_error($con);
        }
    } else {
        echo "Error uploading the image.";
    }

    mysqli_close($con);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration - Step02</title>
    <link rel="stylesheet" type="text/css" href="assets/css/regclient.css" />  
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
    
        <form action="#" method="post" name="frmreg" class="frmreg" enctype="multipart/form-data">
                 Name :<br> <input type="text" name="txtname" class="txtname" placeholder="Enter Your Name Here" required>
                 <br><br>
                 Address :<br> <textarea name="txtaddress" id="txtaddress" cols="20" rows="5" required></textarea>
                 NIC : <input type="text" name="txtnic" id="txtnic" placeholder="Enter NIC Number Here"><br><br>
                 License NO : <input type="text" name="txtlicense" id="txtlicense" placeholder="Enter License Number Here"><br><br>
                 Contact NO : <input type="text" name="txtphone" class="txtphone" placeholder="EX : 0766666667" required><br><br>
                 Email : <input type="email" name="email" class="email" placeholder="Ex : example@gamil.com"><br><br>
                 License Image :  <input type="file" id="image" name="image" accept="image/*" required><br><br>           
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
