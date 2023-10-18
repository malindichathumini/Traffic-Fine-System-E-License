<?php 
	//OfficerDashboard.php to session 
	session_start();
	$_username = $_SESSION['userid'];
    echo "<h4>Welcome, ".$_username."!</h4>";

?>

<?php
if(isset($_POST["btnlogout"])) 
{
    //add page to Session
	session_start();
	//Distroy the session
	session_destroy();

	//Redirect to login.php
	header("Location:index.html");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Client</title>
    <link rel="shortcut icon" href="assets/img/Logo.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Merriweather&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="assets/images/fav.jpg">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/fontawsom-all.min.css">
    <link rel="stylesheet" href="assets/plugins/grid-gallery/css/grid-gallery.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/userdashboard.css" />
</head>
<body id="bd1">
    <div class="header">
        <div class="row">
            <div class="col-sm-3">
            <h1 id="hed1">Client Dashboard</h1> 
            </div>            
        </div>   
        
            
    </div>
    <div class="body">
        <div class="row">
            <div class="col-sm-3">
                <div class="sidebar">
                    <img id="imglogo" src="assets/img/finelogo.png" alt="">
                    <form action="#" method="post">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="#account" id="btnaccount">Account</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#pendingpay" id="btnpendingfine">Pending Fines</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#elicense" id="btnelicense">E-License</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#notifications" id="btnnotifications">Notifications</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#help" id="btnhelp">Help</a>
                            </li>
                        </ul>
                        
                        <input type="submit" name="btnlogout" id="btnlogout" value="LOGOUT">
                    </form>
                    
                </div>
            </div>
            <div class="col-sm-9">
                <div class="content">
                    <!---------|Account Section From Here|----------->
                     <section class="account" id="account">
                          <div class="accountsec">
                             <h1 id="hedacc1">Account Details</h1>
                             <?php                             
                             // Create Connection
                            $con = mysqli_connect("localhost:3308", "root", "");
                            mysqli_select_db($con, "trafficfinesystemdb");

                            // Insert Data into client Table
                            $sql = "SELECT 	cName,licenseNO,NIC,cPhone,cAddress,cEmail FROM client WHERE userID ='$_username'"; 
                            $ret = mysqli_query($con,$sql);                         
                                                       
                            
                            // Print result
                            echo "<br><br>";
                            echo "<table border=1 width=1200px>";
                            echo "<tr bgcolor=blue>";
                            echo "<th>Name</th>";
                            echo "<th>DRL NO</th>";
                            echo "<th>NIC</th>";
                            echo "<th>Phone NO</th>";
                            echo "<th>Address</th>";
                            echo "<th>E-mail</th>";
                            echo "</tr>";

                            while ($row = mysqli_fetch_array($ret)) {
                                echo "<tr bgcolor=#fff>";
                                echo "<td>{$row['cName']}</td>";
                                echo "<td>{$row['licenseNO']}</td>";
                                echo "<td>{$row['NIC']}</td>";
                                echo "<td>{$row['cPhone']}</td>";
                                echo "<td>{$row['cAddress']}</td>";
                                echo "<td>{$row['cEmail']}</td>";
                                echo "</tr>";
                            }

                             echo "</table>"; 
                             echo "<br><br><hr>";                   
                                                                     
        
                            mysqli_close($con);
                             ?>
                           <form action="#" method="post">
                            <h3>Update Password</h3><br>
                            Current Password : <input type="password" name="txtpassword" id="txtpassword" placeholder="Enter Current Password Here" required><br><br>
                            New Password : <input type="password" name="txtnewpassword" id="txtnewpassword" placeholder="Enter New Password Here" required><br><br>
                            Confirm Password : <input type="password" name="txtconfpassword" id="txtconfpassword" placeholder="Confirm Password" required><br><br>
                            <input type="submit" value="Change Password" name="btnchangepw" id="btnchangepw"><br><br><hr>                            
                           </form>
                           <form action="#" method="post">
                            <h3>Delete Account</h3>
                                Send Delete Request : <input type="submit" value="Delete Request" name="btndelreq" id="btndelreq">
                           </form>
                           <?php
                           if(isset($_POST['btnchangepw']))
                           {
                                $currentpw = $_POST["txtpassword"];
                                $newpw = $_POST["txtnewpassword"];
                                $confpw = $_POST["txtconfpassword"];

                                if($newpw == $confpw)
                                {
                                    //Create Connection
                                    $con = mysqli_connect("localhost:3308","root","");
                                    mysqli_select_db($con,"trafficfinesystemdb");

                                    //Insert Data to user Table                                    
                                    $sql = "UPDATE user SET userPW = '$newpw' WHERE userID = '$_username'";
                                    $ret =mysqli_query($con,$sql); 
                                    echo "<script type='text/javascript'> alert('Password Updated!')</script>";       
                                    
                                    mysqli_close($con);
                                }

                           }
                           ?>
                           <?php
                            if (isset($_POST['btndelreq'])) {
                                // Create Connection
                                $con = mysqli_connect("localhost:3308", "root", "", "trafficfinesystemdb");

                                if (!$con) {
                                    die("Connection failed: " . mysqli_connect_error());
                                }

                                // Assuming $_username is a valid user input, you should validate and sanitize it.
                                $username = mysqli_real_escape_string($con, $_username);

                                // Select Data from client Table
                                $sql = "SELECT licenseNO FROM client WHERE userID ='$username'";
                                $ret = mysqli_query($con, $sql);

                                if ($ret) {
                                    if (mysqli_num_rows($ret) > 0) {
                                        $row = mysqli_fetch_assoc($ret);
                                        $licenseNO = $row['licenseNO'];

                                        // Retrieve data from the paymentdetails table
                                        $sql = "SELECT fineStatus FROM paymentdetails WHERE licenseNO ='$licenseNO'";
                                        $result = mysqli_query($con, $sql);

                                        $hasPendingPayments = false;

                                        while ($paymentRow = mysqli_fetch_assoc($result)) {
                                            if ($paymentRow['fineStatus'] === 'Paid') {
                                                $hasPendingPayments = true;
                                                break;
                                            }
                                        }

                                        if (!$hasPendingPayments) {
                                            // Delete the account
                                            $deleteSql = "DELETE FROM client WHERE licenseNO = '$licenseNO'";
                                            $deleteResult = mysqli_query($con, $deleteSql);

                                            $deleteSql2 = "DELETE FROM user WHERE userID = '$username'";
                                            $deleteResult2 = mysqli_query($con, $deleteSql2);

                                            if ($deleteResult && $deleteResult2) {
                                                echo '<script>alert("Account deleted successfully.");</script>';
                                                 //add page to Session
                                                session_start();
                                                //Distroy the session
                                                session_destroy();

                                                //Redirect to login.php
                                                header("Location:index.html");
                                            } else {
                                                echo '<script>alert("Failed to delete the account.");</script>';
                                            }
                                        } else {
                                            echo '<script>alert("Cannot Delete Account. You Have Pending Payments.");</script>';
                                        }
                                    } else {
                                        echo '<script>alert("User not found.");</script>';
                                    }
                                } else {
                                    echo "Error: " . mysqli_error($con);
                                }

                                mysqli_close($con);
                            }
                            ?>


                          </div>
                     </section>
                     
                     <!---------|Pending Fines|----------->
                        <section class="pendingpay" id="pendingpay">
                            <div class="pendingpaysec">
                                <h1 id="hedpendigpay">Pending Fines</h1><br><br>

                                <?php
                                // Create Connection
                                $con = mysqli_connect("localhost:3308", "root", "");
                                mysqli_select_db($con, "trafficfinesystemdb");

                                // Select Data from client Table
                                $sql = "SELECT licenseNO FROM client WHERE userID ='$_username'";
                                $ret = mysqli_query($con, $sql);
                                if ($row = mysqli_fetch_array($ret)) {
                                    $licenseNO = $row['licenseNO'];

                                    // Retrieve data from the paymentdetails table
                                    $sql = "SELECT offience, fineDate, fineTime, fineAmount FROM paymentdetails WHERE licenseNO ='$licenseNO'";
                                    $result = mysqli_query($con, $sql);

                                    // Check if a record was found
                                    if ($row = mysqli_fetch_array($result)) {
                                        $offName = $row['offience'];
                                        $fineDate = $row['fineDate'];
                                        $fineTime = $row['fineTime'];
                                        $fineAmount = $row['fineAmount'];
                                    } else {
                                        echo "<h5 id='hed5noti'>No Pending Fines found for You!</h5>";
                                    }
                                } else {
                                    echo "No data found for the user.";
                                }

                                mysqli_close($con);
                                ?>
                                <form action="#" method="POST" id="frmpay">
                                    <label for="offience">Offence Name :</label><br>
                                    <input type="text" name="offience" id="offience" placeholder="Empty" value="<?php echo isset($offName) ? $offName : ''; ?>" readonly><br><br>

                                    <label for="fineDate">Fine Date :</label><br>
                                    <input type="text" name="fineDate" id="fineDate" placeholder="Empty" value="<?php echo isset($fineDate) ? $fineDate : ''; ?>" readonly><br><br>

                                    <label for="fineTime">Fine Time :</label><br>
                                    <input type="text" name="fineTime" id="fineTime" placeholder="Empty" value="<?php echo isset($fineTime) ? $fineTime : ''; ?>" readonly><br><br>

                                    <label for="fineAmount">Fine Amount:</label><br>
                                    <input type="text" name="fineAmount" id="fineAmount" placeholder="Empty" value="<?php echo isset($fineAmount) ? $fineAmount : ''; ?>" readonly><br><br>

                                    <input type="button" value="Pay Now" name="btnpaynow" id="btnpaynow">
                                </form>
                                <script>
                                    document.getElementById("btnpaynow").addEventListener("click", function() {
                                        // Redirect to payment.php
                                        window.location.href = "payment.php";
                                    });
                                </script>
                                
                        </section>
                     <!---------|E - License|----------->
                     <section class="elicense" id="elicense">
                        <div class="elicensesec">
                            <h1 id="hedpendigpay">E-License</h1><br><br>
                            <?php
                            // Create Connection
                            $con = mysqli_connect("localhost:3308", "root", "");
                            mysqli_select_db($con, "trafficfinesystemdb");                           

                            $sql = "SELECT licenseImage FROM client WHERE userID = '$_username'";
                            $result = mysqli_query($con, $sql);
                            

                            if ($result && mysqli_num_rows($result) > 0) {
                                $row = mysqli_fetch_assoc($result);

                                // Retrieve the image name from the database
                                $imageFileName = $row['licenseImage'];

                                // Construct the full path to the image file
                                $imagePath = "image/" . $imageFileName;                                

                                // Check if the file exists on the server
                                if (file_exists($imagePath)) {
                                    // Display the image
                                    echo "<img src='$imagePath' alt='User Image' style='max-width: 600px;margin-left: 300px;'>";
                                } else {
                                    echo "Image file not found on the server. Check the file path.";
                                }
                            } else {
                                echo "Image not found for this user.";
                            }

                            mysqli_close($con);
                            ?>
                            <?php
                            // Create Connection
                            $con = mysqli_connect("localhost:3308", "root", "");
                            mysqli_select_db($con, "trafficfinesystemdb"); 

                            $sql = "SELECT licenseNO FROM client WHERE userID='$_username'";
                            $ret = mysqli_query($con, $sql);

                            if ($row = mysqli_fetch_array($ret)) {
                                $licenseNO = $row['licenseNO'];

                                // Retrieve data from the paymentdetails table
                                $sql = "SELECT fineStatus FROM paymentdetails WHERE licenseNO ='$licenseNO'";
                                $result = mysqli_query($con, $sql);

                                if($row = mysqli_fetch_array($result)) {
                                    $fineStatus = $row['fineStatus'];

                                    // Check the value of $fineStatus and print the appropriate message in the desired color
                                    if ($fineStatus == "Pending") {
                                        echo '<p style="color: red;font-weight:bold; font-size:24px;">License Status  : Temporary Banned</p>';
                                    } elseif ($fineStatus == "Paid") {
                                        echo '<p style="color: green;font-weight:bold; font-size:24px;">License Status  : Active</p>';
                                    }
                                } else {
                                    // No records found for $licenseNO, assuming Active status
                                    echo '<p style="color: green; font-weight:bold; font-size:24px;">License Status  : Active</p>';
                                }
                            } else {
                                // No records found for $_username
                                echo 'No records found for the user.';
                            }

                            mysqli_close($con);
                            ?>

                        </div>
                    </section>

                         <!---------|Notifications Section|----------->
                    <section class="notifications" id="notifications">
                        <div class="notificationsec">
                            <h1 id="hednotification">Notifications</h1><br><br>
                            <h3>Payment Time Line</h3><br>
                            <?php
                            // Create Connection
                            $con = mysqli_connect("localhost:3308", "root", "");
                            mysqli_select_db($con, "trafficfinesystemdb");

                            // Select Data from client Table
                            $sql = "SELECT licenseNO FROM client WHERE userID ='$_username'";
                            $ret = mysqli_query($con, $sql);
                            if ($row = mysqli_fetch_array($ret)) {
                                $licenseNO = $row['licenseNO'];

                                // Retrieve data from the paymentdetails table
                                $sql = "SELECT offience, fineDate, fineTime, fineAmount FROM paymentdetails WHERE licenseNO ='$licenseNO' AND fineStatus='Pending'";
                                $result = mysqli_query($con, $sql);

                                // Check if a record was found
                                if ($row = mysqli_fetch_array($result)) {
                                    $offName = $row['offience'];
                                    $fineDate = $row['fineDate'];
                                    $fineTime = $row['fineTime'];
                                    $fineAmount = $row['fineAmount'];
                                  
                                } else {
                                    echo "<h5 style=color:#48A65D;padding-left:430px;font-weight:bold;>No Pending Fines found for You!</h5>";
                                }
                            } else {
                                echo "No data found for the user.";
                            }

                            mysqli_close($con);
                            ?>
                            <div class="Payment-time">
                                <div>
                                    <p id="days">00</p>
                                    <span>Days</span>
                                </div>
                                <div>
                                    <p id="hours">00</p>
                                    <span>Hours</span>
                                </div>
                                <div>
                                    <p id="mins">00</p>
                                    <span>Minutes</span>
                                </div>
                                <div>
                                    <p id="sec">00</p>
                                    <span>Seconds</span>
                                </div>
                            </div>
                        </div>
                        <script>
                            // Get the fineDate and fineTime values
                            var fineDate = "<?php echo $fineDate; ?>";
                            var fineTime = "<?php echo $fineTime; ?>";

                            // Create a JavaScript Date object for fineDate and fineTime
                            var fineDateTime = new Date(fineDate + ' ' + fineTime);

                            // Calculate the target date (14 days from the fineDate and fineTime)
                            var targetDate = new Date(fineDateTime.getTime() + (14 * 24 * 60 * 60 * 1000));

                            var x = setInterval(function () {
                                var now = new Date().getTime();
                                var distance = targetDate - now;

                                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                var mins = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                var sec = Math.floor((distance % (1000 * 60)) / 1000);

                                document.getElementById("days").innerHTML = days;
                                document.getElementById("hours").innerHTML = hours;
                                document.getElementById("mins").innerHTML = mins;
                                document.getElementById("sec").innerHTML = sec;

                                // Check if the countdown has expired
                                if (distance < 0) {
                                    clearInterval(x);
                                    // Display a message when the countdown expires
                                    document.getElementById("days").innerHTML = "Expired";
                                    document.getElementById("hours").innerHTML = "Expired";
                                    document.getElementById("mins").innerHTML = "Expired";
                                    document.getElementById("sec").innerHTML = "Expired";
                                }
                            }, 1000);
                        </script>

                        <form action="#" method="POST">
                            <br><br><label for="loffience" id="loffience">Offence Name  :  </label>
                            <input type="text" name="toffience" id="toffience" placeholder="Empty" value="<?php echo isset($offName) ? $offName : ''; ?>" readonly><br><br>                                           

                            <input type="submit" value="More Information >>" name="btninfo" id="btninfo" action="pendingpay">
                        </form>

                    </section>


                        <!---------|Help|----------->

                        <section class="help" id="help">
                            <div class="helpsec">
                                <h1 id="hedhelp">Help</h1><br><br>
                                <div class="helpform">                                
                                    <form action="#" method="post" id="helpfrm">
                                        <label for="lblname" id="lblname">Full Name :</label><br><br>
                                        <input type="text" name="txtname" id="txtname" placeholder="Enter Full Name Here" required><br<br>
                                        <label for="lblemail" id="lblemail">E - Mail :</label><br><br>
                                        <input type="email" name="txtemail" id="txtemail" placeholder="Enter E-Mail Here"  required><br><br>
                                        <label for="lblmsg" id="lblmsg">Message :</label><br><br>
                                        <textarea name="txtmsg" id="txtmsg" cols="20" rows="5" placeholder="Message" required></textarea><br><br>
                                        <button type="submit" id="btnsend" name="btnsend">Send</button>
                                        
                                    </form>
                                </div>
                                <div class="image">
                                     <img src="assets/gif/sentgif.gif" id="gifsent" alt="">
                                </div>
                                <?php

                               // use PHPMailer\PHPMailer\PHPMailer;
                               // use PHPMailer\PHPMailer\SMTP;
                               // use PHPMailer\PHPMailer\Exception;

                                //Load Composer's autoloader
                               // require 'vendor/autoload.php';
    
                              
                             //var_dump($_POST);
                              //  $mail = new PHPMailer(true);

                            if (isset($_POST["btnsend"]))
                            {
                                $name = $_POST["txtname"];
                                $Email = $_POST["txtemail"];
                                $Msg=$_POST["txtmsg"];                                 

                                    //EMAIL
                                    //
                                    //email from admin to user when register vehicle
                                        try 
                                        {
                                        //Server settings
                                        //$mail->SMTPDebug = 1;                //Enable verbose debug output
                                        $mail->isSMTP();                       //Send using SMTP
                                        $mail->Host       = 'smtp.gmail.com';  //Set the SMTP server to send through
                                        $mail->SMTPAuth   = true;              //Enable SMTP authentication
                                        $mail->Username   = 'hasinduvindana@gmail.com';  //SMTP username
                                        $mail->Password   = 'qluaxvqvispkaghx';       //SMTP password
                                        $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
                                        $mail->Port       = 587;              //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
                                        //Recipients
                                        $mail->setFrom($Email , 'Traffic Fine');
                                        //Add a recipient
                                        $mail->addAddress('hasinduvindana@gmail.com');    
                                        //$mail->addAddress('ellen@example.com');               //Name is optional
                                        //$mail->addReplyTo('info@example.com', 'Information');
                                    // $mail->addCC('cc@example.com');
                                        $mail->addBCC('infopayotf@gmail.com');
                                        //Attachments
                                        //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
                                    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg'); 
                                        //Optional name
                                        //Content
                                        $mail->isHTML(true);       
                                        
                                        //$verification_code=substr(number_format(time()*rand(),0,'',''), 0,6);                          
                                        //Set email format to HTML
                                        $mail->Subject = 'Help';
                                        $mail->Body    = '<div style="width: 700px ; background-color:lightskyblue; font-weight: bold;text-align: center;font-family: Arial;font-size: 30pt;">Need Help</div>
                                        <div style="width: 700px; height:1500px; background-color:white;font-family: Arial;">
                                        <p><br>Dear userAdmin,<br>From : '.$name.'</p><br><p>E-Mail : '.$Email.'</p><br>
                                        <p>Message : '.$Msg.'</p><br>
                                            <p>Thank You!<br>Sincerely yours,<br>Client</p>
                                            </div>';
                                        
                                    
                                        $mail->send();
                                        echo 'Message has been sent';

                                        } 
                                        catch (Exception $e)
                                        {
                                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                                        }
                                        //end
                                    }
                                 
                                    
                                ?>
                                
                            </div>
                        </section>


                </div>
            </div>
        </div>
    </div>    
   
</body>
</html>


