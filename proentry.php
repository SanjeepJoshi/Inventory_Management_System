<?php
include('database/connection.php');
session_start();
$un = $_SESSION['un'];

if (!$un) {
    header("Location:index.php");
}

?>
<?php
include 'database/connection.php';
include 'navigation.php';
if(isset($_POST['submit'])){

    $category = $_POST['pcategory'];
    $bname = $_POST['pbname'];
    $pname = $_POST['pproduct'];
    $pmodel = $_POST['ppodel'];
    $quantity = $_POST['pquantity'];
    $sname = $_POST['psname'];
    $status = $_POST['pstatus'];

    
    $sql = "INSERT INTO product (CATEGORYID, BRANDID, PNAME, PMODEL, QUANTITY, SUPPLIERID, STATUS)
            VALUES ('$category', '$bname', '$pname', '$pmodel', '$quantity', '$sname', '$status')";
    $result = mysqli_query($conn, $sql);
    if($result){
        header('location:product.php');
    } }
    

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <title>Product Entry</title>
   
    <style>
        body {
            background-color: #f4f4f9;
            font-family: 'Arial', sans-serif;
        }
        .container {
            max-width: 600px;
            margin-top: 40px;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        h2 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            color: #666;
        }
        .form-group input, .form-group select {
            border-radius: 5px;
        }
        .btn-primary {
            background-color: #0056b3;
            border-color: #004085;
        }
        .btn-primary:hover {
            background-color: #004085;
            border-color: #003566;
        }
        .cbutton a{
            color: #009879;
            font-size: 18px; 
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translate(-50%);
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Enter Product Details</h2>
        <form method="post">
           
            <div class="form-group">
                <label>Category:</label>
                <select name="pcategory" class="form-control">
                    <?php
                    $cat = mysqli_query($conn, "SELECT * FROM category where status='active'");
                    while($c = mysqli_fetch_array($cat)) {
                        echo "<option value='" . htmlspecialchars($c['ID']) . "'>" . htmlspecialchars($c['CATEGORY']) . "</option>";
                    }
                    ?>
                </select>
            </div>
           
            <div class="form-group">
                <label>Brand:</label>
                <select name="pbname" class="form-control">
                    <?php
                    $brands = mysqli_query($conn, "SELECT * FROM brand where status='active'");
                    while($b = mysqli_fetch_array($brands)) {
                        echo "<option value='" . htmlspecialchars($b['ID']) . "'>" . htmlspecialchars($b['BNAME']) . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label>Color Name:</label>
                <input type="text" class="form-control" maxlength="20" placeholder="Enter Product Name" name="pproduct" required>
            </div>
            <div class="form-group">
                <label>Product Model:</label>
                <input type="text" class="form-control" maxlength="20" placeholder="Enter Product Model" name="ppodel" required>
            </div>
            <div class="form-group">
                <label>Quantity:</label>
                <input type="text" class="form-control" pattern="[0-9]{}" maxlength="3"  placeholder="Enter Quantity" name="pquantity" required>
            </div>
            <div class="form-group">
                <label>Supplier:</label>
                <select name="psname" class="form-control">
                    <?php
                    $suppliers = mysqli_query($conn, "SELECT * FROM supplier where status='active'");
                    while($s = mysqli_fetch_array($suppliers)) {
                        echo "<option value='" . htmlspecialchars($s['ID']) . "'>" . htmlspecialchars($s['NAME']) . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label>Status:</label>
                <input type="radio"  name="pstatus" value="Active" required>Active
                <input type="radio"  name="pstatus" value="Passive" required>Passive
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>
    </div>
    <button class="cbutton"><a href="product.php">Back</a></button>
</body>
</html>
