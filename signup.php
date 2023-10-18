<?php
if(isset($_POST['btnNext'])){
    //Accept Data
    $cmbType = $_POST["cmbuserType"];

    if($cmbType == "Client")
    {
        header("Location: regclient.php");

    }else if($cmbType == "PoliceOfficer")
    {
        header("Location: regofficer.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration - Step01</title>
    <link rel="stylesheet" type="text/css" href="assets/css/signup.css" />
</head>
<body>
    <div class="hed">
    <div class="content">
            <h1>REGISTRATION PROCESS</h1>
        </div>
        <div class="icon">
            <img src="assets/gif/reg.gif">
        </div>
    </div>

    <div class="form">
    <h2 id="hed2">Step 01</h2>
    <form action="#" method="post">
    <select name="cmbuserType" id="cmbusertype">
            <option value="Client" id="Client">Client</option>
            <option value="PoliceOfficer" id="PoliceOfficer">Police Officer</option>
        </select>
        <input type="submit" value="Next" class="btnNext" name="btnNext">
    </form>      
   
    </div> 
    
</body>
</html>

