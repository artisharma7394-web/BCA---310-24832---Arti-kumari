<?php
include("config.php");

// 🔥 GET DATA FROM CHECKOUT
$name = $_POST['name'];
$city = $_POST['city'];
$address = $_POST['address'];
$mobile = $_POST['mobile'];
$pincode = $_POST['pincode'];
$payment = $_POST['payment'];
$amount = $_POST['amount'];   // ✅ IMPORTANT FIX

// 🔥 SERVER SIDE VALIDATION
if(!preg_match("/^[A-Za-z ]+$/", $name)){
    die("❌ Invalid Name");
}

if(!preg_match("/^[A-Za-z ]+$/", $city)){
    die("❌ Invalid City");
}

if(!preg_match("/^[0-9]{10}$/", $mobile)){
    die("❌ Invalid Mobile Number");
}

if(!preg_match("/^[0-9]{6}$/", $pincode)){
    die("❌ Invalid Pincode");
}

// 🔥 INSERT INTO DATABASE (FIXED)
$sql = "INSERT INTO orders 
(customer_name, product_name, amount, payment_method)
VALUES 
('$name', 'Cart Order', '$amount', '$payment')";

$result = mysqli_query($conn, $sql);

if(!$result){
    die("❌ Order Failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Order Success</title>

<style>
body{
    font-family:Arial;
    background:#f5f5f5;
    text-align:center;
    padding-top:100px;
}

.box{
    background:white;
    width:400px;
    margin:auto;
    padding:30px;
    border-radius:15px;
    box-shadow:0 4px 12px rgba(0,0,0,0.1);
}

h1{
    color:green;
}
</style>
</head>

<body>

<div class="box">

<h1>🎉 Order Placed Successfully</h1>

<p><b>Name:</b> <?php echo $name; ?></p>
<p><b>City:</b> <?php echo $city; ?></p>
<p><b>Amount:</b> ₹<?php echo $amount; ?></p>
<p><b>Payment:</b> COD</p>

<br>

<a href="products.php">Continue Shopping</a>

</div>

</body>
</html>