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
    $product = $_POST['pcategory'];
    $BNamee = $_POST['bname'];
    $quantit = $_POST['pquantity'];
    $sname = $_POST['psname'];
    $date = $_POST['pdate'];

    $sql = "INSERT INTO purchase (PRODUCT, BName, QUANTITY, SUPPLIER, DATE) VALUES ('$product', '$BNamee', '$quantit', '$sname', '$date')";
    $result = mysqli_query($conn, $sql);

    if($result){
        $update_sql = "UPDATE product SET QUANTITY = QUANTITY + $quantit WHERE PNAME = '$product' AND SUPPLIERID = (SELECT ID FROM supplier WHERE NAME = '$sname') AND BRANDID = (SELECT ID FROM brand WHERE BNAME = '$BNamee')";
        $update_result = mysqli_query($conn, $update_sql);

        if($update_result){
            header('Location: purchase.php');
        } else {
            echo "Error updating product quantity: " . mysqli_error($conn);
        }
    } else {
        echo "Error inserting purchase record: " . mysqli_error($conn);
    }

    $conn->close();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <title>Form Submission</title>
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
        <h2>Purchase Entry</h2>
        <form method="post">
            <div class="form-group">
                <label>Brand Name:</label>
                <select name="bname" class="form-control">
                    <?php 
                    include 'database/connection.php';
                    $cat = mysqli_query($conn, "SELECT * FROM brand WHERE status='active'");
                    while($c = mysqli_fetch_array($cat)){
                        echo "<option value='" . htmlspecialchars($c['BNAME']) . "'>" . htmlspecialchars($c['BNAME']) . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label>Product:</label>
                <select name="pcategory" class="form-control">
                    <?php 
                    include 'database/connection.php';
                    $cat = mysqli_query($conn, "SELECT * FROM product WHERE status='active'");
                    while($c = mysqli_fetch_array($cat)){
                        echo "<option value='" . htmlspecialchars($c['PNAME']) . "'>" . htmlspecialchars($c['PNAME']) . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label>Quantity:</label>
                <input type="text" class="form-control" placeholder="Enter Quantity" pattern="[0-9]{1,3}" maxlength="3" name="pquantity" required>
            </div>
            <div class="form-group">
                <label>Supplier:</label>
                <select name="psname" class="form-control">
                    <?php 
                    include 'database/connection.php';
                    $cat = mysqli_query($conn, "SELECT * FROM supplier where status='active'");
                    while($c = mysqli_fetch_array($cat)){
                        echo "<option value='" . htmlspecialchars($c['NAME']) . "'>" . htmlspecialchars($c['NAME']) . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label>Purchase Date:</label>
                <input type="date" class="form-control" name="pdate" min="<?php echo date('Y-m-d', strtotime('-1 year')); ?>" max="<?php echo date('Y-m-d'); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>
    </div>
    <button class="cbutton"><a href="purchase.php"> Back</a></button>
</body>
</html>
