<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
         margin: 0px;
         align-items: center;
        }
        main{
            margin-left: 20px;
            margin-right: 20px;
        }
        .navbar ul{
            list-style-type: none;
            background-color:hsl(0, 0%, 25%);
            padding:0px;
            margin:0px;
            margin-left:400px;
            overflow: hidden;
        }
        .navbar a{
            color:white ;
            text-decoration:none;
            padding:15px;
            display: block;
            text-align: center;
        }
        .navbar a:hover{
            background-color:gray ;
            color: white;
            text-decoration: none;

        }
        .navbar li{
       float:left;

        }
    </style>
</head>
<body>
    <nav class="navbar">
     <ul>
     <li><a href="dashboard.php">Home</a></li>
        <li><a href="customer.php">Customer</a></li>
        <li><a href="category.php">Category</a></li>
        <li><a href="brand.php">Brand</a></li>
        <li><a href="supplier.php">Suppier</a></li>
        <li><a href="product.php">Product</a></li>
        <li><a href="purchase.php">Purchase</a></li>
        <li><a href="sale.php">Sales</a></li>
     </ul>
    </nav>
</body>
</html>