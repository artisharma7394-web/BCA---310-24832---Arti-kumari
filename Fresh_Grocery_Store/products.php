<?php
session_start(); // ✅ session start (important for cart count)
include("config.php");

// 🔍 SEARCH LOGIC
$search = "";

if(isset($_GET['search'])){
    $search = mysqli_real_escape_string($conn, $_GET['search']);

    $query = "SELECT * FROM products 
              WHERE name LIKE '%$search%' 
              OR price LIKE '%$search%'
              OR category LIKE '%$search%'";
              
} else {
    $query = "SELECT * FROM products";
}

$result = mysqli_query($conn, $query);

// 🛒 cart count
$cart_count = 0;
if(isset($_SESSION['cart'])){
    $cart_count = count($_SESSION['cart']);
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Our Products</title>

<style>
body{
    font-family:Arial;
    margin:0;
    padding:20px;
    background:#f5f5f5;
}

h1{
    text-align:center;
    color:#2e7d32;
    margin-bottom:10px;
}

/* 🛒 CART BUTTON */
.top-bar{
    text-align:center;
    margin-bottom:20px;
}

.cart-btn{
    background:black;
    color:white;
    padding:10px 15px;
    border-radius:8px;
    text-decoration:none;
}

/* 🔍 SEARCH BAR */
.search-box{
    text-align:center;
    margin-bottom:30px;
}

.search-box input{
    padding:10px;
    width:250px;
    border-radius:8px;
    border:1px solid #ccc;
}

.search-box button{
    padding:10px 15px;
    background:#2e7d32;
    color:white;
    border:none;
    border-radius:8px;
    cursor:pointer;
}

/* PRODUCTS GRID */
.products{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
    gap:20px;
}

.card{
    background:#fff;
    border-radius:15px;
    padding:15px;
    box-shadow:0 4px 12px rgba(0,0,0,0.1);
    text-align:center;
}

.card img{
    width:100%;
    height:160px;
    object-fit:cover;
    border-radius:12px;
}

.price{
    color:red;
    font-weight:bold;
}

.btn{
    background:#2e7d32;
    color:white;
    padding:10px 18px;
    border-radius:8px;
    display:inline-block;
    text-decoration:none;
    margin-top:10px;
}
</style>
</head>

<body>

<h1>🛒 Our Products</h1>

<!-- 🛒 VIEW CART -->
<div class="top-bar">
    <a href="cart.php" class="cart-btn">
        🛒 View Cart (<?php echo $cart_count; ?>)
    </a>
</div>

<!-- 🔍 SEARCH -->
<div class="search-box">
    <form method="GET">
        <input type="text" name="search" placeholder="Search product..." value="<?php echo $search; ?>">
        <button type="submit">Search</button>
    </form>
</div>

<div class="products">

<?php 
if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)) { 
?>

<div class="card">
    <img src="<?php echo $row['image']; ?>">
    <h3><?php echo $row['name']; ?></h3>
    <p class="price">₹<?php echo $row['price']; ?></p>

    <a href="add_to_cart.php?id=<?php echo $row['id']; ?>" class="btn">
        Add to Cart
    </a>
</div>

<?php 
    }
} else {
    echo "<h2 style='text-align:center;'>❌ No Product Found</h2>";
}
?>

</div>

</body>
</html>