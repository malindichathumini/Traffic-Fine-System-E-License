<?php 
	//OfficerDashboard.php to session 
	session_start();
	$_username = $_SESSION['userid'];  
// Create Connection
$con = mysqli_connect("localhost:3308", "root", "");
mysqli_select_db($con, "trafficfinesystemdb");

// Select Data from client Table
$sql = "SELECT licenseNO,cName FROM client WHERE userID ='$_username'";
$ret = mysqli_query($con, $sql);
if ($row = mysqli_fetch_array($ret)) {
    $licenseNO = $row['licenseNO'];
    $cNme = $row['cName'];

    // Retrieve data from the paymentdetails table
    $sql = "SELECT offience,fineAmount FROM paymentdetails WHERE licenseNO ='$licenseNO' AND fineStatus = 'Pending'";
    $result = mysqli_query($con, $sql);

    // Check if a record was found
    if ($row = mysqli_fetch_array($result)) {
        $offName = $row['offience'];        
        $fineAmount = $row['fineAmount'];
    }
} 

mysqli_close($con);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payments</title>
    <script src="assets/js/jpayhere.js"></script>
    <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/css/payment.css" />
</head>
<body id="bg1">
    <div class="head">

    </div>
    <div class="body">
    <form action="#" method="post" id="frmpaymentslip">
        <h3>Payment Details</h3><br><br>
        <label for="name">Name : </label>
        <input type="text" name="txtcname" id="txtcname" value="<?php echo isset($cNme) ? $cNme : ''; ?>"><br><br>
        <label for="drlno">DRL NO : </label>
        <input type="text" name="txtdrl" id="txtdrl" value="<?php echo isset($licenseNO) ? $licenseNO : ''; ?>"><br><br>
        <label for="offence">Offence : </label>
        <input type="text" name="txtoffence" id="txtoffence" value="<?php echo isset($offName) ? $offName : ''; ?>"><br><br>
        <label for="fineamount">Fine Amount (LKR.) : </label>
        <input type="text" name="txtfineamount" id="txtfineamount" value="<?php echo isset($fineAmount) ? $fineAmount : ''; ?>"><br><br><hr>
        <h5>Payment Methods</h5><br><br>
       <img src="assets/img/imgpayhere.png" id="imgpayhere" alt=""> <input type="submit" value="PayHere" name="btnpayhere" id="btnpayhere">
        
    </form>
    </div>

</body>
</html>
<?php
if(isset($_POST['btnpayhere'])){
    //Accept Data
    $cname = $_POST["txtcname"];
    $drlno = $_POST["txtdrl"];
    $offence = $_POST["txtoffence"];
    $amount = $_POST["txtfineamount"];
    $merchant_id = "1224363";
    $merchant_secret = "NzY1MzAzNDE1MjcxODQxNTM3MzM2Nzg1NTkwODgyMzc2MjMxOTc4";
    $currency = "LKR";
    $order_id = uniqid();
    $hash = strtoupper(
        md5(
            $merchant_id . 
            $order_id . 
            number_format($amount, 2, '.', '') . 
            $currency .  
            strtoupper(md5($merchant_secret)) 
        ) 
    );
    $array = [];

    $array["fineamount"] = $amount;
    $array["merchant_id"] = $merchant_id;
    $array["order_id"] = $order_id;
    $array["currency"] = $currency;
    $array["hash"] = $hash;
    $array["cname"] = $cname;
    $array["drlno"] = $drlno;
    $array["offence"] = $offence;
    

    $jsonObj = json_encode($array);
    echo $jsonObj;
}

?>



