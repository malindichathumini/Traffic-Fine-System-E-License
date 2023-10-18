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
    <title>Department- Dashboard</title>
    <link rel="shortcut icon" href="assets/img/Logo.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Merriweather&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="assets/images/fav.jpg">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/fontawsom-all.min.css">
    <link rel="stylesheet" href="assets/plugins/grid-gallery/css/grid-gallery.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/departmentdashboard.css" />

</head>
<body class="b1">
    <div class="main">
        <div class="navbar">
            <div class="icon">
                <img src="assets/img/finelogo.png" class="logo">  
            </div>
            <div class="hedtext">
                <h1 class="hed1">Department Dashboard</h1>
                
            </div>

            <div class="menu">
                <ul>
                    <li><a href="#logins">Pending Logins</a></li>
                    <li><a href="#Addfine">Update Fiens</a></li> 
                    <li><a href="#payments">Payments</a></li>
                    <li><a href="#"></a></li>
                    
                </ul>
            </div>
            <div class="logout">
                <form action="#" method="post" name="frmlogout">
                    <input type="submit" name="btnlogout" id="btnlogout" value="logout">
                </form>
                
            </div>
            
        </div><br><br><br>
        <!-- ################# Pending Logins Section Starts Here #######################--->
        <section id="logins" class="logins">
            
            <div class="headingUser">
                <h1 class="heduser1">Pending Logins</h1><br><br>
            </div>
                           
                <div class="usertable">

                <?php
                    // Create Connection to MySQL Server
                    $con = mysqli_connect("localhost:3308", "root", "");

                    // Select DB
                    mysqli_select_db($con, "trafficfinesystemdb");

                    // Perform SQL
                    $sql = "SELECT * FROM user";
                    $result = mysqli_query($con, $sql);

                    // Print result
                    echo "<table border=1 width=700px>";
                    echo "<tr bgcolor=blue>";
                    echo "<th>userID</th>";
                    echo "<th>userPW</th>";
                    echo "<th>userType</th>";
                    echo "<th>userAccStatus</th>";
                    echo "</tr>";

                    while ($row = mysqli_fetch_array($result)) {
                        echo "<tr bgcolor=#fff>";
                        echo "<td>{$row['userID']}</td>";
                        echo "<td>{$row['userPW']}</td>";
                        echo "<td>{$row['userType']}</td>";
                        echo "<td>{$row['userAccStatus']}</td>";
                        echo "</tr>";
                    }

                    echo "</table>";

                    // Disconnect from server
                    mysqli_close($con);
                ?>
                <img src="assets/gif/approve.gif" alt="Approve icon" id="approveIcon">
                <form action="#" method="post">
                    <br><br><h3 id="lbluername">Enter Username  :</h3> <input type="text" name="txtusername" id="txtusername" placeholder="Enter Username Here"><br><br>
                    <input type="submit" value="Approve" name="btnApprove" id="btnApprove">
                </form>
                <?php
                if(isset($_POST['btnApprove']))
                {
                    $act = "Approved";
                    $un = $_POST["txtusername"];

                   // Create Connection to MySQL Server
                   $con = mysqli_connect("localhost:3308", "root", "");

                   // Select DB
                   mysqli_select_db($con, "trafficfinesystemdb");

                   // Perform SQL
                   $sql = "UPDATE user SET userAccStatus='$act' WHERE userID = '$un'";
                   $result = mysqli_query($con, $sql); 

                   mysqli_close($con);
                }
                ?>

                
                </div>
                
            
        </section>

        <!-- ################# Add New Fine  #######################--->

        <section class="Addfine" id="Addfine">
            <br><br>

            <div class="headingFine">
                <h1 class="hedFine1" id="hedFine1">Add New Fine</h1><br><br>
            </div>
                           
                <div class="finetable">

                <?php
                    // Create Connection to MySQL Server
                    $con = mysqli_connect("localhost:3308", "root", "");

                    // Select DB
                    mysqli_select_db($con, "trafficfinesystemdb");

                    // Perform SQL
                    $sql = "SELECT * FROM fines";
                    $result = mysqli_query($con, $sql);

                    // Print result
                    echo "<table border=1 width=500px>";
                    echo "<tr bgcolor=blue>";
                    echo "<th>offienceName</th>";
                    echo "<th>fineAmount(Rs.)</th>";                    
                    echo "</tr>";

                    while ($row = mysqli_fetch_array($result)) {
                        echo "<tr bgcolor=#fff>";
                        echo "<td>{$row['offienceName']}</td>";
                        echo "<td>{$row['fineAmount']}</td>";                        
                        echo "</tr>";
                    }

                    echo "</table>";

                    // Disconnect from server
                    mysqli_close($con);
                ?>
                <form action="#" method="post">
                    <br><br><br><br>
                    <img src="assets/gif/updatefine.gif" alt="Update icon" id="updateIcon">
                    <h3 id="lblfineName">Fine Name : </h3><input type="text" name="txtfinename" id="txtfinename" placeholder="Enter Fine Name Here"><br><br>
                    <h3 id="lblfineAmount">Fine Amount(Rs.)  : </h3><input type="text" name="txtfineAmount" id="txtfineAmount" placeholder="Enter Fine Amount Here"><br><br>
                    <input type="submit" value="Add Fine" name="btnAddfine" id="btnAddfine">
                    <input type="submit" value="Update" name="btnUpdatefine" id="btnUpdatefine">
                </form>
                <?php
                if(isset($_POST['btnUpdatefine']))
                {
                    
                    $fn = $_POST["txtfinename"];
                    $fa = $_POST["txtfineAmount"];

                   // Create Connection to MySQL Server
                   $con = mysqli_connect("localhost:3308", "root", "");

                   // Select DB
                   mysqli_select_db($con, "trafficfinesystemdb");

                   // Perform SQL
                   $sql = "UPDATE fines SET fineAmount='$fa' WHERE offienceName = '$fn'";
                   $result = mysqli_query($con, $sql); 

                   mysqli_close($con);
                }
                ?>

                <?php
                if(isset($_POST['btnAddfine']))
                {
                    
                    $fn = $_POST["txtfinename"];
                    $fa = $_POST["txtfineAmount"];

                   // Create Connection to MySQL Server
                   $con = mysqli_connect("localhost:3308", "root", "");

                   // Select DB
                   mysqli_select_db($con, "trafficfinesystemdb");

                   // Perform SQL
                   $sql = "INSERT INTO fines (fineAmount,offienceName) VALUES ('$fa','$fn')";
                   $result = mysqli_query($con, $sql); 

                   mysqli_close($con);
                }
                ?>


                
                </div>
                
        </section>
      <!-- ################# Notifications  #######################-->

        <section class="payments" id="payments">
            <br><br>
            <?php
            // Create Connection to MySQL Server
            $con = mysqli_connect("localhost:3308", "root", "");

            // Select DB
            mysqli_select_db($con, "trafficfinesystemdb");

            // Check if the "clkview" button was clicked
            if (isset($_POST['clkview'])) {
                // Perform SQL to fetch pending payments
                $sql = "SELECT * FROM paymentdetails WHERE fineStatus = 'Pending'";
                $result = mysqli_query($con, $sql);
            }

            mysqli_close($con);
            ?>

            <div class="headingPayments">
                <h1 class="hedPayments1" id="hedPayments1">Notifications</h1><br><br>
            </div>
            <div class="payBody">
                <h3>Pending Payments</h3><br>
                <form action="#" method="post">
                    <label for="lblpendingpay">View Pending Payments : </label>
                    <button id="clkview" name="clkview">Click to View</button><br><br>
                </form>
            </div>

            <?php
            // Display the payment details in a table
            if (isset($result)) {
                echo '<table class="styled-table">';
                echo '<tr>
                <th class="table-heading">Fine ID</th>
                <th class="table-heading">Fine Date</th>
                <th class="table-heading">Fine Time</th>
                <th class="table-heading">Offense</th>
                <th class="table-heading">Fine Amount</th>
                <th class="table-heading">Fine Status</th>
                <th class="table-heading">License Number</th>
                <th class="table-heading">Police Officer ID</th>
                </tr>';

                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    echo '<td id="td">' . $row['fineID'] . '</td>';
                    echo '<td id="td">' . $row['fineDate'] . '</td>';
                    echo '<td id="td">' . $row['fineTime'] . '</td>';
                    echo '<td id="td">' . $row['offience'] . '</td>';
                    echo '<td id="td">' . $row['fineAmount'] . '</td>';
                    echo '<td id="td">' . $row['fineStatus'] . '</td>';
                    echo '<td id="td">' . $row['licenseNO'] . '</td>';
                    echo '<td id="td">' . $row['policeOfficerID'] . '</td>';
                    echo '</tr>';
                }

                echo '</table>';
            }
            ?>
           
          
           <?php
           //Display Paid and Pending Presentage
                $con = mysqli_connect("localhost:3308", "root", "");
                mysqli_select_db($con, "trafficfinesystemdb");

                $sql = "SELECT COUNT(*) as count FROM paymentdetails WHERE fineStatus = 'Pending'";
                $result = mysqli_query($con, $sql);
                $row = mysqli_fetch_assoc($result);
                $pendingCount = $row['count'];

                $sql = "SELECT COUNT(*) as count FROM paymentdetails WHERE fineStatus = 'Paid'";
                $result = mysqli_query($con, $sql);
                $row = mysqli_fetch_assoc($result);
                $paidCount = $row['count'];

                mysqli_close($con);

                $totalCount = $pendingCount + $paidCount;

                if ($totalCount > 0) {
                    $pendingPercentage = ($pendingCount / $totalCount) * 100;
                    $paidPercentage = ($paidCount / $totalCount) * 100;
                } else {
                    $pendingPercentage = 0;
                    $paidPercentage = 0;
                }

                echo "Pending Percentage: " . number_format($pendingPercentage, 2) . "%<br>";
                echo "Paid Percentage: " . number_format($paidPercentage, 2) . "%";
            ?>
            <br><hr><br><h3>Feedbacks</h3><br>
            <?php
                $con = mysqli_connect("localhost:3308", "root", "");
                mysqli_select_db($con, "trafficfinesystemdb");

                $sql = "SELECT feedbackID, feedbackDate, fDescription, licenseNO FROM clientfeedback";
                $result = mysqli_query($con, $sql);
            ?>

                <table border="1" width="500px" id="t2">
                    <tr>
                        <th id="th">Feedback ID</th>
                        <th id="th">Feedback Date</th>
                        <th id="th">Description</th>
                        <th id="th">License Number</th>
                    </tr>

            <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['feedbackID'] . "</td>";
                        echo "<td>" . $row['feedbackDate'] . "</td>";
                        echo "<td>" . $row['fDescription'] . "</td>";
                        echo "<td>" . $row['licenseNO'] . "</td>";
                        echo "</tr>";
                    }
            ?>

                </table>

            <?php
                mysqli_close($con);
            ?>

                    
        </section>

    
</body>
</html>