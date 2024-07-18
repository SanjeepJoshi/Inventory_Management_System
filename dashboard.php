<?php
include('database/connection.php');
session_start();
$un = $_SESSION['un'];
// echo "<script>alert('$un')</script>";

if (!isset($un)) {
    header("Location:index.php");
}

?>
<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$database = "inventory"; 
$conn = new mysqli($servername, $username, $password, $database);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql_suppliers = "SELECT COUNT(*) AS total_suppliers FROM supplier";
$sql_customers = "SELECT COUNT(*) AS total_customers FROM customer";
$sql_orders = "SELECT COUNT(*) AS total_orders FROM orderr";
$sql_products = "SELECT COUNT(*) AS total_products FROM product";

$result_suppliers = $conn->query($sql_suppliers);
$result_customers = $conn->query($sql_customers);
$result_orders = $conn->query($sql_orders);
$result_products = $conn->query($sql_products);

$total_suppliers = $result_suppliers->fetch_assoc()["total_suppliers"];
$total_customers = $result_customers->fetch_assoc()["total_customers"];
$total_orders = $result_orders->fetch_assoc()["total_orders"];
$total_products = $result_products->fetch_assoc()["total_products"];

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
   
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <script src="https://use.fontawesome.com/0c7a3095b5.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" 
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
    .dashboard_card {
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
    margin: 20px auto;
    max-width: 700px;
    
    margin-left:300px;
    margin-top:200px;
}

.card_title {
    font-size: 20px;
    font-weight: bold;
    margin-bottom: 10px;
}

.card_body {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
}

.card_item {
    flex-basis: calc(50% - 10px);
    margin-bottom: 10px;
    display: flex;
    align-items: center;
}

.item_icon {
    margin-right: 10px;
}

.item_icon i {
    font-size: 24px;
}

.item_text {
    font-size: 16px;
}

.item_text span {
    font-weight: bold;
}

    </style>
</head>
<body>
    
    <div id="maincontainer">
        <div class="sidebar" id="sidebar">
            <h3 class="logo">IMS</h3>

    <div class="sidebar_user">
    <img src="image/op.jpeg" alt="user image" />
    <span>Laxmi</span></div>
    <div class="sidebar_menus" id="sidebar_menus">

   
        <ul class="menu_list">
            <li class="menuactive" id="menuactive" type="none">
                <a href=""><i class="fa fa-house"></i>Home</a>
            </li>
            <li type="none">
                <a href="customer.php"><i class="fa fa-user"></i>Customer</a>
            </li>
            <li type="none">
                <a href="category.php"><i class="fa fa-list"></i>Category</a>
            </li>
            <li type="none">
                <a href="brand.php"><i class="fa fa-bandcamp"></i>Brand</a>
            </li>
            <li type="none">
                <a href="supplier.php"><i class="fa fa-user"></i>Supplier</a>
            </li>
            <li type="none">
                <a href="product.php"><i class='bx bxl-product-hunt'></i>Product</a>
            </li>
            <li type="none">
                <a href="purchase.php"><i class="fa-solid fa-cart-shopping"></i>Purchase</a>
            </li>
            <li type="none">
                <a href="sale.php"><i class="fa fa-dashboard"></i>Sales</a>
            </li>

            
        </ul>
    </div>

        </div>
        <div class="content_container">
<div class="content_topnav">
<a href="" id="togglebtn"><i class="fa fa-navicon"></i></a>
<a href="logout.php" id="logoutbtn" ><i class="fa fa-power-off"></i>Logout</a>
        </div>
        <div class="dashboard_content">
            <div class="dashboard_content_main"></div> 
            
            <div class="dashboard_card">
    <div class="card_title">Summary</div>
    <div class="card_body">
        <div class="card_item">
            <div class="item_icon"><i class="fas fa-user"></i></div>
            <div class="item_text">Total Suppliers: <span id="total_suppliers"><?php echo $total_suppliers; ?></span></div>
        </div>
        <div class="card_item">
            <div class="item_icon"><i class="fas fa-users"></i></div>
            <div class="item_text">Total Customers: <span id="total_customers"><?php echo $total_customers; ?></span></div>
        </div>
        <div class="card_item">
            <div class="item_icon"><i class="fas fa-cart-plus"></i></div>
            <div class="item_text">Total Sale: <span id="total_orders"><?php echo $total_orders; ?></span></div>
        </div>
        <div class="card_item">
            <div class="item_icon"><i class="fas fa-cubes"></i></div>
            <div class="item_text">Total Products: <span id="total_products"><?php echo $total_products; ?></span></div>
        </div>
    </div>
</div>
</div>
</div>
    </div>

    




</body>
</html>
<script>
        const link = document.getElementById('logoutbtn');
        link.addEventListener('click', function(event) {
            event.preventDefault();
            const isConfirmed = confirm("Are you sure you want to Exit?");
            if (isConfirmed) {
                window.location.href ="logout.php"; 
            }
        });
    </script>
