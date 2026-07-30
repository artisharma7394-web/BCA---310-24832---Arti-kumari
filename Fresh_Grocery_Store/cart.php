<?php 
session_start();
?>

<!DOCTYPE html>
<html>
<head>
<title>Your Cart</title>

<style>

body{
    font-family:Arial;
    background:#f5f5f5;
    padding:20px;
}

.cart-box{
    background:white;
    padding:20px;
    margin-bottom:20px;
    border-radius:12px;
    box-shadow:0 4px 10px rgba(0,0,0,0.1);
}

img{
    border-radius:10px;
}

.btn{
    background:#2e7d32;
    color:white;
    padding:12px 20px;
    text-decoration:none;
    border-radius:8px;
    border:none;
    cursor:pointer;
}

input{
    padding:10px;
    width:250px;
    border:1px solid #ccc;
    border-radius:8px;
}

h1{
    color:#2e7d32;
}

.coupon-box{
    background:#e8f5e9;
    padding:15px;
    border-radius:10px;
    margin-bottom:20px;
}

</style>

</head>

<body>

<h1>🛒 Your Cart</h1>

<?php

$total = 0;

if(isset($_SESSION['cart'])){

    foreach($_SESSION['cart'] as $id => $item){

        $subtotal = $item['price'] * $item['qty'];

        $total += $subtotal;

?>

<div class="cart-box">

    <img src="<?php echo $item['image']; ?>" width="80">

    <h3><?php echo $item['name']; ?></h3>

    <p>₹<?php echo $item['price']; ?> × <?php echo $item['qty']; ?></p>

    <p>Subtotal: ₹<?php echo $subtotal; ?></p>

    <a href="remove.php?id=<?php echo $id; ?>">Remove</a>

</div>

<?php
    }

}else{
    echo "<h3>Cart Empty</h3>";
}

?>

<hr>

<?php

$discount = 0;
$final_total = $total;

if(isset($_POST['apply_coupon'])){

    $coupon = $_POST['coupon'];

    if($total >= 200){

        if($coupon == "SAVE20"){

            $discount = ($total * 20) / 100;
            $final_total = $total - $discount;

            echo "<h3 style='color:green;'>✅ 20% Discount Applied</h3>";

        }else{

            echo "<h3 style='color:red;'>❌ Invalid Coupon</h3>";
        }

    }else{

        echo "<h3 style='color:red;'>❌ Minimum ₹200 required</h3>";
    }
}

?>

<!-- COUPON BOX -->
<div class="coupon-box">
<h3>🎁 Coupon: SAVE20</h3>
<p>Get 20% OFF above ₹200</p>
</div>

<!-- COUPON FORM -->
<form method="POST">
<input type="text" name="coupon" placeholder="Enter Coupon Code">
<button type="submit" name="apply_coupon" class="btn">Apply</button>
</form>

<br>

<h2>Total Amount: ₹<?php echo $total; ?></h2>

<h2 style="color:green;">
Final Amount: ₹<?php echo $final_total; ?>
</h2>

<br>

<!-- 🔥 IMPORTANT: STORE IN SESSION FOR CHECKOUT -->
<?php
$_SESSION['final_total'] = $final_total;
?>

<br>

<a href="checkout.php" class="btn">
    Proceed to Checkout
</a>

</body>
</html>