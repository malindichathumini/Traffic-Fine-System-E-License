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
    <title>Dashboard - Officer</title>
    <link rel="shortcut icon" href="assets/img/Logo.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Merriweather&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="assets/images/fav.jpg">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/fontawsom-all.min.css">
    <link rel="stylesheet" href="assets/plugins/grid-gallery/css/grid-gallery.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/OfficerDashboard.css" />  

</head>
<body id="bd1">
    <div class="header" style="bgColor:#272762">
        <h1 id="hed1">Police Officer Dashboard</h1>
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
                                <a class="nav-link" href="#addfine" id="btnaddfine">Add Fine Paper</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#elicense" id="btnelicense">E-License</a>
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
                <!-------------| Section Account |---------------->

                    <section class="account" id="account">
                       <div class="accountsec">
                             <h1 id="hedacc1">Account Details</h1>
                             <?php                             
                             // Create Connection
                            $con = mysqli_connect("localhost:3308", "root", "");
                            mysqli_select_db($con, "trafficfinesystemdb");

                            // Insert Data into client Table
                            $sql = "SELECT 	officerName,policeOfficerID,officerPhone,officerEmail FROM policeoffiecer WHERE userID ='$_username'"; 
                            $ret = mysqli_query($con,$sql);                         
                                                       
                            
                            // Print result
                            echo "<br><br>";
                            echo "<table border=1 width=1200px>";
                            echo "<tr bgcolor=blue>";
                            echo "<th>Name</th>";
                            echo "<th>Officer ID</th>";                           
                            echo "<th>Phone NO</th>";                            
                            echo "<th>E-mail</th>";
                            echo "</tr>";

                            while ($row = mysqli_fetch_array($ret)) {
                                echo "<tr bgcolor=#fff>";
                                echo "<td>{$row['officerName']}</td>";
                                echo "<td>{$row['policeOfficerID']}</td>";
                                echo "<td>{$row['officerPhone']}</td>";
                                echo "<td>{$row['officerEmail']}</td>";                                
                                echo "</tr>";
                            }

                             echo "</table>"; 
                             echo "<br><br><hr>";                   
                                                                     
        
                            mysqli_close($con);
                             ?>
                             <!--Change Password from here-->
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
                                //Accept Data
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
                                $con = mysqli_connect("localhost:3308", "root", "");
                                mysqli_select_db($con, "trafficfinesystemdb");

                                // Delete Police officer
                                $sql = "DELETE FROM policeoffiecer WHERE userID ='$_username'";
                                $ret = mysqli_query($con, $sql);

                                $deletesql2 = "DELETE FROM user WHERE userID  ='$_username'";
                                $deleteResult = mysqli_query($con, $deleteSql2);
                                echo "<script type='text/javascript'> alert('Account Deleted Successful!')</script>";       
                                    
                                    mysqli_close($con);
                           }
                            ?>
                        </div>
                    </section> 
                    
                     <!-------------| Section Add Fine |---------------->
                    <section class="addfine" id="addfine">
                        <div class="addfinesec">
                            <h1 id="hedaddfine1">Add Fine Paper</h1><br>                            
                            <div class="form">
                                <?php
                                //Submit Button Quary
                                if (isset($_POST['btnsubmit'])) {
                                    // Accept Data Data from form
                                    $fDate = $_POST["date"];
                                    $fTime = $_POST["time"];
                                    $fOffname = $_POST["offience"];
                                    $fineA = $_POST["fine_amount"];
                                    $licenseNo = $_POST["license_number"];
                                    $offid = $_POST["police_officer_id"];

                                    // Create Connection
                                    $con2 = mysqli_connect("localhost:3308", "root", "");
                                    mysqli_select_db($con2, "trafficfinesystemdb");

                                    // Insert Data into paymentdetails Table
                                    $sql2 = "INSERT INTO paymentdetails (fineDate, fineTime, offience, fineAmount, licenseNO, policeOfficerID) 
                                            VALUES ('$fDate', '$fTime', '$fOffname', '$fineA', '$licenseNo', '$offid')";

                                    $ret2 = mysqli_query($con2, $sql2);
                                    

                                    mysqli_close($con2);
                                }
                                ?>

                                <?php
                                // Create Connection
                                $con = mysqli_connect("localhost:3308", "root", "");
                                mysqli_select_db($con, "trafficfinesystemdb");

                                // Select Fines From fine table
                                $sql = "SELECT offienceName, fineAmount FROM fines";
                                $ret = mysqli_query($con, $sql);

                                // Create an array to store offienceName and corresponding fineAmount
                                $offenceData = array();
                                while ($row = mysqli_fetch_array($ret)) {
                                    $offenceData[$row['offienceName']] = $row['fineAmount'];
                                }
                                ?>

                                <form action="#" method="post" name="frmaddpaper" class="frmaddpaper">
                                    <h2 id="hed2">Fine Paper</h2><br>

                                     Date: <input type="date" id="date" name="date" required><br><br>

                                     Time: <input type="time" id="time" name="time" required><br><br>

                                     Offence: <select name="offience" id="offience" onchange="updateFineAmount()">
                                        <?php
                                        // Loop through offences from the fines table and populate the select dropdown
                                        foreach ($offenceData as $offenceName => $fineAmount) {
                                            echo '<option value="' . $offenceName . '">' . $offenceName . '</option>';
                                        }
                                        ?>
                                    </select><br><br>

                                     Fine Amount: <input type="text" id="fine_amount" name="fine_amount" required readonly><br><br>

                                     License Number: <input type="text" id="license_number" name="license_number" required><br><br>

                                     Police Officer ID: <input type="text" id="police_officer_id" name="police_officer_id" required><br><br>
                                            <!--Clear Button-->
                                    <input type="reset" class="btnclear" value="Clear" name="btnclear">
                                    <input type="submit" class="btnsubmit" value="Submit" name="btnsubmit">
                                </form>
                                <div class="icon">
                                <img src="assets/img/addfineimg1.jpg">
                                </div>

                                <script>
                                    // JavaScript function to update the fine amount based on selected offence
                                    function updateFineAmount() {
                                        var offenceSelect = document.getElementById("offience");
                                        var fineAmountInput = document.getElementById("fine_amount");

                                        // Get the selected offence
                                        var selectedOffence = offenceSelect.options[offenceSelect.selectedIndex].value;

                                        // Update the fine amount field with the corresponding value
                                        fineAmountInput.value = <?php echo json_encode($offenceData); ?>[selectedOffence];
                                    }

                                    // Call the function initially to populate the initial fine amount
                                    updateFineAmount();
                                </script>
                            </div>
                        </div>
                    </section>

                    <!-------------| Section E - License |---------------->
                    <section class="elicense" id="elicense">
                            <div class="elicensesec">
                                <h1 id="hedelicense1">E - License</h1><br><br>
                                <form action="#" method="post">
                                    <label for="lbllicenseno">License Number : </label>
                                    <input type="text" name="txtlicenseno" id="txtlicenseno" placeholder="Enter License Number Here"><br><br>
                                    <input type="submit" value="Search" name="btnSearch" id="btnSearch">
                                </form> 
                                <?php
                                 
                            if(isset($_POST["btnSearch"])){
                                //Accept Data
                                $Ln = $_POST["txtlicenseno"];
                                // Create Connection
                                $con = mysqli_connect("localhost:3308", "root", "");
                                mysqli_select_db($con, "trafficfinesystemdb");                           

                                $sql = "SELECT licenseImage FROM client WHERE licenseNO = '$Ln'";
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
                            }                      
                            
                            ?> 
                             <?php
                            if(isset($_POST["btnSearch"])){
                                
                                // Create Connection
                                $con = mysqli_connect("localhost:3308", "root", "");
                                mysqli_select_db($con, "trafficfinesystemdb");
                            

                                    // Retrieve data from the paymentdetails table
                                    $sql = "SELECT fineStatus FROM paymentdetails WHERE licenseNO ='$Ln'";
                                    $result = mysqli_query($con, $sql);

                                    if($row = mysqli_fetch_array($result)) {
                                        $fineStatus = $row['fineStatus'];

                                        // Check the value of $fineStatus and print the appropriate message in the desired color
                                        if ($fineStatus == "Pending") {
                                            echo '<p style="color: red;font-weight:bold; font-size:24px;">License Status  : Temporary Banned</p>';
                                        } elseif ($fineStatus == "Paid" || $fineStatus == "") {
                                            echo '<p style="color: green;font-weight:bold; font-size:24px;">License Status  : Active</p>';
                                        }
                                    } else {
                                        // No records found for $licenseNO, assuming Active status
                                        echo '<p style="color: green;font-weight:bold; font-size:24px;">License Status  : Active</p>';
                                    }
                           

                                mysqli_close($con);
                            }
                            ?>                          
                           
                            </div>    
                    </section>

                    <!---------|Help|----------->
                    <section class="help" id="help">
                            <div class="helpsec">
                                <h1 id="hedhelp">Help</h1><br><br>
                                <div class="helpform">                                
                                    <form onsubmit="sendEmail(); reset(); return false;" id="helpfrm" >
                                        <label for="lblname" id="lblname">Full Name :</label><br><br>
                                        <input type="text" name="txtname" id="txtname" placeholder="Enter Full Name Here"><br><br>
                                        <label for="lblemail" id="lblemail">E - Mail :</label><br><br>
                                        <input type="email" name="txtemail" id="txtemail" placeholder="Enter E-Mail Here"><br><br>
                                        <label for="lblmsg" id="lblmsg">Message :</label><br><br>
                                        <textarea name="txtmsg" id="txtmsg" cols="20" rows="5" placeholder="Message"></textarea><br><br>
                                        <input type="submit" value="Send" name="btnsend" id="btnsend">
                                    </form>
                                </div>
                                <div class="image">
                                     <img src="assets/gif/sentgif.gif" id="gifsent" alt="">
                                </div>
                                <?php
                                    // Import PHPMailer classes into the global namespace - move these outside any functions or control structures.
                                    use PHPMailer\PHPMailer\PHPMailer;
                                    use PHPMailer\PHPMailer\SMTP;
                                    use PHPMailer\PHPMailer\Exception;                                   

                                    // Check if the form is submitted
                                    if (isset($_POST["btnsend"])) {
                                        // Accept Data
                                        $oname = $_POST["txtname"];
                                        $oemail = $_POST["txtemail"];
                                        $msg = $_POST["txtmsg"];

                                        // Create an instance; passing `true` enables exceptions
                                        $mail = new PHPMailer(true);

                                        try {
                                            // Server settings
                                            $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Enable verbose debug output
                                            $mail->isSMTP(); // Send using SMTP
                                            $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
                                            $mail->SMTPAuth = true; // Enable SMTP authentication
                                            $mail->Username = 'hasinduvindana@gmail.com'; // SMTP username
                                            $mail->Password = 'qluaxvqvispkaghx'; // SMTP password
                                            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Enable implicit TLS encryption
                                            $mail->Port = 465; // TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                                            // Recipients
                                            $mail->setFrom($oemail);
                                            $mail->addAddress('joe@example.net', 'Joe User'); // Add a recipient
                                            $mail->addAddress('ellen@example.com'); // Name is optional
                                            $mail->addReplyTo('infopayotf@gmail.com', 'Information');
                                            $mail->addCC('cc@example.com');
                                            $mail->addBCC('studiohv.photography@gmail.com');

                                            // Attachments - You need to specify file paths here.
                                            $mail->addAttachment('path_to_attachment_1'); // Add attachments
                                            $mail->addAttachment('path_to_attachment_2'); // Optional name

                                            // Content
                                            $mail->isHTML(true); // Set email format to HTML
                                            $mail->Subject = 'Help';
                                            $mail->Body = 'Name: ' . $oname . '<br>' . $msg;
                                            $mail->AltBody = '';

                                            $mail->send();
                                            echo "Message Sent Successfully!!!";
                                        } catch (Exception $e) {
                                            echo "Message could not be sent";
                                        }
                                    }
                                ?>

                            </div>
                        </section>

                </div>
            </div>  
        </div>  
    </div>
    <div class="bottom">

    </div>
   
</body>
</html>