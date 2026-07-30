<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
<title>Checkout</title>

<style>
body{
    font-family:Arial;
    background:#f5f5f5;
    padding:30px;
}

.checkout-box{
    background:white;
    max-width:500px;
    margin:auto;
    padding:25px;
    border-radius:15px;
    box-shadow:0 4px 12px rgba(0,0,0,0.1);
}

h1{
    text-align:center;
    color:#2e7d32;
}

input, textarea{
    width:100%;
    padding:12px;
    margin-top:10px;
    margin-bottom:20px;
    border:1px solid #ccc;
    border-radius:8px;
}

.btn{
    background:#2e7d32;
    color:white;
    padding:12px;
    border:none;
    width:100%;
    border-radius:8px;
    cursor:pointer;
    font-size:16px;
}

.cod{
    background:#f1f1f1;
    padding:10px;
    border-radius:8px;
    margin-bottom:20px;
}
</style>
</head>

<body>

<div class="checkout-box">

<h1>Checkout</h1>

<!-- FORM START -->
<form action="order_success.php" method="POST" onsubmit="return validateForm()">

<!-- NAME -->
<input type="text" name="name" placeholder="Enter Full Name" required>

<!-- CITY -->
<input type="text" name="city" placeholder="Enter City" required>

<!-- ADDRESS -->
<textarea name="address" placeholder="Enter Full Address" required></textarea>

<!-- MOBILE -->
<input type="text" name="mobile" placeholder="Enter Mobile Number" required>

<!-- PINCODE -->
<input type="text" name="pincode" placeholder="Enter Pincode" required>

<!-- 💰 FIXED FINAL AMOUNT (FROM CART SESSION) -->
<input type="hidden" name="amount" value="<?php echo $_SESSION['final_total']; ?>">

<!-- PAYMENT METHOD -->
<div class="cod">
    <input type="radio" name="payment" value="COD" checked> Cash on Delivery
</div>

<!-- BUTTON -->
<button type="submit" class="btn">Place Order</button>

</form>

</div>

<!-- 🔥 VALIDATION SCRIPT -->
<script>
function validateForm(){

    let name = document.querySelector('input[name="name"]').value.trim();
    let city = document.querySelector('input[name="city"]').value.trim();
    let mobile = document.querySelector('input[name="mobile"]').value.trim();
    let pincode = document.querySelector('input[name="pincode"]').value.trim();

    let nameCheck = /^[A-Za-z ]+$/;
    let cityCheck = /^[A-Za-z ]+$/;
    let mobileCheck = /^[0-9]{10}$/;
    let pinCheck = /^[0-9]{6}$/;

    if(!nameCheck.test(name)){
        alert("❌ Invalid Name");
        return false;
    }

    if(!cityCheck.test(city)){
        alert("❌ Invalid City");
        return false;
    }

    if(!mobileCheck.test(mobile)){
        alert("❌ Invalid Mobile Number");
        return false;
    }

    if(!pinCheck.test(pincode)){
        alert("❌ Invalid Pincode");
        return false;
    }

    return true;
}
</script>

</body>
</html>