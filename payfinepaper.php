<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pay Fine Paper</title>
    <link rel="stylesheet" type="text/css" href="assets/css/payfinepaper.css" />
</head>
<body>
    <div class="hed">
    <div class="content">
            <h1>ADD FINE PAPER</h1>
        </div>
        <div class="icon">
            <img src="assets/img/addfineimg1.jpg">
        </div>
    </div>
    
    <div class="form">
    
        <form action="#" method="post" name="frmaddpaper" class="frmaddpaper">
        <h2 id="hed2">View Fine Paper</h2>      
                
        Offience:<input type="text" id="offience" name="offience"><br><br>
                
        Fine Amount:<input type="text" id="fine_amount" name="fine_amount"><br><br>

        Date: <input type="date" id="date" name="date" required><br><br>
               
        Time:<input type="time" id="time" name="time" required><br><br>
                
        Payment Method: <select name="cmbpaytype" id="cmbpaytype">
                <option value="Card" id="Card">Card</option>
                <option value="Easy Cash" id="Easy Cash">Easy Cash</option>
                </select>       
          
                <input type="reset" class="btnclear" value="Clear" name="btnclear">
                <input type="submit" class="btnsubmit" value="Submit" name="btnsubmit">
        </form>
   
    </div>
    
</body>
</html>
