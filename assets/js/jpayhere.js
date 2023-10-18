function paymentGateWay(){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = () =>{
        if(xhttp.readyState == 4 && xhttp.status == 200){
            alert(xhttp.responseText);
            var payobj = JSON.parse(xhttp.responseText);

             // Payment completed. It can be a successful failure.
                payhere.onCompleted = function onCompleted(orderId) {
                    console.log("Payment completed. OrderID:" + orderId);
                    // Note: validate the payment and show success or failure page to the customer
                };

                // Payment window closed
                payhere.onDismissed = function onDismissed() {
                    // Note: Prompt user to pay again or show an error page
                    console.log("Payment dismissed");
                };

                // Error occurred
                payhere.onError = function onError(error) {
                    // Note: show an error page
                    console.log("Error:"  + error);
                };

                // Put the payment variables here
                var payment = {
                    "sandbox": true,
                    "merchant_id": "1224363",    // Replace your Merchant ID
                    "return_url": "http://localhost/payhere_config/",     // Important
                    "cancel_url": "http://localhost/payhere_config/",     // Important
                    "notify_url": "http://sample.com/notify",
                    "order_id": payobj["order_id"],
                    "items": "Door bell wireles",
                    "amount": payobj["fineamount"],
                    "currency": payobj["currency"],
                    "hash": payobj["hash"], // *Replace with generated hash retrieved from backend
                    "first_name": payobj["cname"],
                    "last_name": "",
                    "email": "",
                    "phone": "",
                    "address": "",
                    "city": "",
                    "country": "Sri Lanka",
                    "delivery_address": "",
                    "delivery_city": "",
                    "delivery_country": "",
                    "custom_1": "",
                    "custom_2": ""
                };
                payhere.startPayment(payment);
        }
    }
    xhttp.open("POST","payment.php",true);
    xhttp.send(); 
}